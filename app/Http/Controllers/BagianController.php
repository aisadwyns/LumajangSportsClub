<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bagian;

class BagianController extends Controller
{
    public function index()
    {
        $bagian = Bagian::all();
        return view('bagian.index', compact('bagian'));
    }
    public function show(String $id)
    {
        $bagian = Bagian::find($id);
        return view('bagian.show', compact('bagian'));
    }
}
