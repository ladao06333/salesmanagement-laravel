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
    <h2>Update profile</h2>
    <form class="form-horizontal form-material" role="form" action="{{URL::to('/account/save-profile')}}" method="post"
        enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label class="col-md-12">Full Name</label>
            <div class="col-md-12">
                <input type="text" placeholder="{{$profile->name}}" class="form-control form-control-line" name="name"
                    id="name">
            </div>
        </div>
        <div class="form-group">
            <label for="example-email" class="col-md-12">Email</label>
            <div class="col-md-12">
                <input type="email" placeholder="{{$profile->email}}" class="form-control form-control-line"
                    name="email" id="email">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Password</label>
            <div class="col-md-12">
                <input type="password" name="password" class="form-control form-control-line">
            </div>
        </div>
        <div class="form-group">
            <label class="col-md-12">Phone</label>
            <div class="col-md-12">
                <input type="text" placeholder="{{$profile->phone}}" class="form-control form-control-line" name="phone"
                    id="phone">
            </div>
        </div>
        <div class="form-group">
            <div class="col-md-12">
                <label>Upload avatar</label>
                <input type="file" class="form-control" name="avatar" id="avatar">
            </div>
        </div>
        {{-- <div class="form-group">
            <label class="col-md-12">Message</label>
            <div class="col-md-12">
                <textarea rows="5" class="form-control form-control-line"></textarea>
            </div>
        </div> --}}
        <div class="form-group">
            <label class="col-md-12">Addresss</label>
            <div class="col-md-12">
                <input type="text" placeholder="{{$profile->address}}" class="form-control form-control-line"
                    name="address" id="address">
            </div>
        </div>
        <div class="form-group">
            <label class="col-sm-12">Country</label>
            <div class="col-sm-12">
                {{-- <input type="text" placeholder="{{$profile->country}}" class="form-control form-control-line"
                    name="country" id="country"> --}}
                <select class="form-control form-control-line" name="country">
                    @foreach ($country as $item)
                    <option value="{{$item->id}}" @if ($profile->country == $item->id)
                        selected="selected" @endif>
                        {{$item->name}}</option>
                    {{-- a==?: --}}
                    @endforeach
                </select>
            </div>
        </div>
        <div class="form-group">
            <div class="col-sm-12">
                <button class="btn btn-success">Update Profile</button>
            </div>
        </div>
    </form>
</div>
@endsection