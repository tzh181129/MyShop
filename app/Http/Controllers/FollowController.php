<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class FollowController extends Controller
{
    public function follow()
    {
        $shop_id = $_GET['id'];
        $user_id = session('user_id');
        $arr = DB::table('shop')->where('id', $shop_id)->first();
        $data = ['shop_id' => $shop_id, 'shop_name' => $arr->shop_name, 'user_id' => $user_id,
            'shop_details' => $arr->shop_details, 'shop_image' => $arr->shop_image];
        $array=DB::table('follow')->where('user_id',$user_id)->get();
        if($array->count()==0) {
            $res = DB::table('follow')->insert($data);
            if ($res) {
                return redirect('information');
            } else {
                return redirect('information')->with('message', '关注失败');
            }
        }else{
            return redirect('information')->with('message', '已关注此店铺');
        }
    }

    public function myfollow()
    {
        $user_id = session('user_id');
        $num = DB::table('follow')->where('user_id', $user_id)->count();
        if ($num == 0) {
            return redirect('recommend')->with('message', '暂无已关注的店铺，可以看看有没有哪些想关注的');
        } else {
            $arr = DB::table('follow')->where('user_id', $user_id)->get();
            for ($i = 0; $i < $num; $i++) {
                $shop_id = $arr[$i]->shop_id;
                $follow_id = $arr[$i]->id;
                $number = DB::table('follow')->where('shop_id', $shop_id)->count();
                $data = ['shop_id' => $arr[$i]->shop_id, 'shop_name' => $arr[$i]->shop_name, 'number' => $number,
                    'shop_details' => $arr[$i]->shop_details, 'shop_image' => $arr[$i]->shop_image, 'follow_id' => $follow_id];
            }

            return view('shopping.follow', ['messageRes' => $data]);
        }
    }

    public function followdelete()
    {
        $id = $_GET['id'];
        $delete = DB::table('follow')->where('id', $id)->delete();
        if ($delete) {
            return redirect('myfollow')->with('message','取消关注成功');
        } else {
            return redirect('myfollow')->with('message','取消关注失败');
        }
    }
}
