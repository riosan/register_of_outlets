<?php

namespace App\Http\Controllers;

use App\Models\Registry\Functions\Functions;
use Illuminate\Http\Request;


class AdminController extends Controller
{


    public function getAdmin()
    {
        return view('admin.admin');
    }

    /**
     * @param Request $request
     * @return int|void
     */
    public function postAdmin(Request $request)
    {


         $data = json_decode($request['data'], true);
        if (empty($data['user']) || empty($data['pass'])) {
            return;
        }

        $result = (new Functions())->getAuthorization($data);
        if (!empty($result)) {
            session_start();
            $_SESSION['authorized'] = (new Functions())->getSessionId();
            return 1;
        }




    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getUsers()
    {
        if ((new Functions())->sessionAuthorized()) {
            return view('admin.users')->with(['files_list' => (new Functions())->getUsersList()]);
        }

        header("Location: http://{$_SERVER['SERVER_ADDR']}/admin");
        exit;
    }

    public function postUsers(Request $request)
    {
        $data = json_decode($request['change'], true);

        if(!empty($data)) {
            $data = json_decode($request['change'], true);
            $result = (new Functions())->changeUser($data);
            return $result ? 1 : 0;
        }


        $data = json_decode($request['delete'], true);

        if(!empty($data)) {
            $result = (new Functions())->deleteUser($data);
            return $result ? 1 : 0;
        }

        $data = json_decode($request['data'], true);

        if (!empty($data['ip']) || !empty($data['login'])) {
            $result = (new Functions())->insertUser($data);
            return $result ? 1 : 0;
        }

    }

}
