<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests;
use DB;

class EvaluateController extends Controller
{
    public function evaluate()
    {
        $order_id = session('order_id');
        $data = DB::table('order')->where('id', $order_id)->get();
        return view('shopping.evaluate', ['messageRes' => $data]);
    }

    public function evaluatepost()
    {
        $register_name = session('register_name');
        $product_id = $_POST['product_id'];
        $name = $_POST['name'];
        $image = $_POST['image'];
        $color = $_POST['color'];
        $discount = $_POST['discount'];
        session(['product_id' => $product_id]);
        $user_id = session('user_id');
        date_default_timezone_set("Asia/Shanghai");
        $evaluate_time = date("Y-m-d h:i:s");
        $review_text=0;
        $review_time=0;
        /*$arr = DB::table('evaluate')->where('user_id', $user_id)->where('product_id', $product_id)->get();
        if($arr){
            return redirect('information');
        }else {*/
        $data = ['product_id' => $product_id, 'review_text'=>$review_text,'review_time'=>$review_time,'color' => $color, 'discount' => $discount, 'name' => $name, 'image' => $image, 'user_id' => $user_id, 'register_name' => $register_name, 'evaluate_time' => $evaluate_time,
            'evaluate_text' => $_POST['evaluate_text'], 'evaluate_grade' => $_POST['evaluate_grade']];
        $res = DB::table('evaluate')->insert($data);
        if ($res) {
            return redirect('evaluateshow')->with('message','评价成功');
        } else {
            return redirect('evaluate')->with('message', '评价失败');

        }

    }

    public function evaluateshow()
    {
        $user_id = session('user_id');
        $num = DB::table('evaluate')->where('user_id', $user_id)->count();
        if ($num == 0) {
            return redirect('recommend')->with('message', '暂无评价,可以看看有哪些想买的');
        } else {
            $data = DB::table('evaluate')->where('user_id', $user_id)->get();
            return view('shopping.evaluateshow', ['messageRes' => $data]);
        }

    }
    public function evaluatedel(){
        $id=$_GET['id'];
        $del= DB::table('evaluate')->where('id', $id)->delete();
        if ($del) {
            return redirect('evaluateshow')->with('message','评价删除成功');
        } else {
            return redirect('evaluateshow')->with('message','评价删除失败');
        }
    }

    public function review(){
        $id=$_GET['id'];
        $data=DB::table('evaluate')->where('id', $id)->get();
        return view('shopping.review')->with(['messageRes'=>$data]);
    }
    public function reviewpost(){
        $id=$_POST['id'];
        $review_text=$_POST['review_text'];
        date_default_timezone_set("Asia/Shanghai");
        $review_time = date("Y-m-d h:i:s A l");
        $res = DB::table('evaluate')->where('id',$id)->update(['review_text'=>$review_text,'review_time'=>$review_time]);
        if ($res) {
            return redirect('evaluateshow')->with('message','追评成功');
        } else {
            return redirect('evaluateshow')->with('message', '评价失败');

        }
    }

}



