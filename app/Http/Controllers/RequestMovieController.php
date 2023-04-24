<?php

namespace App\Http\Controllers;
use App\MovieRequest;
use Auth;
use Illuminate\Http\Request;

class RequestMovieController extends Controller
{
    public function store(Request $request)
    {
        if (env('DEMO_LOCK') == 1) {
            return back()->with('deleted', __('This action is disabled in the demo !'));
        }

        $request->validate(['name' => 'required','email' => 'required|email','mr_name'=>'required']);
        $req = new MovieRequest;
        $req->name=$request->name;
        $req->email=$request->email;
        $req->mr_name=$request->mr_name;


        $req->save();

        return back()->with('updated', __('Your Movie request hasbeen sent sucesfully'));


        }

        public function index(){
            $req = MovieRequest::orderBy('id','desc')->paginate(10);
            return view('admin.moviereqindex', compact('req'));
        }
}
