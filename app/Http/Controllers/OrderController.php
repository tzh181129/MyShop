<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class OrderController extends Controller
{
    public function form(){
        $data=['product_id'=>$_POST['id'],'shop_id'=>$_POST['shop_id'],'shop_name'=>$_POST['shop_name'],
            'name'=>$_POST['name'],'title'=>$_POST['title'],'price'=>$_POST['price'],'discount'=>$_POST['discount'],
            'address'=>$_POST['address'],'color'=>$_POST['color'],'image'=>$_POST['image']];
        session(['data' => $data]);
       return view('shopping.form');

    }
    public function orderpost(){

        $user_id=session('user_id');
       $data=session('data');
       $user_name=$_POST['user_name'];
       $user_phone=$_POST['user_phone'];
        $num=$_POST['num'];
        $user_address=$_POST['user_address'];
        $total=$num*$data['discount'];
        $order_number=time().rand();
        date_default_timezone_set("Asia/Shanghai");
        $create_time = date("Y-m-d h:i:s A l");
        $delivery_time=0;
        $finish_time=0;
        $arr= ['user_id' => $user_id,'user_name'=>$user_name,'user_phone'=>$user_phone,'product_id'=>$data['product_id'],'shop_id'=>$data['shop_id'],'shop_name'=>$data['shop_name'],
            'name'=>$data['name'],'title'=>$data['title'],'price'=>$data['price'],'discount'=>$data['discount'], 'address'=>$data['address'],
            'color'=>$data['color'],'image'=>$data['image'], 'user_address' => $user_address, 'num' =>$num,'total' =>$total,'delivery_time'=>$delivery_time,
            'order_number' =>$order_number, 'create_time' =>$create_time,'finish_time' =>$finish_time];
        $res = DB::table('order')->insert($arr);
        if ($res) {
            return  redirect('order');
        } else {
            return redirect('product')->with('message','购买失败，请重新购买');
        }

    }
    public function allorder(){
        return view('shopping.allorder');
    }
    public function order(){
           $user_id=session('user_id');
           $data=DB::table('order')->where('user_id',$user_id)->get();
           if($data->count()==0) {
              return  redirect('recommend')->with('message','暂无订单,可以看看有没有哪些想买的');
           }else {
               return view('shopping.order', ['messageRes' => $data]);
           }
    }
    public function myorder(){
          $id=$_POST['id'];
          session(['order_id'=>$id]);
        date_default_timezone_set("Asia/Shanghai");
        $finish_time = date("Y-m-d h:i:s A l");
          $res=DB::table('order')->where('id',$id)->update(['finish_time'=>$finish_time]);
        if ($res) {
            return redirect('evaluate')->with('message','已完成，请评价');
        }
    }
    public function unshipped(){
        $data=DB::table('order')->where('delivery_time',0)->get();
        if($data->count()==0){
            redirect('order')->with('message','暂无未发货商品');
        }else{
            return view('shopping.order', ['messageRes' => $data]);
        }
    }
    public function already(){
        $data=DB::table('order')->where('delivery_time','!=',0)->where('finish_time',0)->get();
        if($data->count()==0) {
           return redirect('order')->with('message','暂无已发货商品');
        } else{
            return view('shopping.order', ['messageRes' => $data]);
        }
    }
    public function orderfinish(){
        $data=DB::table('order')->where('delivery_time','!=',0)->where('finish_time','!=',0)->get();
        if($data->count()==0) {
            return redirect('order')->with('message','暂无已收货商品');
        } else{
            return view('shopping.order', ['messageRes' => $data]);
        }
    }
    public function orderdel()
    {
         $id=$_GET['id'];
        $delete = DB::table('order')->where('id', $id)->delete();
        if ($delete) {
            return redirect('order')->with('message','订单删除成功');
        } else {
            return redirect('order')->with('message','订单删除失败');
        }
    }
    public function shoporder(){

        $shop_id=session('shop_id');
        $data=DB::table('order')->where('shop_id',$shop_id)->get();
        if($data->count()==0){
            return redirect('myshop')->with('message','店铺内暂无订单');
        }else {
            return view('shopping.shoporder', ['messageRes' => $data]);
        }
    }
    public function shoporderpost(){
        $id=$_POST['id'];
        date_default_timezone_set("Asia/Shanghai");
        $delivery_time = date("Y-m-d h:i:s A l");
        $res=DB::table('order')->where('id',$id)->update(['delivery_time'=>$delivery_time]);
        if ($res) {
            return redirect('shoporder')->with('message','已发货');
        }
    }
    public function delivery(){
        $data=DB::table('order')->where('delivery_time',0)->get();
        if($data->count()==0){
            return redirect('shoporder')->with('message','暂无未发货的商品');
        }else{
            return view('shopping.shoporder', ['messageRes' => $data]);
        }
    }
    public function shopalready(){
        $data=DB::table('order')->where('delivery_time','!=',0)->where('finish_time',0)->get();
        if($data->count()==0) {
            return redirect('shoporder')->with('message','暂无已发货商品');
        } else{
            return view('shopping.shoporder', ['messageRes' => $data]);
        }
    }
    public function shopfinish(){
        $data=DB::table('order')->where('delivery_time','!=',0)->where('finish_time','!=',0)->get();
        if($data->count()==0) {
            return redirect('shoporder')->with('message','暂无已完成商品');
        } else{
            return view('shopping.shoporder', ['messageRes' => $data]);
        }
    }

}
