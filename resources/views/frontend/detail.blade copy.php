@extends('frontend.layouts.app')
@section('content')
<script>
    $(document).ready(function(){
        $('#addCart').click(function(){
            // alert('cart');
            var id = $(this).data("index");
            console.log(id);
        });
 
            $.ajax({
                url: "{{url('add-to-cart')}}",
                method:"POST",
                data:{
                    product_id: id,
                    "_token": "{{ csrf_token() }}",
                },
                success:function(data){
                    if(data == 'done'){
                        alert();
                    } else {
                        alert();
                    }
                }
            });
        });
</script>
<div class="product-details">
    <!--product-details-->

    <div class="col-sm-5">
        <div class="view-product anhlon">
            <img src="{{asset('/upload/product/'.$getArrImage[0])}}">
            <a href="{{asset('/upload/product/hinh200_'.$getArrImage[0])}}" rel="prettyPhoto">
                <h3>ZOOM</h3>
            </a>

        </div>
        <div id="similar-product" class="carousel slide" data-ride="carousel">
            <!-- Wrapper for slides -->
            <div class="carousel-inner">
                <div class="item">
                    <img style="width: 80px" src="{{asset('upload/product/'.$getArrImage[0])}}" alt="">
                    <img style="width: 80px" src="{{asset('upload/product/'.$getArrImage[1])}}" alt="">
                    <img style="width: 80px" src="{{asset('upload/product/'.$getArrImage[2])}}" alt="">
                </div>
                {{-- <div class="item">
                    <a href=""><img src="{{asset('frontend/images/product-details/similar1.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar2.jpg')}}" alt=""></a>
                    <a href=""><img src="{{asset('frontend/images/product-details/similar3.jpg')}}" alt=""></a>
                </div> --}}
                <div class="item active">
                    <img style="width: 80px" src="{{asset('upload/product/'.$getArrImage[0])}}"
                        alt="{{asset('/upload/product/hinh200_'.$getArrImage[0])}}">
                    <img style="width: 80px" src="{{asset('upload/product/'.$getArrImage[1])}}"
                        alt="{{asset('/upload/product/hinh200_'.$getArrImage[1])}}">
                    <img style="width: 80px" src="{{asset('upload/product/'.$getArrImage[2])}}"
                        alt="{{asset('/upload/product/hinh200_'.$getArrImage[2])}}">
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
            {{-- <form action="{{URL::to('/save-cart')}}" method="POST">
                @csrf
                <span>
                    <span>{{number_format($product->price).'VNĐ'}}</span>
                    <label>Quantity:</label>
                    <input name="qty" type="number" min="1" value="1">
                    <input name="productid_hidden" type="hidden" value=" {{$product->id}}">
                    <button id="addCart" type="sumbit" class="btn btn-fefault cart" data-index="{{$product->id}}">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </span>
            </form> --}}
            {{-- <form>
                @csrf --}}
                <span>
                    <span>{{number_format($product->price).'VNĐ'}}</span>
                    <label>Quantity:</label>
                    <input name="qty" type="number" min="1" value="1">
                    {{-- <input name="productid_hidden" type="hidden" value=" {{$product->id}}"> --}}
                    <button id="addCart" type="button" class="btn btn-fefault cart" data-index="{{$product->id}}">
                        <i class="fa fa-shopping-cart"></i>
                        Add to cart
                    </button>
                </span>
                {{--
            </form> --}}
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
        <div class="category-tab shop-details-tab">
            <!--category-tab-->
            <div class="col-sm-12">
                <ul class="nav nav-tabs">
                    <li class="active"><a href="#details" data-toggle="tab">Mô tả</a></li>
                    <li><a href="#companyprofile" data-toggle="tab">Chi tiết sản phẩm</a></li>

                    <li><a href="#reviews" data-toggle="tab">Đánh giá</a></li>
                </ul>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade active in" id="details">
                    <p>{!!$product->detail!!}</p>

                </div>

                <div class="tab-pane fade" id="companyprofile">
                    <p>{!!$product->company!!}</p>


                </div>

                <div class="tab-pane fade" id="reviews">
                    <div class="col-sm-12">
                        <ul>
                            <li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
                            <li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
                            <li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
                        </ul>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore
                            et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris
                            nisi ut
                            aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit
                            esse
                            cillum dolore eu fugiat nulla pariatur.</p>
                        <p><b>Write Your Review</b></p>

                        <form action="#">
                            <span>
                                <input type="text" placeholder="Your Name" />
                                <input type="email" placeholder="Email Address" />
                            </span>
                            <textarea name=""></textarea>
                            <b>Rating: </b> <img src="images/product-details/rating.png" alt="" />
                            <button type="button" class="btn btn-default pull-right">
                                Submit
                            </button>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("a[rel^='prettyPhoto']").prettyPhoto();
    });
    $(document).ready(function(){            
        $("img").click(function(){
        var src =$(this).attr("src");
        //    console.log(src);
        var alt =$(this).attr("alt");
                   console.log(alt);
        $("div.anhlon img").attr("src", src);
        $("div.anhlon a").attr("href", alt);
        });
    });
</script>
@endsection