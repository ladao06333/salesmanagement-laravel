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
<div class="signup-form">
    <!--sign up form-->
    <h2>New User Signup!</h2>
    <form action="{{URL::to('/member/register')}}" method="post" enctype="multipart/form-data">
        @csrf
        <input type="text" name="name" placeholder="Name">
        <input type="email" name="email" placeholder="Email Address">
        <input type="text" name="phone" placeholder="Phone">
        <input type="password" name="password" placeholder="Password">
        <input type="password" name="password_confirmation" placeholder="Confirm Password">
        <input type="file" class="form-control" name="avatar" id="avatar">
        <input type="text" name="address" placeholder="Address">
        <select class="form-control form-control-line" name="country">
            @foreach ($country as $item)
            <option value="{{$item->id}}">
                {{$item->name}}</option>
            {{-- a==?: --}}
            @endforeach
        </select>
        <button type="submit" class="btn btn-default">Signup</button>
    </form>
</div>
@endsection