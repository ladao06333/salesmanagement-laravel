<?php

namespace App\Http\Controllers;

use App\Models\Players;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Http\Requests\FormRequest;
use App\Http\Requests\TestRequest;
use Session;

class PlayersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function handleForm(Request $request)
    // {
    //     $this->validate(
    //         $request,
    //         [
    //             'name' => 'required|min:5|max:255',
    //             'age' => 'required|min:5|max:255',
    //         ],
    //         [
    //             'required' => 'attribute khong duoc de trong',
    //             'min' => 'attribute khong duoc nho hon :min',
    //             'max' => 'attribute khong duoc lon hon :max',
    //             'integer' => 'attribute khong duoc de trong',
    //         ],
    //         [
    //             'name' => 'Tiêu đề',
    //             'age' => 'Tuổi',
    //         ]
    //     );
    // }
    // public function indexx()
    // {
    //     // $player = DB::table('players')->get();
    //     return view('player.index');
    // }
    // public function getplayers()
    // {
    //     $pl = DB::table('players')->get();
    //     return $pl;
    // }
    // public function insertplayer()
    // {
    //     DB::table('players')->insert(['id' => 1, 'name' => 'a', 'age' => 18, 'national' => 'test', 'position' => 'hau ve', 'salary' => 8888]);
    //     echo 'them thanh cong';
    // }
    // public function updateplayer()
    // {
    //     DB::table('players')->where('id', 1)->update(['name' => 'c']);
    //     echo 'sua thanh cong';
    // }
    // public function deleteplayer()
    // {
    //     DB::table('players')->where('id', 1)->delete();
    // }
    public function index()
    {
        // $pl = DB::table('players')->get();
        // return view('product.list')->with($pl);
        return view('player.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('player.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //  date_default_timezone_set("Asia/Ho_Chi_Minh");



        $allRequest  = $request->all();
        $name  = $allRequest['name'];
        $age = $allRequest['age'];
        $national = $allRequest['national'];
        $position = $allRequest['position'];
        $salary = $allRequest['salary'];

        //Gán giá trị vào array
        $dataInsertToDatabase = array(
            [
                'name'  => $name,
                'age' => $age,
                'national' => $national,
                'position' => $position,
                'salary' => $salary,

            ]
        );

        $insertData = DB::table('players')->insert($dataInsertToDatabase);


        if ($insertData) {
            Session::flash('success', 'Thêm mới thành công!');
        } else {
            Session::flash('error', 'Thêm thất bại!');
        }

        //Thực hiện chuyển trang
        // return redirect('player/create');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Players::all();
        // dd(Players::all());
        $test = Players::where('id', $id)->get();
        // dd($test[0]);
        $getdata = DB::table('players')->where('id', '=', $id)->get();
        // var_dump($getdata);
        return view('player.edit')->with('getPlayerById', $getdata);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function vali(TestRequest $request)
    {
    }
    public function update(Request $request, $id)
    {
        // $validatedData = $request->validate([
        //     'name' => 'required|min:5|max:255',
        //     'age' => 'required|min:5|max:255',
        // ]);
        // date_default_timezone_set("Asia/Ho_Chi_Minh");
        $updatedata = DB::table('players')->where('id', $request->id)->update([
            'name'  => $request->name,
            'age' => $request->age,
            'national' => $request->national,
            'position' => $request->position,
            'salary' => $request->salary,
            'updated_at' => date('Y-m-d H:i:s'),
        ]);
        if ($updatedata) {
            Session::flash('success', 'Sửa thành công!');
        } else {
            Session::flash('success', 'Sửa thất bại');
        }
        return redirect('player');

        #==================================

        // $data = Players::find($id);

        // $data->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $deletapl = DB::table('players')->where('id', '=', $id)->delete();
        if ($deletapl) {
            Session::flash('success', 'Xóa thành công!');
        } else {
            Session::flash('error', 'Xóa thất bại!');
        }
        return redirect('player');
    }
}
