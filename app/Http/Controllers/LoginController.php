<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Model\LoginModel;

class LoginController extends Controller
{
    public function login(){
        return view('shopping.login');
    }
    public function loginpost()
    {

            $code = $_POST['code'];
            if (session('milkcaptcha') == $code) {
                $login_name = $_POST['login_name'];
                $login_pwd = $_POST['login_pwd'];
                $user = new \App\Http\Model\LoginModel();
                $data = $user::where('register_name', $login_name)->first();
                if (!$data) {
                    return redirect('login')->with('message', '用户名错误');
                } else {
                    if ($data['register_pwd'] == $login_pwd) {
                        session(['user_id' => $data['id']]);
                        session(['register_name' => $data['register_name']]);
                        session(['business' => $data['business']]);
                        if ($data['business'] == 0) {
                            return redirect('shop');
                        } else {
                            return redirect('business');
                        }
                    } else {
                        return redirect('login')->with('message', '密码错误');
                    }
                }
            } else {
                return redirect('login')->with('message', '验证码错误');
            }

    }

    public function loginout()
    {
        session()->flush();
        $sessions = session()->all();
        if (empty($sessions)) {
            return redirect('login')->with('message', '已退出登录');
        }

    }
    public function information()
    {
        $user = new \App\Http\Model\LoginModel();
        $register_name = session('register_name');
        $data = $user->where('register_name', $register_name)->get();
        return view('shopping.information', ['informationRes' => $data]);
    }

    public function update()
    {
        return view('shopping.update');
    }

    public function updatepost()
    {
        $userpwd = $_POST['userpwd'];
        $newpwd = $_POST['newpwd'];
        $register_name = session('register_name');
        $user = new \App\Http\Model\LoginModel();
        $data = $user->where('register_name', $register_name)->first();
        if ($userpwd != $data['register_pwd']) {
            return redirect('update')->with('message', '原密码错误');
        } else {
            $update = $user->where('register_name', $register_name)->update(['register_pwd' => $newpwd]);
            if ($update) {
                return redirect('login')->with('message', '密码已修改，请重新登录');
            } else {
                return redirect('update')->with('message', '修改失败');
            }
        }
    }
}
