@extends('admin.layouts.app')
@section('content')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-5 align-self-center">
            <h4 class="page-title">Category</h4>
        </div>
        <div class="col-7 align-self-center">
            <div class="d-flex align-items-center justify-content-end">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="#">Home</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Category</li>
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
        {{-- <div class="card-body">
            <h4 class="card-title">Table Header</h4>
            <h6 class="card-subtitle">Similar to tables, use the modifier classes .thead-light to make
                <code>&lt;thead&gt;</code>s appear light.
            </h6>
        </div> --}}
        <div class="table-responsive">
            <table class="table">
                <thead class="thead-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Name</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($category as $key => $category)
                    <tr>
                        <th scope="row">{{$category->id}}</th>
                        <td>{{$category->name}}</td>
                        <td><a href="{{URL::to('/country/delete/'.$category->id)}}">Delete</a></td>

                    </tr>
                    @endforeach
                </tbody>

            </table>
        </div>
    </div>
</div>
<div class="form-group">
    <div class="col-sm-12">
        <a class="btn btn-success" href="{{URL::to('/category/add')}}">Add Category</a>
    </div>
</div>
@endsection