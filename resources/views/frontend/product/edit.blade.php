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
<div class="signup-form" style="margin:0 0 50px 200px">
    <h2>Create product</h2>
    <form class="form-horizontal form-material" role="form" action="{{URL::to('/account/product/edit/'.$product->id)}}"
        method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" placeholder="{{$product->name}}" name="name" id="name" value="{{ old('name') }}">
        <input type=" text" placeholder="{{$product->price}}" name="price" id="price" value="{{ old('price') }}">
        <div class=" form-group">
            <label class="col-sm-12">Category</label>
            <div class="col-sm-12">
                <select name="category" id="category" placeholder="Price">
                    @foreach ($category as $item)
                    <option value="{{$item->id}}" @if ($product->id_category == $item->id) selected="selected" @endif>
                        {{$item->name}}</option>
                    {{-- a==?: --}}
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12">Brand</label>
            <div class="col-sm-12">
                <select name="brand" id="brand">
                    @foreach ($brand as $item)
                    <option value="{{$item->id}}" @if ($product->id_brand == $item->id)
                        selected="selected" @endif>
                        {{$item->name}}</option>
                    {{-- a==?: --}}
                    @endforeach
                </select>
            </div>
        </div>
        <select name="status" id="status">
            <option value="0">New</option>
            <option class="sale" value="1">Sale</option>
        </select>
        {{-- <div style="display: none " id="phantram">
            <input type="text">
        </div> --}}


        <input type="hidden" name="sale" id="sale" value="{{old ('sale')}}" placeholder="{{$product->sale}}">
        <input type="text" placeholder="{{$product->company}}" name="companyprofile" id="companyprofile"
            value="{{old ('companyprofile')}}">
        <div class="form-group">
            <div class="col-md-12">
                <label>Upload image</label>
                <input type="file" class="form-control" name="hinhanh[]" id="hinhanh" multiple>
                @if ($getArrImage != null)
                @foreach($getArrImage as $img)
                <div id="xoa">
                    <img style="max-width: 100px;" src="{{asset('upload/product/'.$img) }} " alt="placeholder+image">
                    <input type="checkbox" id="xoa" name="xoa[]" value="{{$img}}">
                </div>
                {{-- <ul>
                    <li><input type="checkbox" id="cb1" />
                        <label for="cb1"><img src="{{asset('admin/upload/product/'.$img) }}" /></label>
                    </li>
                    <li><input type="checkbox" id="cb2" />
                        <label for="cb2"><img src="{{asset('admin/upload/product/'.$img) }}" /></label>
                    </li>
                    <li><input type="checkbox" id="cb3" />
                        <label for="cb3"><img src="{{asset('admin/upload/product/'.$img) }}" /></label>
                    </li>
                </ul> --}}
                @endforeach
                @endif


            </div>
        </div>

        <textarea type="text" placeholder="Detail" name="detail" id="detail"
            value="{{old ('detail')}}">{{$product->detail}}</textarea>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success">Update Product</button>
            </div>
        </div>

    </form>
</div>
<script>
    // $(document).ready(function(){
    //     $a = $( "#sale option:selected" ).val();
    //    console.log($a);
    // })
    //  $(document).ready(function() {

    //     $(".btn-success").click(function(){ 
    //         var html = $(".clone").html();
    //         $(".increment").after(html);
    //     });

    //     $("body").on("click",".btn-danger",function(){ 
    //         $(this).parents(".control-group").remove();
    //     });

    //   });

 
   $('#status').change(function(){
    $a = $( "#status option:selected" ).val();
       console.log($a);
    if($a == '1'){
        // console.log(true);
        // $('#phantram').get(0).type = 'text';
        $('input#sale').attr('type', 'text');
        // $('div#phantram').attr('type', 'display: block ');
    } else {
        // console.log(false);
        $('input#sale').attr('type', 'hidden');
        // $('div#phantram').attr('type', 'display: none ');
    }
   });
</script>
@endsection