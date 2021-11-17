<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\blog;
use App\Http\Requests\BlogRequest;

class BlogController extends Controller
{
    protected $modelBlog;

    public function __construct()
    {
        $this->modelBlog = new blog();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $blog = blog::all();
        $blog = blog::paginate(2);
        return view('admin.user.blog')->with('blog', $blog);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.addBlog');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    // public function store(Request $request)
    // {
    //     $blog = new blog;
    //     $blog->title = $request->title;
    //     $blog->image = $request->image;
    //     $blog->description = $request->description;
    //     $blog->content = $request->content;
    //     $file = $request->image;
    //     if (!empty($file)) {
    //         $blog['image'] = $file->getClientOriginalName();
    //     }
    //     if ($blog->save()) {
    //         if (!empty($file)) {
    //             $file->move('admin/upload/blog/avatar', $file->getClientOriginalName());
    //         }
    //         return redirect()->back()->with('success', (' success'));
    //     } else {
    //         return redirect()->back()->withErrors(' fail');
    //     }
    // }
    public function store(BlogRequest $request)
    {
        $data = $request->all();
        $file = $request->image;
        if (!empty($file)) {
            $data['image'] = $file->getClientOriginalName();
        } else {
            $data['image'] = 'null';
        }
        // $data = $request->all();
        // if ($blog->save($data)) {
        //     if (!empty($file)) {
        //         $file->move('admin/upload/blog/avatar', $file->getClientOriginalName());
        //     }
        //     return redirect()->back()->with('success', (' success'));
        // } else {
        //     return redirect()->back()->withErrors(' fail');
        // }
        if ($this->modelBlog->create($data)) {
            if (!empty($file)) {
                $file->move('admin/upload/blog/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', (' success'));
        } else {
            return redirect()->back()->withErrors(' fail');
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
        $blog = blog::find($id);
        return view('admin.user.editBlog')->with('blog', $blog);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BlogRequest $request, $id)
    {
        $blog = blog::find($id);
        $blog->title = $request->title;
        $blog->description = $request->description;
        $blog->content = $request->content;
        $file = $request->image;
        if (!empty($file)) {
            $blog['image'] = $file->getClientOriginalName();
        } else {
            $blog['image'] = $blog->image;
        }
        // dd($blog['image']);
        if ($blog->save()) {
            if (!empty($file)) {
                $file->move('admin/upload/blog/avatar', $file->getClientOriginalName());
            }
            return redirect()->back()->with('success', (' success'));
        } else {
            return redirect()->back()->withErrors(' fail');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        blog::find($id)->delete();
        return redirect()->back()->with('success', ('Delete blog success'));
    }
}
