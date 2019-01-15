<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function index(){
        $data = array(
            'title' => 'Indexpage',
            'inhoud' => ['Test 1', 'Test 2']
        );
        return view('pages.index')->with($data);
    }

    public function about(){
        $title = 'About';
        return view('pages.about')->with('title', $title);
    }

    public function adminTickets(){
        $title = 'Ticket overview';
        return view('admin.tickets')->with('title', $title);
    }
}
