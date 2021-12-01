@extends('frontend.layouts.app');
@section('content')
<section id="cart_items">
	{{-- <div class="container"> --}}
		<div class="breadcrumbs">
			<ol class="breadcrumb">
				<li><a href="{{URL::to('/')}}">Home</a></li>
				<li class="active">Shopping Cart</li>
			</ol>
		</div>
		<div class="table-responsive cart_info">
			<?php
			$content = Cart::content();
			    //  echo '<pre>';
        // print_r($content);
        // echo '</pre>';
			?>
			<table class="table table-condensed">
				<thead>
					<tr class="cart_menu">
						<td class="image">Hình ảnh</td>
						<td class="description">Mô tả</td>
						<td class="price">Giá</td>
						<td class="quantity">Số lượng</td>
						<td class="total">Tổng</td>
						<td></td>
					</tr>
				</thead>
				<tbody>
					@foreach ($content as $item)

					<tr>
						<td class="cart_product">
							<a href=""><img style="width: 80px"
									src="{{URL::to('upload/product/'.$item->options->image)}}" alt=""></a>
						</td>
						<td class="cart_description">
							<h4><a href="">{{$item->name}}</a></h4>
							<p>Web ID: 1089772</p>
						</td>
						<td class="cart_price">
							<p>{{number_format($item->price).' '.'VND'}}</p>
						</td>
						<td class="cart_quantity">
							<div class="cart_quantity_button">
								<a class="cart_quantity_up" href=""> + </a>
								<input class="cart_quantity_input" type="text" name="quantity" value="{{$item->qty}}"
									autocomplete="off" size="2">
								<a class="cart_quantity_down" href=""> - </a>
							</div>
						</td>
						<td class="cart_total">
							<p class="cart_total_price">
								<?php
								$subtotal = $item->price * $item->qty;
								echo number_format($subtotal).' '.'vnđ';
								?>
							</p>
						</td>
						<td class="cart_delete">
							<a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
						</td>
					</tr>

					@endforeach
				</tbody>
			</table>
		</div>
		{{--
	</div> --}}
</section>
<section id="do_action">
	<div class="container">

		<div class="row">

			<div class="col-sm-6">
				<div class="total_area">
					<ul>
						<li>Tổng <span>{{Cart::total().' '.'vnđ'}}</span></li>
						{{-- <li>Thuế <span>{{Cart::tax().' '.'vnđ'}}</span></li> --}}
						<li>Thuế <span>0</span></li>
						<li>Phí vận chuyển <span>Free</span></li>
						<li>Thành tiền <span>{{Cart::total().' '.'vnđ'}}</span></li>
					</ul>
					{{-- <a class="btn btn-default update" href="">Update</a> --}}
					<?php
                                   $customer_id = Session::get('customer_id');
                                   if($customer_id!=NULL){ 
                                 ?>

					<a class="btn btn-default check_out" href="{{URL::to('/checkout')}}">Thanh toán</a>
					<?php
                            }else{
                                 ?>

					<a class="btn btn-default check_out" href="{{URL::to('/login-checkout')}}">Thanh toán</a>
					<?php 
                             }
                                 ?>



				</div>
			</div>
		</div>
	</div>
</section>
<!--/#do_action-->
@endsection