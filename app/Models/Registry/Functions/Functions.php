<?php


namespace App\Models\Registry\Functions;

use App\Models\Registry\ConnectDB\ConnectDB;
use App\Models\Registry\Providers\ProviderVega;


/*require_once '../packages/monolog/vendor/autoload.php';

use Monolog\Logger;
use Monolog\Handler\StreamHandler;*/

class Functions extends ProviderVega
{
    /* private $log;*/


    /**
     * Functions constructor.
     */
    public function __construct()
    {
        /*$this->log = new Logger('name');
        $this->log->pushHandler(new StreamHandler('../logs/your.log', Logger::WARNING));*/
        parent::__construct();

    }

    /**
     * @param string $sign
     * @param string $string
     * @param array $replace
     * @return array|string
     */
    public function replacePointName($sign = '', $string = '', $replace = [])
    {

        $result = '';


        if (empty($sign) && empty($string)) {
            return Functions::getPoint();
        }


        foreach (explode($sign, $string) as $str) {

            $result .= strtr($str, $replace) . ' ⇒ ';
        }

        return mb_substr($result, 0, -3);

    }


    public function getAuthorization($data)
    {
        $db = new ConnectDB();

        $login = md5($data['user'] . $this->config['salt']);
        $pass = md5($data['pass'] . $this->config['salt']);

        $result = $db->prepare("SELECT login,pass FROM authorization WHERE login =:login AND
                                                                                    pass =:pass AND
                                                                                    enable =:enable",
            ['login' => $login, 'pass' => $pass, 'enable' => 1], 0);
        return $result;


        /*$db->prepare("INSERT INTO authorization (login, pass, date) VALUES (:login, :pass, :date)
          ON DUPLICATE KEY UPDATE login =:login, pass =:pass",
            ['login' => md5($data['user'].$this->config['salt']), 'pass' => md5($data['pass'].$this->config['salt']), 'date' => date('Y-m-d H:i:s')],1);*/
    }


    public function insertUser($data)
    {
        $db = new ConnectDB();

        $result =  $db->prepare("INSERT INTO access_additional_function (ip,login,date,enable) VALUES (:ip, :login, :date, :enable) 
          ON DUPLICATE KEY UPDATE ip =:ip, login =:login, date =:date",
            ['ip' => $data['ip'], 'login' => $data['login'], 'date' => date('Y-m-d H:i:s'), 'enable' => $data['enable'] ? $data['enable'] : 0],  1);

        if (!empty($result)) {
            return true;

        }
       return false;

    }


    public function changeUser($data)
    {
        $db = new ConnectDB();

        if($data['field'] === 'enable'){
            $data['value'] = $data['value'] ? 1 : 0;
        }

        $result =  $db->prepare("UPDATE access_additional_function SET {$data['field']} = '{$data['value']}'  WHERE id =:id",
            ['id' => $data['id']],  1);

        if (!empty($result)) {
            return true;

        }
        return false;
    }


    public function deleteUser($data)
    {
        $db = new ConnectDB();

        $result =  $db->prepare("DELETE FROM access_additional_function WHERE id IN (".implode(',',$data).")",
            null,  1);

        if (!empty($result)) {
            return true;

        }
        return false;
    }




    /**
     * @param $strPoint
     * @return int
     */
    public function setAttr($strPoint)
    {
        return mb_substr($strPoint, 0, 16) === 'Центральный_офис' ? 1 : 0;
    }


    /**
     * @return array
     */
    public function getPoint()
    {
        $db = new ConnectDB();
        $query = "SELECT short_name, name FROM point";

        /*$this->log->addInfo($query);*/

        $replace = $db->prepare($query, null, 0);
        $result = [];
        foreach ($replace as $key => $value) {
            $result[$value['short_name']] = $value['name'];
        }
        return $result;
    }

    /**
     * @return bool
     */
    public function definitionIp()
    {

        $ip = exec("grep {$_SERVER['REMOTE_ADDR']} /proc/net/arp | awk '{print $1}'");

        if (empty($ip)) {
            return false;
        }

        $db = new ConnectDB();
        $result = $db->prepare("SELECT ip FROM access_additional_function WHERE ip =:ip and enable =:enable",
            ['ip' => $ip, 'enable' => 1], 0);

        if (!empty($result[0]['ip'])) {
            return true;
        }

        return false;

    }

    /**
     * @return mixed
     */
    public function getHoursLimit()
    {
        return $this->config['hours_limit'];
    }

    public function getSessionId()
    {
        return $this->config['session_id'];
    }

    /**
     * @param $email
     */
    public function setMailAddress($email)
    {
        if (!$this->validateEmail($email[1])) {
            return;
        }

        $db = new ConnectDB();

        $db->prepare("INSERT INTO mail (ip,address,date) VALUES (:ip, :address, :date) 
          ON DUPLICATE KEY UPDATE address =:address, date =:date",
            ['ip' => $_SERVER['REMOTE_ADDR'], 'address' => $email[1], 'date' => date('Y-m-d H:i:s')], 1);

        $this->requestConfirmationMail($email[1]);
    }

