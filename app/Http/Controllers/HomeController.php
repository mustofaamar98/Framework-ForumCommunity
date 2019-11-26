<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Forum;
use Auth;
Use App\Tag;
use DB;
Use Storage;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // $tags = DB::table('tags')
        // ->select('name')
        // ->groupBy('name')
        // ->get();

        $tags = Tag::select('name')
                    ->groupBy('name')
                    ->get();
        $forums = Forum::all();
        $forumview = Forum::orderBy('view', 'DESC')->get();
        return view ('home', compact('forums','forumview','tags'));
    }

}
