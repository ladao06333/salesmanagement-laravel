@extends('templates.master')

@section('title','Thêm cầu thủ')

@section('content')

<div class="page-header">
    <h4>Quản lý cầu thủ</h4>
</div>

<?php //Hiển thị thông báo thành công
?>
@if ( Session::has('success') )
<div class="alert alert-success alert-dismissible" role="alert">
    <strong>{{ Session::get('success') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
@endif

<?php //Hiển thị thông báo lỗi
?>
@if ( Session::has('error') )
<div class="alert alert-danger alert-dismissible" role="alert">
    <strong>{{ Session::get('error') }}</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        <span class="sr-only">Close</span>
    </button>
</div>
@endif

<?php //Form thêm mới học sinh
?>
<p><a class="btn btn-primary" href="{{ url('/player') }}">Về danh sách</a></p>
<div class="col-xs-4 col-xs-offset-4">
    <center>
        <h4>Thêm cầu thủ</h4>
    </center>
    <form action="{{ url('/player/create') }}" method="POST">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="name">Tên cầu thủ</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Tên cầu thủ" maxlength="255" required />
        </div>
        <div class="form-group">
            <label for="age">Tuổi</label>
            <input type="text" class="form-control" id="age" name="age" placeholder="Tuổi" maxlength="15" required />
        </div>
        <div class="form-group">
            <label for="age">Quốc gia</label>
            <input type="text" class="form-control" id="national" name="national" placeholder="Quốc gia" maxlength="15" required />
        </div>
        <div class="form-group">
            <label for="age">Vị Trí</label>
            <input type="text" class="form-control" id="position" name="position" placeholder="Vị Trí" maxlength="15" required />
        </div>
        <div class="form-group">
            <label for="age">Lương</label>
            <input type="text" class="form-control" id="salary" name="salary" placeholder="Lương" maxlength="15" required />
        </div>
        <center><button type="submit" class="btn btn-primary">Thêm</button></center>
    </form>
</div>

@endsection