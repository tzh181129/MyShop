<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class CollectionController extends Controller
{
    public function collectionpost()
    {
        $user_id = session('user_id');
        $shop_id = $_POST['shop_id'];
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $price = $_POST['price'];
        $discount = $_POST['discount'];
        $title = $_POST['title'];
        $image = $_POST['image'];
        $data = ['product_id' => $product_id, 'user_id' => $user_id, 'shop_id' => $shop_id, 'name' => $name, 'title' => $title,
            'price' => $price, 'discount' => $discount, 'image' => $image];
        $res = DB::table('collection')->insert($data);
        if ($res) {
            return redirect('collection');
        } else {
            return redirect('shop')->with('message','收藏失败');
        }

    }

    public function collection()
    {
        $user_id = session('user_id');
        $num = DB::table('collection')->where('user_id', $user_id)->count();
        if ($num == 0) {
            return redirect('recommend')->with('message','暂无收藏商品，可以看看有没有哪些想收藏的');
        } else {
            $data = DB::table('collection')->where('user_id', $user_id)->get();
            foreach ($data as $arr) {
                $product_id = $arr->product_id;
                $collection = DB::table('collection')->where('product_id', $product_id)->count();
            }
          $array=['collection'=>$collection];

            return view('shopping.collection', ['messageRes' => $data,'array'=>$array]);
        }
    }

    public function collectiondelete()
    {
        $id = $_GET['id'];
        $delete = DB::table('collection')->where('id', $id)->delete();
        if ($delete) {
            return redirect('collection');
        } else {
            return redirect('collection');
        }
    }
}
