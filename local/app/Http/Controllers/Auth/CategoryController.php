<?php

namespace App\Http\Controllers\Auth;

use App\LectureCat;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $category = LectureCat::orderBy('id', 'ASC')->paginate(100);
        return view('auth.category', compact('category'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function add()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        $cat = new LectureCat();
        $cat->title = $inputs['title'];
        $cat->fontawesome = $inputs['fontawesome'];
        $cat->color = $inputs['color'];
        $cat->save();
        return Response::json(['id' => $cat->id, 'title' => $cat->title, 'fontawesome' => $cat->fontawesome, 'color' => $cat->color],200);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        $cat = LectureCat::find($inputs['id']);
        $cat->title = $inputs['title'];
        $cat->fontawesome = $inputs['fontawesome'];
        $cat->color = $inputs['color'];
        $cat->save();
        return Response::json(['id' => $cat->id, 'title' => $cat->title, 'fontawesome' => $cat->fontawesome, 'color' => $cat->color],200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        //
    }
}
