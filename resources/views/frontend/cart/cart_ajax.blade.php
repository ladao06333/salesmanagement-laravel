@extends('frontend.layouts.app');
@section('content')
@if(isset($value))
<section id="cart_items">
    {{-- <div class="container"> --}}
        <div class="breadcrumbs">
            <ol class="breadcrumb">
                <li><a href="{{URL::to('/')}}">Home</a></li>
                <li class="active">Shopping Cart</li>
            </ol>
        </div>
        <div class="table-responsive cart_info">
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
                    {{-- @php
                    foreach ($value as $key => $item) {
                    echo $item['id'];
                    }
                    @endphp --}}
                    @foreach ($value as $key => $item)
                    <form method="post" enctype="multipart/form-data">
                        @csrf
                        <tr>
                            <td class="cart_product">
                                <a href=""><img style="width: 80px" src="{{URL::to('upload/product/'.$item['image'])}}"
                                        alt=""></a>
                            </td>
                            <td hidden class="id" id="<?php echo $item['id']; ?>">
                                <?php echo $item['id']; ?>
                            </td>
                            <td class="cart_description">
                                <h4><a href="">{{$item['name']}}</a></h4>
                            </td>
                            <td class="cart_price">
                                <p>{{$item['price']}}</p>
                            </td>
                            <td class="cart_quantity">
                                <div class="cart_quantity_button">
                                    <a class="cart_quantity_up"> + </a>
                                    <input class="cart_quantity_input" type="text" name="quantity"
                                        value="{{$item['qty']}}" autocomplete="off" size="2">
                                    <a class="cart_quantity_down"> - </a>
                                </div>
                            </td>
                            <td class="cart_total">
                                <p class="cart_total_price">
                                    {{$item['price']*$item['qty']}}
                                </p>
                            </td>
                            <td class="cart_delete">
                                <a class="cart_quantity_delete"><i class="fa fa-times"></i></a>
                            </td>
                        </tr>
                    </form>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{--
    </div> --}}
</section>
@else
<section id="cart_items">
    <div class="breadcrumbs">
        <ol class="breadcrumb">
            <li><a href="#">Home</a></li>
            <li class="active">Shopping Cart</li>
        </ol>
    </div>
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="description">Hình ảnh</td>
                    <td class="image">Mô tả</td>
                    <td class="description">Giá</td>
                    <td class="quantity">Số lượng</td>
                    <td class="total">Tổng</td>
                    <td></td>
                </tr>
            </thead>
        </table>
        <h3>Giỏ hàng trống</h3>
    </div>
</section>
<!--/#cart_items-->
@endif

<section id="do_action">
    <div class="container">

        <div class="row">

            <div class="col-sm-6">
                <div class="total_area">
                    <ul>
                        {{-- <li>Tổng <span></span></li> --}}
                        {{-- <li>Thuế <span>{{Cart::tax().' '.'vnđ'}}</span></li> --}}
                        <li>Thuế <span>0</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền
                            <span class="total">
                                @if(isset($value))
                                <?php 
									$tong = 0;
									foreach ($value as $key => $item) { 
									$price = $item['price']*$item['qty'];
									$tong += $price;
									}
									echo $tong;
								?>
                                @endif
                            </span>
                        </li>
                        @if(Auth::check())
                        @if(isset($value))
                        <a class="btn btn-default check_out" href="{{ url('/sendmail')}}">Check Out</a>
                        @else
                        <h3>Bạn chưa có sản phẩm để thanh toán</h3>
                        <a href="{{ url('/')}}">Quay lại mua sắm</a>
                        @endif
                        @else
                        <h3> Vui lòng đăng nhập để thanh toán </h3>
                        <a class="btn btn-default get" href="{{ url('/member/login')}}">Đăng nhập</a>
                        @endif
                    </ul>
                    {{-- <a class="btn btn-default update" href="">Update</a> --}}




                </div>
            </div>
        </div>
    </div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
    //   alert('a');
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN':$('meta[name="crsf-token"]').attr('content'),
    //     }
    // });
    function show_cart_menu(){
                $.ajax({
                    url:"{{url('show-cart')}}",
                    method:"GET",
                    success:function(data){
                        $('#show-cart').html(data);
                    }
                });
    }
    $("a.cart_quantity_up").click(function(){
        var id = $(this).closest('tr').find('.id').attr('id');
        // alert(id);
  
        //khi click thi tang qty
        $(this).closest('tr').find('.cart_quantity_input').attr('value',parseInt($(this).closest('tr').find('.cart_quantity_input').attr('value'))+ 1);
        var value = $(this).closest('tr').find('.cart_quantity_input').attr("value");
        // alert(value);
        var total = parseInt($(this).closest('tr').find('.cart_price').text()) * value;
        // alert(total);
      
        //tong
        $(this).closest('tr').find('.cart_total_price').text(total);
        // var a = $("span.total").text();
        // var a = parseInt($("span.total").text() + $(this).closest('tr').find('.cart_price').text());
        // alert(a);
        $("span.total").text(parseInt($("span.total").text())+ parseInt($(this).closest('tr').find('.cart_price').text()));
        $.ajax({
            method:"POST",
            url: "{{url('update-cart-ajax')}}",
            data: {
                id:id,
                up:true,
                value:value,
                _token: '{{csrf_token()}}',
            },
            success: function(data){
             
            }
        });
    });
  
    $("a.cart_quantity_down").click(function(){
        var id = $(this).closest('tr').find('.id').attr('id');
        // alert(id);
  
        //khi click thi tang qty
        $(this).closest('tr').find('.cart_quantity_input').attr('value',parseInt($(this).closest('tr').find('.cart_quantity_input').attr('value')) - 1);
        
        var value = $(this).closest('tr').find('.cart_quantity_input').attr("value");
        // alert(value);
        if(value == 0){
            $(this).closest('tr').remove();
        }
        var total = parseInt($(this).closest('tr').find('.cart_price').text()) * value;
        // alert(total);

      
        //tong
        $(this).closest('tr').find('.cart_total_price').text(total);
        // var a = $("span.total").text();
        // var a = parseInt($("span.total").text() + $(this).closest('tr').find('.cart_price').text());
        // alert(a);
        $("span.total").text(parseInt($("span.total").text())- parseInt($(this).closest('tr').find('.cart_price').text()));
     
        $.ajax({
            method:"POST",
            url: "{{url('update-cart-ajax')}}",
            data: {
                id:id,
                down:true,
                value:value,
                _token: '{{csrf_token()}}',
            },
            success: function(data){
            }
        });
    });
    $("a.cart_quantity_delete").click(function(){
        var id = $(this).closest('tr').find('.id').attr('id');

        $(this).closest('tr').remove();

        var total = parseInt($(this).closest('tr').find('.cart_total').text());
        // alert(total);
        $("span.total").text(parseInt($("span.total").text()) - parseInt($(this).closest('tr').find('.cart_total').text()));
        $.ajax({
            method: 'POST',
            url: "{{url('update-cart-ajax')}}",
            data : {
                id:id,
                delete:true,
                _token: '{{csrf_token()}}',
            },
            success: function(data){
                // console.log(data);
                show_cart_menu();
            }
        });
    });

    });
</script>
<!--/#do_action-->
@endsection