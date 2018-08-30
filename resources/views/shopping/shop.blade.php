@extends('common.home')

<div class="container " style="position: absolute;top:15%;">
    <div class="row">
        <form action="{{url('search')}}" method="post" class="form-group">
            <div class="col-sm-5 col-sm-offset-4">
                <div class="input-group ">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <input type="text" class="form-control" name="name" placeholder="iphone">
                    <p class="input-group-addon" style="background: white;border:0;">
                        <button id="submit" class="btn" style="color:black;margin-top:-10%;">搜索</button>
                    </p>
                </div>
            </div>
        </form>
    </div>
    <ul class="nav nav-pills  col-sm-offset-4">

        <li><a href="{{url('shop')}}">综合排序</a></li>
        <li><a href="{{url('descend')}}?name=asc">价格升序</a></li>
        <li><a href="{{url('descend')}}?name=desc">价格降序</a></li>
        <li><a href="{{url('screen')}}">筛选</a></li>
    </ul>
    <div class="col-sm-7 col-sm-offset-5">
        @if(Session::has('message'))
            <p style="color:red;">{{Session::get('message')}}</p>
        @endif
    </div>
    <br/>
    @foreach ($messageRes->chunk(4) as $items)
        <div class="row">
            @foreach ($items as $product)
                <div class="col-md-3">
                    <div class="thumbnail">
                        <div class="caption text-center">
                            <a href="http://localhost:8000/product?id={{$product->id}}">
                                <img src="{{ $product->image}} " style="height:30%;"></a>
                            <a href="http://localhost:8000/product?id={{$product->id}}" style="text-decoration:none">
                                <h3>{{ $product->name}}</h3></a>
                            @if(session('business')==1)
                                <a href="http://localhost:8000/myshop?shop_id={{$product->shop_id}}"
                                   style="text-decoration:none">
                                    @else
                                        <a href="http://localhost:8000/shopshow?shop_id={{$product->shop_id}}"
                                           style="text-decoration:none">
                                            @endif
                                            {{$product->shop_name}}</a></a>
                                <p style="color:red;">￥{{ $product->discount }}</p>
                        </div> <!-- end caption -->
                    </div> <!-- end thumbnail -->
                </div> <!-- end col-md-3 -->
            @endforeach
        </div> <!-- end row -->
    @endforeach


    <div class="row" style="margin-top:1%;">
        <div class="col-sm-10 col-sm-offset-2" style="background: #d6d8db;">
            <h4 align="center">于2018年8月25日由哈哈哈设计完成</h4>
        </div>
    </div>
</div>


