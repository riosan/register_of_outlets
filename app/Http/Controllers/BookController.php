<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Models\Messages;

class BookController extends Controller
{
    function index()
    {
        $data = ['title' => 'Гостевая книга',
                'message' =>Messages::latest()->paginate(3),
                'count' => Messages::count(),
        ];
        return view('pages.messages.index',$data);
    }

    function edit($id)
    {
        $data = ['title' => 'Гостевая книга'];
        return view('pages.messages.edit',$data);
    }
}
