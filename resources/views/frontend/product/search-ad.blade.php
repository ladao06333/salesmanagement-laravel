@extends('frontend.layouts.app')
@section('content')
<div class="features_items">
    <!--features_items-->

    @if(count($searchProduct) < 1) <h2 class="title text-center">Khong tim thay ket qua can tim kiem</h2>
        @else
        <h2 class="title text-center">Ket qua tim kiem</h2>
        @endif
        <div class="col-sm-12">
            <form action="{{URL::to('/search-ad')}}" method="POST">
                @csrf
                <input class="col-sm-2 search" name="search" type="text" placeholder="Search">
                <select class="col-sm-2 padding-right" name="price" class="form-control form-control-line">
                    <option value="null">Choose price</option>
                    <option value="1-100"> 1->100 </option>
                    <option value="100-500"> 100->500 </option>
                    <option value="500-max"> 500->max </option>
                </select>
                <select class="col-sm-2 padding-right" name="category" class="form-control form-control-line">
                    <option value="null">Category</option>
                    @foreach($allcategory as $key => $value)
                    <option <?php echo "selected" ?>value="{{ $value['id'] }}"> {{ $value['name'] }}
                    </option>
                    @endforeach
                </select>
                <select class="col-sm-2 padding-right" name="brand">
                    <option value="null">Brand</option>
                    @foreach($allbrand as $key => $value)
                    <option <?php echo "selected" ?>value="{{ $value['id'] }}"> {{ $value['name'] }}
                    </option>
                    @endforeach
                </select>

                <select class="col-sm-2 padding-right" name="status" id="status">
                    <option value="null">New</option>
                    <option class="sale" value="1">Sale</option>
                </select>
                <button type="submit" class="btn btn-success"> submit</button>
            </form>
        </div>
</div>
@foreach ($searchProduct as $item)
<?php
$getArrImage = json_decode($item->hinhanh, true);
// echo $getArrImage[1];
?>
<div class="col-sm-4">
    {{-- <a href="{{URL::to('/detail/'.$item->id)}}"> --}}
        <div class="product-image-wrapper">
            <div class="single-products">
                <div class="productinfo text-center">
                    <form>
                        @csrf
                        <input type="hidden" value="{{$item->id}}" class="cart_product_id_{{$item->id}}">
                        <input type="hidden" value="{{$item->name}}" class="cart_product_name_{{$item->id}}">
                        <input type="hidden" value="{{$getArrImage[0]}}" class="cart_product_image_{{$item->id}}">
                        <input type="hidden" value="{{$item->price}}" class="cart_product_price_{{$item->id}}">
                        <input type="hidden" value="1" class="cart_product_qty_{{$item->id}}">
                        <a href="{{URL::to('/detail/'.$item->id)}}">
                            <img src="{{asset('upload/product/'.$getArrImage[0])}}" alt="">
                            <?php $price = $item->price *((100-$item->sale)/100); ?>
                            <h2>{{$price}}</h2>
                            @else
                            <h2>{{$item->price}}</h2>
                            @endif
                            <p>{{$item->name}}</p>
                            {{-- <a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>Add
                                to
                                cart</a> --}}
                        </a>
                        <button type="button" class="btn btn-default add-to-cart" data-id_product="{{$item->id}}"
                            name="add-to-cart">Thêm giỏ
                            hàng</button>
                    </form>
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
        {{--
    </a> --}}
</div>
@endforeach
{{-- <p>{{$product->links()}}</p> --}}
</div>

@endsection