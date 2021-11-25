@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Add Brand</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Add Brand</li>
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
            <form class="form-horizontal form-material" role="form" action="{{URL::to('/brand/add')}}" method="post">
                @csrf
                <div class="form-group">
                    <label for="country" class="col-md-12">Name</label>
                    <div class="col-md-12">
                        <input type="text" placeholder="" class="form-control form-control-line" name="name" id="name">
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <button class="btn btn-success">Save Brand</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection