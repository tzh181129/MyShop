<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;

class BusinessController extends Controller
{

    public function business()
    {
        return view('shopping.business');
    }

    public function businesshome()
    {
        return view('shopping.businesshome');
    }

    public function businesspost()
    {
        $img = $_POST['shop_image'];
        $image = 'image/' . $img;
        $user_name = session('register_name');
        $user_id = session('user_id');

        $data = ['shop_name' => $_POST['shop_name'], 'user_id' => $user_id, 'register_name' => $user_name, 'shop_image' => $image,
            'shop_details' => $_POST['shop_details'], 'shop_advert' => $_POST['shop_advert']];

        $res = DB::table('shop')->insert($data);
        if ($res) {
            return redirect('release');
        } else {
            return redirect('business')->with('message','店铺创建失败，请重新创建');
        }
    }


    public function release()
    {
        if(session('business')==1) {
            return view('shopping.release');
        }else{
            return redirect('business')->with('message','您不是商家，无权发布商品');
        }
    }

    public function releasepost()
    {
        $img = $_POST['image'];
        $image = 'image/' . $img;
        $user_id = session('user_id');
        $arr = DB::table('shop')->where('user_id', $user_id)->first();
        $shop_id = $arr->id;
        $shop_name = $arr->shop_name;
        session(['shop_id' => $shop_id]);
        $data = ['shop_id' => $shop_id, 'shop_name' => $shop_name, 'name' => $_POST['name'], 'title' => $_POST['title'], 'discount' => $_POST['discount'],
            'description' => $_POST['description'], 'address' => $_POST['address'], 'color' => $_POST['color'], 'product_type' => $_POST['product_type'],
            'image' => $image, 'price' => $_POST['price'], 'user_id' => $user_id];
        $res = DB::table('products')->insert($data);
        if ($res) {
            return redirect('shop');
        } else {
            return redirect('release')->with('message','发布商品失败，请重新发布');
        }
    }

    public function myshop()
    {
        $user_id=session('user_id');
        $arr = DB::table('shop')->where('user_id', $user_id)->first();
        $shop_id=$arr->id;
        session(['shop_id' => $shop_id]);
        $num = DB::table('follow')->where('shop_id', $shop_id)->count();
        $data = ['num' => $num, 'shop_id' => $shop_id, 'shop_image' => $arr->shop_image, 'shop_name' => $arr->shop_name,
            'shop_details' => $arr->shop_details, 'shop_advert' => $arr->shop_advert];
        $array=DB::table('products')->where('shop_id',$shop_id)->get();
       return view('shopping.myshop', ['messageRes' => $data,'array'=>$array]);
    }

    public function shopshow()
    {
        $shop_id = $_GET['shop_id'];
        session(['shop_id'=>$shop_id]);
        $num = DB::table('follow')->where('shop_id', $shop_id)->count();
        $alery=DB::table('follow')->where('shop_id',$shop_id)->where('user_id',session('user_id'))->count();
        $arr = DB::table('shop')->where('id', $shop_id)->first();
        $array=DB::table('products')->where('shop_id',$shop_id)->get();
        $data = ['num' => $num,'alery'=>$alery,'shop_id' => $shop_id, 'shop_image' => $arr->shop_image, 'shop_name' => $arr->shop_name,
            'shop_details' => $arr->shop_details, 'shop_advert' => $arr->shop_advert];
        return view('shopping.shopshow', ['messageRes' => $data,'array'=>$array]);
    }
    public function shopsearch(){
            $name = $_POST['name'];
            $shop_id=$_POST['shop_id'];
        $data = DB::table('products')->where('shop_id',$shop_id)->where('name', 'like','%'.$name.'%')->get();
        if($data->count()==0){
            return view('shopping.shop')->with('message', '无搜索的商品');
        }else {
            return view('shopping.shop', ['messageRes' => $data]);
        }
    }
}
