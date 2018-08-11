<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Typeproduct;

class TypeController extends Controller
{
    
    public function list()
    {   
        $list = Typeproduct::where('tp_delete',0)->get();
        return view('pages.type.list')->with('list',$list);
    }
    public function create()
    {
        //
    }
    public function insert(Request $r)
    {
        //
    }
    public function edit(Request $r)
    {
        //
    }
    public function update(Request $r)
    {
        //
    }
    public function destroy($id)
    {
        //
    }
}
