<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use Illuminate\Contracts\Session\Session;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\User;
use App\Models;
use App\Models\country;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    /**
     * Create a new controller instance.
     *
     * 
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // public function profile()
    // {
    //     $profile = DB::table('users')->get()->first();
    //     return view('admin.user.profile')->with('profile', $profile);
    // }

    public function profile()
    {
        // $profile = user::all();
        $userId = Auth::id();
        $profile = user::find($userId);
        $country = country::all();
        return view('admin.user.profile')->with('profile', $profile)->with('country', $country);
    }

    public function save_profile(Request $request)
    {
        // $data = array();
        // $data['name'] = $request->name;
        // $data['email'] = $request->email;
        // $data['password'] = $request->password;
        // $data['phone'] = $request->phone;
        // $data['address'] = $request->phone;
        // DB::table('user')->update($data);
        // $a = Auth::user()->id;
        // dd($a);
        $userId = Auth::id();
        $user = user::findOrFail($userId);
        dd($user);

        // Validate the data submitted by user
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email' => 'required|email|max:225|' . Rule::unique('users')->ignore($user->id),
            'avatar' => 'image|mimes:jpeg,png,gif|max:2048',
        ]);

        // if fails redirects back with errors
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)
                ->withInput();
        }

        // Fill user model
        // $user->fill([
        //     'name' => $request->name,
        //     'email' => $request->email
        // ]);

        $data = $request->all();

        // dd($data);
        $file = $request->avatar;
        // dd($file);
        // $s = $file->getClientOriginalName();
        // echo $s;
        // exit;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }

        if ($data['password']) {
            $data['password'] = bcrypt($data['password']);
        } else {
            $data['password'] = $user->password;
        }
        // $d = country::select('id')->where('name', $request->country)->get();
        // $data['country'] = $d[0]->id;
        // $data['country'] = $d[0]['id'];
        // $data['country'] = $request->country;
        // dd($file);

        // dd($data['country']);
        // dd($data);
        // $user->save();
        // $user->update($data)
        if ($user->update($data)) {
            if (!empty($file)) {
                $file->move('admin/upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', ('Upload profile success'));
        } else {
            return redirect()->back()->withErrors('Upload profile fail');
        }

        // Session::put('message', 'Cập nhật thành công');
        // return redirect('');
        // dd($data);
    }
}
