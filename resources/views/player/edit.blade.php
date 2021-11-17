@extends('templates.master')

@section('title','Thêm cầu thủ')

@section('content')

<div class="page-header">
    <h4>Quản lý cầu thủ</h4>
</div>


@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<p><a class="btn btn-primary" href="{{ url('/player') }}">Về danh sách</a></p>
<div class="col-xs-4 col-xs-offset-4">
    <center>
        <h4>Sửa cầu thủ</h4>
    </center>


    <form method="POST">
        {{ csrf_field() }}
        <input type="hidden" class="form-control" id="id" name="id" placeholder="Id" maxlength="255" value="{{ $getPlayerById[0]->id }}" required />
        <div class="form-group">
            <label for="name">Tên cầu thủ</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Tên cầu thủ" maxlength="255" value="{{ $getPlayerById[0]->name }}" required />
        </div>
        <div class="form-group">
            <label for="age">Tuổi</label>
            <input type="text" class="form-control" id="age" name="age" placeholder="Tuổi" maxlength="15" value="{{ $getPlayerById[0]->age }}" required />
        </div>
        <div class="form-group">
            <label for="age">Quốc gia</label>
            <input type="text" class="form-control" id="national" name="national" placeholder="Quốc gia" maxlength="15" value="{{ $getPlayerById[0]->national }}" required />
        </div>
        <div class="form-group">
            <label for="age">Vị Trí</label>
            <input type="text" class="form-control" id="position" name="position" placeholder="Vị Trí" maxlength="15" value="{{ $getPlayerById[0]->position }}" required />
        </div>
        <div class="form-group">
            <label for="age">Lương</label>
            <input type="text" class="form-control" id="salary" name="salary" placeholder="Lương" maxlength="15" value="{{ $getPlayerById[0]->salary }}" required />
        </div>
        <center><button type="submit" class="btn btn-primary">Sửa</button></center>
    </form>
</div>

@endsection