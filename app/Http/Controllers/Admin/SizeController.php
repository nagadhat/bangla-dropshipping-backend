<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Size;
use Validator;

class SizeController extends Controller
{
    public function index(){
        $sizes = Size::orderBy('id', 'desc');
        return view('back-end.variants.sizes', compact('sizes'));
    }
}
