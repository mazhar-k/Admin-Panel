<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $PageName='Dashboard';
        return view('pages.index')->with('PageName',$PageName);
    }

    public function analytics(){
        $PageName='Analytics';
        return view('analytics.index')->with('PageName',$PageName);
    }
    
}
