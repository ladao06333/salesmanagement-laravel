@extends('frontend.layouts.app')
@section('content')
<div class="product-details">
    <!--product-details-->

    <div class="col-sm-5">
        <div class="view-product anhlon">
            <img src="{{asset('admin/upload/product/'.$getArrImage[0])}}" alt="">
            <a href="{{asset('frontend/images/product-details/1.jpg')}}" rel="prettyPhoto">
                <h3>ZOOM</h3>
            </a>

        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item anhnho">
                    <img src="{{asset('frontend/images/product-details/similar1.jpg')}}" alt="">
                    <img src="{{asset('frontend/images/product-details/similar2.jpg')}}" alt="">
                    <img src="{{asset('frontend/images/product-details/similar3.jpg')}}" alt="">
                </div>
                {{-- <div class="item">
                    <a href=""><img src="{{asset('frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                </div> --}}
                <div class="item active">
                    <img src="{{asset('frontend/images/product-details/similar1.jpg')}}" alt="">
                    <img src="{{asset('frontend/images/product-details/similar2.jpg')}}" alt="">
                    <img src="{{asset('frontend/images/product-details/similar3.jpg')}}" alt="">
                </div>

            </div>

            <!-- Controls -->
            <a class="left item-control" href="#similar-product" data-slide="prev">
                <i class="fa fa-angle-left"></i>
            </a>
            <a class="right item-control" href="#similar-product" data-slide="next">
                <i class="fa fa-angle-right"></i>
            </a>
        </div>

    </div>
    <div class="col-sm-7">
        <div class="product-information">
            <!--/product-information-->
            <img src="images/product-details/new.jpg" class="newarrival" alt="">
            <h2>{{$product->name}}</h2>
            <p>Product ID: {{$product->id}}</p>
            <img src="images/product-details/rating.png" alt="">
            <span>
                <span>{{$product->price}} VND</span>
                <label>Quantity:</label>
                <input type="text" value="1">
                <button type="button" class="btn btn-fefault cart">
                    <i class="fa fa-shopping-cart"></i>
                    Add to cart
                </button>
            </span>
            {{-- <p><b>Availability:</b> In Stock</p> --}}
            <p><b>Condition:</b>@if ($product->status == 0)
                New
                @else
                Sale
                @endif</p>
            <p><b>Brand: </b>{{$brand->name}}</p>
            <a href=""><img src="images/product-details/share.png" class="share img-responsive" alt=""></a>
        </div>
        <!--/product-information-->
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto();
    });
    $(document).ready(function(){            
        $("img").click(function(){
            var src =$(this).attr("src");
            $("div.anhlon img").attr("src", src);
        });
    });
</script>
@endsection