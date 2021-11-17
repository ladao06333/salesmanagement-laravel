<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Models\rating;
use App\Models\user;
use App\Models\comment;
use Facade\FlareClient\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class BlogController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $blog  = blog::paginate(2);
        return view('frontend.blog.list')->with('blog', $blog);
    }
    // public function index2()
    // {
    //     return view('frontend.blog.single');
    // }

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
        $blog  = blog::find($id);
        $max = blog::max('id');
        $min = blog::min('id');
        $comment = comment::all()->where('id_blog', $id);
        $getBlogDetail = Blog::with(['comment' => function ($q) {
            $q->orderBy('id', 'desc');
        }])->find($id)->toArray();
        // $getBlogDetail = Blog::with(['comment' => function ($q) {
        //     $q->orderBy('id', 'desc');
        // }])->find($id)->get();
        // dd($getBlogDetail);
        // dd($comment);
        // $user = Auth::id();
        // $profile = user::find($user);
        // dd($profile);
        // dd($max);
        $previous = blog::where('id', '<', $blog->id)->max('id');
        $next = blog::where('id', '>', $blog->id)->min('id');
        $rating = rating::where('id_blog', $id)->avg('vote');
        $rating = round($rating);
        // dd($rating);
        return view('frontend.blog.single', compact('blog', 'previous', 'next', 'max', 'min', 'rating', 'getBlogDetail', 'comment'));
        // return view('frontend.blog.single')->with(compact('blog', 'previous', 'next', 'max', 'min', 'rating'));
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
    public function insert_rating(Request $request)
    {
        $data = $request->all();
        $user = Auth::id();
        $rating = new rating();
        $rating->id_blog = $data['blog_id'];
        $rating->id_user = $user;
        $rating->vote = $data['index'];
        $rating->save();
        echo "done";
    }
    public function post_comment(Request $request, $id)
    {
        // $data = $request->all();
        $id_user = Auth::id();
        $user = user::find($id_user);
        // dd($data);
        // dd($data['id_blog']);
        // dd($user);
        $comment = new comment();
        $comment->id_blog = $id;
        $comment->id_user = $id_user;
        $comment->name = $user->name;
        $comment->image = $user->avatar;
        $comment->content = $request->content;
        $comment->level = $request->id_comment;
        // dd($comment);
        if ($comment->save()) {
            return redirect()->back()->with('success', (' success'));
        } else {
            return redirect()->back()->withErrors(' fail');
        }
    }
}
