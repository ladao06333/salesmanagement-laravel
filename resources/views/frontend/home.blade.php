@extends('frontend.layouts.app')
@section('content')
<div class="features_items">
    <!--features_items-->
    <h2 class="title text-center">Features Items</h2>
    @foreach ($product as $item)
    <?php 
    $getArrImage = json_decode($item->hinhanh, true);
    // echo $getArrImage[1];
?>
    <div class="col-sm-4">
        <a href="{{URL::to('/detail/'.$item->id)}}">
            <div class="product-image-wrapper">
                <div class="single-products">
                    <div class="productinfo text-center">
                        <img src="{{asset('admin/upload/product/'.$getArrImage[2])}}" alt="">
                        <h2>{{$item->price}}</h2>
                        <p>{{$item->name}}</p>
                        <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                            cart</a>
                    </div>
                    {{-- <div class="product-overlay">
                        <div class="overlay-content">
                            <h2>{{$item->price}}</h2>
                            <p>{{$item->name}}</p>
                            <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add to
                                cart</a>
                        </div>
                    </div> --}}
                </div>
                <div class="choose">
                    <ul class="nav nav-pills nav-justified">
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to wishlist</a></li>
                        <li><a href="#"><i class="fa fa-plus-square"></i>Add to compare</a></li>
                    </ul>
                </div>
            </div>
        </a>
    </div>
    @endforeach
</div>
@endsection