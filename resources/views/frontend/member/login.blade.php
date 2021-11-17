@extends('frontend.layouts.app')
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
<div class="login-form">
    <!--login form-->
    <h2>Login to your account</h2>
    <form action="{{URL::to('/member/login')}}" method="post">
        @csrf
        <input type="email" name="email" placeholder="Email Address">
        <input type="password" name="password" placeholder="Password">
        <span>
            <input type="checkbox" class="checkbox" name="remember_me">
            Keep me signed in
        </span>
        <button type="submit" class="btn btn-default">Login</button>
    </form>
</div>
@endsection