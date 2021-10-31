<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Cat;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class CatController extends Controller
{
    public function index()
    {
        $data['cats'] = Cat::orderBy('id', 'DESC')->paginate(3);

        return view('admin.cats.index')->with($data);
    }

    public function store(Request $request)
    {
        // dd($request->all());
             $request->validate([
                'name_en' => 'required|string|max:50',
                'name_ar' => 'required|string|max:50',
                'img.*' => 'required|image|max:2048|mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
            ]);

            $path = Storage::putFile("cats", $request->file('img'));
     
         //  dd($request->all());
        Cat::create([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $path,
        ]);
        $request->session()->flash('msg', 'row added successfuly');
        return back();
    }

    public function update(Request $request, Cat $cat)
    {
       
        $request->validate([
            'id' => 'required|exists:cats,id',
            'name_en' => 'required|string|max:50',
            'name_ar' => 'required|string|max:50',
            'img.*' => 'nullable|image|max:2048|mimes:doc,pdf,docx,zip,jpeg,png,jpg,gif,svg',
        ]);


        $cat = Cat::findOrFail($request->id);
        $path = $cat->img;

        if($request->hasFile('img')) {
            Storage::delete($path);
            $path = Storage::putFile("cats", $request->file('img'));
        }
        $cat->update([
            'name' => json_encode([
                'en' => $request->name_en,
                'ar' => $request->name_ar,
            ]),
            'img' => $path,
        ]);
       
        $request->session()->flash('msg', 'row updated successfuly');
        return back();
    }

    public function toggle(Cat $cat){
        $cat->update([
            'active' => !$cat->active
        ]);
        return back();
    }

    public function delete(Cat $cat, Request $request)
    {
        try {
            $path = $cat->img;
            $cat->delete();
            Storage::delete($path);
            $msg = "row deleted successfully";
        } catch (Exception $e) {
            $msg = "can't delete this row";
        }
       $request->session()->flash('msg', $msg);
        return back();
    }
}