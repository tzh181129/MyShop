<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Requests;
use App\Http\Model\LoginModel;

class ProductsController extends Controller
{
    public function shop()
    {
        $products = new \App\Http\Model\ProductsModel();
        $data = $products::all();
        //$data=$products::count()获得数据库数据个数
        if ($data->count() == 0) {
            return '暂无商品';
        } else {
            return view('shopping.shop', ['messageRes' => $data]);
        }
    }

    public function descend()
    {

        $products = new \App\Http\Model\ProductsModel();
        if ($_GET['name'] == 'desc') {
            $data = $products::orderBy('discount', 'DESC')->get();
        } elseif ($_GET['name'] == 'asc') {
            $data = $products::orderBy('discount', 'ASC')->get();
        }
        return view('shopping.shop', ['messageRes' => $data]);
    }

    public function screen()
    {
        return view('shopping.screen');
    }

    public function screenpost()
    {
        $products = new \App\Http\Model\ProductsModel();
        $product_type = $_POST['product_type'];
        $minprice = $_POST['minprice'];
        $maxprice = $_POST['maxprice'];
        $data = $products::where('product_type', $product_type)->get();
        $arr = $products::where([['discount', '>=', $minprice], ['discount', '<=', $maxprice]])->get();
        if ($data->count() == 0) {
            return redirect('shop')->with('message', '暂无此类商品');
        } elseif ($arr->count() == 0) {
            return redirect('shop')->with('message', '暂无此价格区间商品');
        } else {
            $array = $products::where([['product_type', '=', $product_type], ['discount', '>=', $minprice], ['discount', '<=', $maxprice]])->get();
            return view('shopping.shop', ['messageRes' => $array]);
        }
    }

    public function product()
    {
        $id = $_GET['id'];
        $collection = DB::table('collection')->where('product_id', $id)->count();
        $evaluate = DB::table('evaluate')->where('product_id', $id)->where('evaluate_grade', '>=', 4)->count();
        $already = DB::table('collection')->where('product_id', $id)->where('user_id', session('user_id'))->count();
        $products = new \App\Http\Model\ProductsModel();
        $maylike = $products::inRandomOrder()->take(4)->get();
        $array = $products::where('id', $id)->first();
        $arr = ['collection' => $collection, 'evaluate' => $evaluate, 'already' => $already];
        $data = ['array' => $array, 'arr' => $arr];
        return view('shopping.product', ['messageRes' => $data, 'maylike' => $maylike]);
    }

    public function productpost()
    {
          $num=1;
        $data = ['name' => $_POST['name'], 'num'=>$num,'price' => $_POST['price'], 'description' => $_POST['description'],'shop_name'=>$_POST['shop_name'],
            'product_id' => $_POST['id'], 'image' => $_POST['image'],'user_id'=>$_POST['user_id'],'shop_id'=>$_POST['shop_id']];
        $product_id=$_POST['id'];
        $count=DB::table('cart')->where('product_id',$product_id)->count();
        if($count==0) {
            $res = DB::table('cart')->insert($data);
            if ($res) {
                return redirect('cart');
            }
        }else{
            $number=$num+1;
            $arr=DB::table('cart')->where('product_id',$product_id)->update(['num' => $number]);
            if ($arr) {
                return redirect('cart');
            }
        }
    }

    public function getcart()
    {
        $user_id=session('user_id');
        $data=DB::table('cart')->where('user_id',$user_id)->get();
        echo json_encode($data);
    }

    public function cart()
    {
        $products = new \App\Http\Model\ProductsModel();
        $maylike = $products::inRandomOrder()->take(4)->get();
        return view('shopping.cart', ['maylike' => $maylike]);
    }

    public function delete()
    {
        $id = $_GET['id'];
        setcookie($id, '');
        return view('shopping.cart')->with('message', '已将商品从购物车上删除');
    }

    public function alldel()
    {
        $j = count($_COOKIE) - 7;
        for ($i = 1; $i < $j; $i++) {
            setcookie($i, '');
        }
        return view('shopping.cart')->with('message', '已将商品从购物车上删除');
    }

    public function cartcount()
    {
        $user_id=session('user_id');
        $j = DB::table('cart')->where('user_id',$user_id)->count();
        echo json_encode($j);
    }

    public function home()
    {
        return view('shopping.home');
    }

    public function released()
    {
        $user_id = $_GET['user_id'];
        $products = new \App\Http\Model\ProductsModel();
        $data = $products::where('user_id', $user_id)->get();
        return view('shopping.released', ['messageRes' => $data]);
    }

    public function recommend()
    {
        $products = new \App\Http\Model\ProductsModel();
        $maylike = $products::inRandomOrder()->take(4)->get();
        return view('shopping.recommend', ['maylike' => $maylike]);
    }

    public function search()
    {
        if ($_POST['name'] == '') {
            $name = 'iphone';
        } else {
            $name = $_POST['name'];
        }
        $products = new \App\Http\Model\ProductsModel();
        $data = $products::where('name', 'like', '%' . $name . '%')->get();
        if ($data->count() == 0) {
            return view('shopping.shop')->with('message', '无搜索的商品');
        } else {
            return view('shopping.shop', ['messageRes' => $data]);
        }
    }
}
