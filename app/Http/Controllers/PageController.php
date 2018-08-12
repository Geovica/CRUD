<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PageController extends Controller
{
    //


    public function index(){
        $tittle="Welcome To my Home Page";
        return view('welcome', compact('tittle'));

    }


    public function about(){
        $tittle="About Page";
        return view('about', compact('tittle'));
    }

    public function services(){

        $data = array(
            'tittle' => 'Services',
            'services' => ['Web Design', 'Programming', 'SEO']
        );
            
        return view('services')->with($data);

        
    }

    

    


}
