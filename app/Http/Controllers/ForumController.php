<?php

namespace App\Http\Controllers;

use App\Forum;
use Illuminate\Http\Request;
use Auth;
Use App\Tag;
Use Storage;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index','show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $forums = Forum::paginate(5);
        $forumview = Forum::orderBy('view', 'DESC')->get();
        return view('forum.index', compact('forums','forumview'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $forums = Forum::orderBy('id', 'desc')->paginate(1);
        $tags = Tag::all();
        return view('forum.create', compact('tags','forums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:5000','require',
        ]);

        $forums = new Forum;
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        $forums->slug = str_slug($request->title);
        $forums->view = 0;
        $forums->description = $request->description;
        if ($request->file('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = public_path('/images');
            $file->move($location, $filename);
            $forums->image = $filename;
        }

        $forums->save();
        $forums->tags()->sync($request->tags);

        return redirect('/forum')->withInfo('Pertanyaan berhasil ditambah');
  
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $forums = Forum::find($id);
        $forumview = Forum::orderBy('view', 'DESC')->get();
        $forums->update([
            'view' => $forums->view + 1
        ]);
        return view ('forum.show', compact('forums','forumview'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $forums = Forum::orderBy('id', 'desc')->paginate(1);
        $tags = Tag::all();
        $forum = Forum::where('id',$slug)
                        ->orWhere('slug',$slug)
                        ->firstOrFail();
        return view('forum.edit', compact('forum','tags','forums'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:jpeg,jpg,png,gif|max:5000', 'require',
        ]);

        $forums = Forum::find($id);
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        $forums->slug = str_slug($request->title);
        $forums->description = $request->description;
        if ($request->file('image')){
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = public_path('/images');
            $file->move($location, $filename);

            $oldImage = $forums->image;
            \Storage::delete($oldImage);
 
            $forums->image = $filename;
        }

        $forums->save();
        $forums->tags()->sync($request->tags);
        return back()->withInfo('Pertanyaan berhasil diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum = Forum::find($id);
        Storage::delete($forum->image);
        $forum->tags()->detach();
        $forum->delete();
        return back()->withInfo('Pertanyaan berhasil di Hapus');
    }
}
