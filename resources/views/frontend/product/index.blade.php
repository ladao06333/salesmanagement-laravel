@extends('frontend.layouts.app2')
@section('content')
@if(session('success'))
<div class="alert alert-success alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-check"></i>Thông báo</h4>
    {{session('success')}}
</div>
@endif

@if($errors->any())
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">x</button>
    <h4><i class="icon fa fa-check"></i>Thông báo!</h4>
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{$error}}</li>
        @endforeach
    </ul>
</div>
@endif

<div id="cart_items">
    <div class="table-responsive cart_info">
        <table class="table table-condensed">
            <thead>
                <tr class="cart_menu">
                    <td class="id">ID</td>
                    <td class="name">Name</td>
                    <td class="image">image</td>
                    <td class="price">Price</td>
                    <td class="total">Action</td>
                    <td></td>
                </tr>
            </thead>
            <tbody>
                @foreach ($product as $item)
                <?php 
                      $getArrImage = json_decode($item['hinhanh'], true);
                    //   echo $getArrImage[0];
                ?>

                <tr>
                    <td class="id">
                        <h4>{{$item->id}}</h4>
                    </td>
                    <td class="name">
                        <h4>{{$item->name}}</h4>
                    </td>
                    <td class="image">
                        {{-- <a href=""><img style="width: 100px" src="{{asset('admin/upload/product/')}}" alt=""></a>
                        --}}
                        <a href=""><img style="width: 100px" src="{{asset('upload/product/'.$getArrImage[0])}}"
                                alt=""></a>
                    </td>
                    <td class="cart_price">
                        <p>{{$item->price}}</p>
                    </td>
                    <td class="edit">
                        <a class="cart_quantity_delete" href="{{URL::to('/account/product/edit/'.$item->id)}}"><i
                                class="fa fa-edit"></i></a>
                    </td>
                    <td class="delete">
                        <a class="cart_quantity_delete" href="{{URL::to('/account/product/delete/'.$item->id)}}"><i
                                class="fa fa-times"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<a class="btn btn-primary" href="{{URL::to('/account/product/add')}}">Add Product</a>
@endsection