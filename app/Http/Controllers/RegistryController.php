<?php

namespace App\Http\Controllers;

use App\Models\Registry\Functions\Functions;
use App\Models\Registry\Providers\Exchange;
use Illuminate\Http\Request;
use App\Models\Registry\Providers\ProviderVega;


class RegistryController extends Controller
{


    public function postResponse(Request $request)
    {

        if ($request['names']) {
            $filename = json_decode($request['names'], true);
            $model = new ProviderVega();
            $status = $model->downloadFile($filename);
            return implode('</br>', $status);
        }

    }

    public function postMail(Request $request)
    {
        if ($request['save']) {

            $email = json_decode($request['save'], true);

            (new Functions())->setMailAddress($email);

        }

        if ($request['delete']) {

            $email = json_decode($request['delete'], true)[1];

            (new Functions())->setRequestDelMailAddress($email);

        }
    }


    public function postLog(Request $request)
    {
        $model = new Exchange();
        $model->setConnectSSH();
        return $model->getLog();
    }


    public function getRegistry(Request $request)
    {

        if (isset($request['hash']) && isset($request['mail'])) {
            $result = (new Functions())->setRequestMailAddress($request);

            if ($result) {
                return redirect("http://{$_SERVER['SERVER_ADDR']}/statistics/confirm?mail=" . $request['mail']);
            }
        }


        $model = new ProviderVega();
        $func = new Functions();

        if ($request['send'] === $func->getMailHash()) {
            $model->getFileList(true);
        } else {
            return view('page.registry')
                ->with([
                    'files_list' => $model->getFileList(false),
                    'mac' => $func->definitionIp(),
                    'hours_limit' => $func->getHoursLimit(),
                    'points_list' => $func->replacePointName(),
                    // 'email' => $func->getMailAddress()
                ]);
        }


    }


    public function getConfirm()
    {
        return view('page.confirm');
    }


    public function getDelete(Request $request)
    {
        if (isset($request['hash']) && isset($request['mail'])) {

            $result = (new Functions())->delMailAddress($request);

            if ($result) {
                return redirect("http://{$_SERVER['SERVER_ADDR']}/statistics/cancel?mail=" . $request['mail']);
            }

            return redirect("http://{$_SERVER['SERVER_ADDR']}/statistics/notexists?mail=" . $request['mail']);
        }

    }

    public function getNotexists()
    {
        return view('page.notexists');
    }

    public function getCancel()
    {
        return view('page.cancel');
    }


}
