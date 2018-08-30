@extends('common.home')

<div class="container " style="position: absolute;top:15%;">
    <div class="row">
        <div class="col-sm-4 col-sm-offset-5">
            @if(Session::has('message'))
                <h3 style="color:red;">{{Session::get('message')}}</h3>
            @endif
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <img src="{{$messageRes['array']['image'] }}" alt="product" class="img-responsive" style="width:95%;height:38%;">
        </div>
        <div class="col-sm-8">
            <h3 style="color:red;">￥{{ $messageRes['array']['discount'] }}</h3>
            <p>原价:<s>￥{{$messageRes['array']['price']}}</s></p>
            <h4>{{$messageRes['array']['name']}}</h4>
            <p>{{$messageRes['array']['title']}}</p>
            <p>{{$messageRes['array']['description']}}</p>

            <div class="col-sm-2">
                <a href="{{url('shopshow')}}?shop_id={{$messageRes['array']['shop_id']}}" class="btn btn-primary " role="button">店铺</a></div>
                <div class="col-sm-2">
           @if($messageRes['arr']['already']==0)
                <form name="form" action="{{url('collectionpost')}}" method="post">
                    <input type="hidden" name="product_id" value="{{$messageRes['array']['id']}}">
                    <input type="hidden" name="shop_id" value="{{ $messageRes['array']['shop_id']}}">
                    <input type="hidden" name="name" value="{{$messageRes['array']['name']}}">
                    <input type="hidden" name="collection" value="{{$messageRes['array']['collection']}}">
                    <input type="hidden" name="price" value="{{$messageRes['array']['price']}}">
                    <input type="hidden" name="discount" value="{{ $messageRes['array']['discount']}}">
                    <input type="hidden" name="title" value="{{$messageRes['array']['title']}}">
                    <input type="hidden" name="image" value="{{ $messageRes['array']['image']}}">
                    <input type="hidden" name="description" value="{{$messageRes['array']['collection']}}">
                    <input type="hidden" name="_token" value="{{csrf_token()}}">
                    <button id="submit" class="btn btn-primary ">收藏</button>
                </form>
            @else
                    <p style="margin-top:10%;">已收藏</p>
            @endif
                </div>
            <div class="col-sm-3">
            <form name="form" action="" method="post">
                <input type="hidden" name="id" value="{{$messageRes['array']['id']}}">
                <input type="hidden" name="user_id" value="{{$messageRes['array']['user_id']}}">
                <input type="hidden" name="shop_id" value="{{$messageRes['array']['shop_id']}}">
                <input type="hidden" name="shop_name" value="{{$messageRes['array']['shop_name']}}">
                <input type="hidden" name="name" value="{{$messageRes['array']['name']}}">
                <input type="hidden" name="price" value="{{ $messageRes['array']['price']}}">
                <input type="hidden" name="image" value="{{$messageRes['array']['image']}}">
                <input type="hidden" name="description" value="{{ $messageRes['array']['description']}}">
                <input type="hidden" name="_token" value="{{ csrf_token()}}">
                <button id="submit" class="btn btn-primary ">加入购物车</button>
            </form>
            </div>
            <div class="col-sm-3">
            <form name="form" action="{{url('form')}}" method="post">
                <input type="hidden" name="id" value="{{$messageRes['array']['id']}}">
                <input type="hidden" name="shop_id" value="{{ $messageRes['array']['shop_id']}}">
                <input type="hidden" name="shop_name" value="{{ $messageRes['array']['shop_name']}}">
                <input type="hidden" name="name" value="{{ $messageRes['array']['name']}}">
                <input type="hidden" name="title" value="{{ $messageRes['array']['title']}}">
                <input type="hidden" name="price" value="{{$messageRes['array']['price']}}">
                <input type="hidden" name="discount" value="{{ $messageRes['array']['discount']}}">
                <input type="hidden" name="address" value="{{ $messageRes['array']['address']}}">
                <input type="hidden" name="image" value="{{ $messageRes['array']['image']}}">
                <input type="hidden" name="color" value="{{$messageRes['array']['color']}}">
                <input type="hidden" name="_token" value="{{csrf_token()}}">
                <button id="submit" class="btn btn-primary " >立即购买</button>
            </form>
            </div>

        </div>
    </div>
  <h4 align="center">--------推荐---------</h4>
    @foreach ($maylike->chunk(4) as $items)
        <div class="row">
            @foreach ($items as $product)
                <div class="col-sm-3">
                    <div class="thumbnail">
                        <div class="caption text-center">
                            <a href="http://localhost:8000/product?id={{$product->id}}">
                                <img src="{{ $product->image}} " style="height:30%;"></a>
                            <a href="http://localhost:8000/product?id={{$product->id}}">
                                <h3>{{ $product->name}}</h3></a>
                            @if(session('business')==1)
                                <a href="http://localhost:8000/myshop?shop_id={{$product->shop_id}}">
                                    @else
                                        <a href="http://localhost:8000/shopshow?shop_id={{$product->shop_id}}">
                                            @endif
                                            {{$product->shop_name}}</a></a>
                                <p style="color:red;">￥{{ $product->discount }}</p>
                        </div> <!-- end caption -->
                    </div> <!-- end thumbnail -->
                </div> <!-- end col-md-3 -->
            @endforeach
        </div> <!-- end row -->
    @endforeach
</div>

