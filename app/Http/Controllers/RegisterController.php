<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use DB;
class RegisterController extends Controller
{
    public function register()
    {
        return view('shopping.register');
    }

    public function registerpost()
    {
        if ($_POST['register_pwd'] != $_POST['confirmpwd']) {
            return redirect('register')->with('message', '密码确认错误');
        } else {
            $data = ['register_name' => $_POST['register_name'], 'register_image' => $_POST['register_image'],
                'register_email' => $_POST['register_email'], 'business' => $_POST['business'],
                'register_phone' => $_POST['register_phone'], 'register_pwd' => $_POST['register_pwd']];

            $res = DB::table('user')->insert($data);
            if ($res) {
                return redirect('login');
            } else {
                return redirect('register')->with('message', '注册失败，请重新注册');
            }
        }
    }
}
