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
                                <h2>{{$item->price}}</h2>
                                <p>{{$item->name}}</p>
                                {{-- <a href="#" class="btn btn-default add-to-cart"><i
                                        class="fa fa-shopping-cart"></i>Add
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
</div>
{{-- <script>
    $(document).ready(function(){
        $('.slider-track').click(function(){
            var priceRage = $('.tooltip-inner').text();
            // console.log(priceRage);
            // console.log('a');
            var tach = [];
            tach = priceRage.split(':');
            // console.log(arr);
            $.ajax({
                method:'POST',
                url:'priceRage',
                data:{
                    price:tach,
                    _token: '{{csrf_token()}}',
                },
                success:function(response){
                    if(response.product){
				 		var html = "";
				 		var newArr = response.product;
				 		newArr.map(function(product){
				 			var image = jQuery.parseJSON(product['image']);
						if(product['sale'] != 0){
								 sale_price = product['price'] *((100-product['sale'])/100);
						}else {
							sale_price = product['price'];
						}	
				 			html += '<div class="product-view col-sm-4 ">'+
				 					'<div class="product-image-wrapper"> '+
				 					'<div class="single-products"style="padding-right:10px">' +
				 					'<div class="productinfo text-center">'+
				 						'<img width="100" height="70" src="/upload/user/product_img/'+image[0]+'">'+
				 							'<h2>'+ sale_price +'</h2>'+
				 							'<p>'+product['name']+'</p> '+
				 							'<a href="#" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart">'+
				 					'</div>'+
				 					
				 					'</div>'+
				 					'</div>'+
						 			'</div>';
				 		})
				 		$('.features_items').html(html);
				 		
				 	}
                }
            });
        });
    });
</script> --}}
@endsection