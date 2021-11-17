@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Add Blog</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Blog</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>
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
<div class="col-12">
    <div class="card">
        <div class="card-body">
            <form class="form-horizontal form-material" role="form" action="{{URL::to('/blog/add')}}" method="post"
                enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="country" class="col-md-12"><b>Title(*)</b></label>
                    <div class="col-md-12">
                        <input type="text" placeholder="" class="form-control form-control-line" name="title" id="title"
                            value="{{old('title')}}">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Upload avatar</label>
                        <input type="file" class="form-control" name="image" id="image">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Description</label>
                        <textarea class="form-control" rows="5" name="description"
                            id="description">{{old('description')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-12">
                        <label>Content</label>
                        <textarea name="content" id="" cols="30" class="form-control"
                            id="content">{{old('content')}}</textarea>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">Create Blog</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

</div>
<script src="{{ asset('admin/ckeditor/ckeditor.js') }}"></script>
<script>
    CKEDITOR.replace('content', {
        filebrowserBrowseUrl:' {{asset('admin/ckfinder/ckfinder.html') }}',
        filebrowserImageBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Images') }}',
        filebrowserFlashBrowseUrl: '{{ asset('admin/ckfinder/ckfinder.html?type=Flash') }}',
        filebrowserUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files') }}',
        filebrowserImageUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images') }}',
        filebrowserFlashUploadUrl: '{{ asset('admin/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash') }}'
    });

</script>

@endsection