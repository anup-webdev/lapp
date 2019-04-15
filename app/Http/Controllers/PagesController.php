<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        return view('pages.index');
    }

    public function about(){
        $description = "This is an about page!!";
        // return view('pages.about', compact('description'));
        return view('pages.about')->with('desc', $description);
    }

    public function services(){
        $data= Array(
            'title'=> 'Services',
            'services'=> ['Web Development', 'Digital Marketing', 'SEO']
        );
        return view('pages.services')->with($data);
    }
}