    /**
     * @param $email
     */
    private function requestConfirmationMail($email)
    {
        $hash = $this->createHash($email);

        $body = $this->config['body_confirm'] . '<a href=http://' . $_SERVER["SERVER_ADDR"] . "/statistics/registry?mail={$email}&hash=" . $hash . '>' . $this->config['confirm_mail'] . '</a>';

        if (!mail($email, 'no-reply', $body, str_replace('|', PHP_EOL, $this->config['headers_confirm']))) {
            var_dump("Mail not send $email");
        }
    }

    /**
     * @param $email
     * @return string
     */
    private function createHash($email)
    {
        return $hash = md5($email . $_SERVER['REMOTE_ADDR'] . $this->config['salt']);
    }

    /**
     * @return array|bool
     */
    public function getConfirmMailAddress()
    {
        $db = new ConnectDB();
        return $db->prepare("SELECT address FROM mail WHERE enable =:enable", ['enable' => 1], 0);
    }

    /**
     * @return array|bool
     */
    public function getMailAddress()
    {
        $db = new ConnectDB();
        return $db->prepare("SELECT address FROM mail WHERE enable =:enable and ip =:ip",
            ['ip' => $_SERVER['REMOTE_ADDR'], 'enable' => 1], 0);
    }

    /**
     * @param $response
     * @return array|bool
     */
    public function setRequestMailAddress($response)
    {
        if ($response['hash'] === $this->createHash($response['mail'])) {
            $db = new ConnectDB();
            return $db->prepare("INSERT INTO mail (ip, address, enable, date) VALUES (:ip, :address, :enable, :date) 
          ON DUPLICATE KEY UPDATE address =:address, enable =:enable, date =:date",
                [
                    'ip' => $_SERVER['REMOTE_ADDR'],
                    'address' => $response['mail'],
                    'enable' => 1,
                    'date' => date('Y-m-d H:i:s')
                ], 1);

        }

    }

    /**
     * @param $email
     * @return bool
     */
    public function validateEmail($email)
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            return false;
        }

        return true;
    }

    /**
     * @param $email
     */

    public function setRequestDelMailAddress($email)
    {
        $hash = $this->createHash($email);

        $body = $this->config['body_cancel'] . '<a href=http://' . $_SERVER["SERVER_ADDR"] . "/statistics/delete?mail={$email}&hash=" . $hash . '>' . $this->config['cancel_mail'] . '</a>';

        if (!mail($email, 'no-reply', $body, str_replace('|', PHP_EOL, $this->config['headers_confirm_cancel']))) {
            var_dump("Mail not send $email");
        }

    }

    /**
     * @param $email
     * @return array|bool
     */
    public function delMailAddress($response)
    {

        if ($response['hash'] === $this->createHash($response['mail'])) {
            $db = new ConnectDB();
            return $db->prepare("DELETE FROM mail WHERE address =:address", ['address' => $response['mail']], 1);


        }

    }

    /**
     * @return mixed
     */
    public function getMailHash()
    {
        return $this->config['send'];
    }


    public function sessionAuthorized()
    {
        session_start();

        if (!isset($_SESSION['authorized'])) {
            return false;
        }

        if ($_SESSION['authorized'] !== $this->getSessionId()) {
            return false;
        }

        return true;
    }


    public function getUsersList()
    {
        $db = new ConnectDB();
        $result = $db->prepare("SELECT id, ip, login, date, enable FROM access_additional_function ", null, 0);
        return $result;
    }


    public function getStatusPoints($file,$head,$status)
    {
        $short_name = mb_substr($file,7,5);
        $names = explode('_',$short_name);

        switch ($names[0]) {
            case $head:
                $name = $names[1];
                break;
            default:
                $name = $names[0];
        }
            return $status[$name] ? $status[$name] : $this->config['undefined'];
    }

    public function getStatusInternetPoints()
    {
        $db = new ConnectDB();

        $result = $db->prepare("SELECT short_name,ip FROM point WHERE head =:head", ['head' => 0], 0);
        $status_points = [];
        foreach ($result as $value => $data ) {
            exec ("ping -c1 -w1 {$data['ip']}",$cmd,$status);
            if($status === 0) {
                $status_points[$data['short_name']] = $this->config['online'];
            } else {
                $status_points[$data['short_name']] = $this->config['offline'];
            }
        }

        return $status_points;
    }

    public function getHeadPoint()
    {
        $db = new ConnectDB();
        $result = $db->prepare("SELECT short_name FROM point WHERE head =:head", ['head' => 1], 0);
        return $result[0]['short_name'];
    }


    public function getMessageStatus()
    {
        return ['online' => $this->config['online'],
                'offline' => $this->config['offline'],
                'undefined' => $this->config['undefined']
                ];
    }
}