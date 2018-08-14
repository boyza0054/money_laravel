<?php

namespace App\Http\Controllers;

use App\Typeproduct;
use Illuminate\Http\Request;

class TypeController extends Controller
{

    function list() {
        $list = Typeproduct::where('tp_delete', 0)->get();
        return view('pages.type.list')->with('list', $list);
    }
    public function insert(Request $r)
    {
        $type = new Typeproduct();
        $type->tp_name = $r->type_name;
        $type->save();

        return back()->with('status', 'Success! message sent successfully.');
    }
    public function edit(Request $r)
    {
        $type = Typeproduct::where('tp_id', $r->id)->first();
        return $type;
    }
    public function update(Request $r)
    {
        $type = Typeproduct::where('tp_id', $r->id)->first();
        $type->tp_name = $r->type_name;
        $type->save();

        return back()->with('status', 'Success! message sent successfully.');
    }
    public function destroy(Request $r)
    {
        $type = Typeproduct::where('tp_id', $r->type_id)->first();
        $type->tp_delete = 1;
        $type->save();
        return back()->with('status', 'Success! message sent successfully.');
    }
}
