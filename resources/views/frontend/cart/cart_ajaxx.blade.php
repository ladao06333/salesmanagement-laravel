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
                    {{-- @foreach ($content as $item) --}}
                    @php
                    // print_r(Session::get('cart'));
                    @endphp
                    @foreach (Session::get('cart') as $key => $cart)
                    {{$cart}}

                    <tr>
                        <td class="cart_product">
                            <a href=""><img style="width: 80px" src="{{URL::to('upload/product/')}}" alt=""></a>
                        </td>
                        <td class="cart_description">
                            <h4><a href=""></a></h4>
                            {{-- <p>{{$cart['name']}}</p> --}}
                        </td>
                        <td class="cart_price">
                            <p></p>
                        </td>
                        <td class="cart_quantity">
                            <div class="cart_quantity_button">
                                <a class="cart_quantity_up" href=""> + </a>
                                <input class="cart_quantity_input" type="text" name="quantity" value=""
                                    autocomplete="off" size="2">
                                <a class="cart_quantity_down" href=""> - </a>
                            </div>
                        </td>
                        <td class="cart_total">
                            <p class="cart_total_price">

                            </p>
                        </td>
                        <td class="cart_delete">
                            <a class="cart_quantity_delete" href=""><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    {{-- @endforeach --}}
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
                        <li>Tổng <span></span></li>
                        {{-- <li>Thuế <span>{{Cart::tax().' '.'vnđ'}}</span></li> --}}
                        <li>Thuế <span>0</span></li>
                        <li>Phí vận chuyển <span>Free</span></li>
                        <li>Thành tiền <span></span></li>
                    </ul>
                    {{-- <a class="btn btn-default update" href="">Update</a> --}}

                    <a class="btn btn-default check_out" href="">Thanh toán</a>

                    <a class="btn btn-default check_out" href="">Thanh toán</a>




                </div>
            </div>
        </div>
    </div>
</section>
<!--/#do_action-->
@endsection