<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Http\Requests\MemberRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
// use Illuminate\Support\Facades\Session;
// use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\user;
use App\Models\country;

// session_start();

class MemberController extends Controller
{
    protected $modelUser;
    public function __construct()
    {
        $this->modelUser = new user();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
    }
    public function vlogin()
    {
        return view('frontend.member.login');
    }
    public function vregister()
    {
        $country = country::all();
        return view('frontend.member.register')->with('country', $country);
    }
    public function login(Request $request)
    {
        $login = [
            'email' => $request->email,
            'password' => $request->password,
            'level' => 0
        ];
        $remember = false;
        if ($request->remember_me) {
            $remember = true;
        }

        // dd($data);
        if (Auth::attempt($login)) {
            return redirect('/');
        } else {
            return redirect()->back()->withErrors(' fail');
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/member/login');
    }

    public function register(MemberRequest $request)
    {
        $user = new user();
        $data = $request->all();
        // $data->name = $request->name;
        // $data->email = $request->email;
        $data['password'] = bcrypt($request->password);
        $data['level'] = 0;
        $file = $request->avatar;
        if (!empty($file)) {
            $data['avatar'] = $file->getClientOriginalName();
        }
        // dd($data);
        if ($this->modelUser->create($data)) {
            if (!empty($file)) {
                $file->move('admin/upload/user/avatar', $file->getClientOriginalName());
            }
            return redirect('/');
        } else {
            return redirect()->back()->withErrors(' fail');
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id_user = Auth::id();
        $profile = user::find($id_user);
        $country = country::all();
        return view('frontend.member.account')->with('profile', $profile)->with('country', $country);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $userId = Auth::id();
        $user = user::findOrFail($userId);
        // dd($user);

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
}
