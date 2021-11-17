<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <style type="text/css">
        table {
            width: 800px;
            margin: auto;
            text-align: center;
        }

        tr {
            border: 1px solid;
        }

        th {
            border: 1px solid;
        }

        td {
            border: 1px solid;
        }

        h1 {
            text-align: center;
            color: red;
        }

        #button {
            margin: 2px;
            margin-right: 10px;
            float: right;
        }
    </style>
</head>

<body>
    <?php

    use Illuminate\Support\Facades\DB;

    $player = DB::table('players')->get();
    ?>
    <table id="datatable" style="border: 1px solid">
        <h1>Quản lý cầu thủ</h1>
        <thead>
            <tr role="row">
                <th>ID</th>
                <th>Tên cầu thủ</th>
                <th>Tuổi</th>
                <th>Quốc tịch</th>
                <th>Vị trí</th>
                <th>Lương</th>
                <th style="width: 7%;">Edit</th>
                <th style="width: 10%;">>Delete</th>
            </tr>
            @foreach($player as $p)
            <tr>
                <td>{{ $p->id }}</td>
                <td>{{ $p->name }}</td>
                <td>{{ $p->age }}</td>
                <td>{{ $p->national }}</td>
                <td>{{ $p->position }}</td>
                <td>{{ $p->salary }}</td>
                <td><a href="/player/edit/{{ $p->id }}">Edit</a></td>
                <td><a href="/player/delete/{{ $p->id }}"> Delete</a></td>
            </tr>
            @endforeach
        </thead>
        <tbody>
            <!-- <tr role="row">
                    <td>1</td>
                    <td>Lionel Messi</td>
                    <td>30</td>
                    <td>Argentina</td>
                    <td>Tiền Đạo</td>
                    <td>230000 $</td>
                    <td><a href="#">Edit</a></td>
                    <td><a href="#"> Delete</a></td>
                </tr> -->
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">
                    <a href="{{ url('/player/create') }}"><button id="button">Thêm cầu thủ</button></a>
                </td>
            </tr>
        </tfoot>
    </table>
</body>

</html>