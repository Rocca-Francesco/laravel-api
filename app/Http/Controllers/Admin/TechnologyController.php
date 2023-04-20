<?php

namespace App\Http\Controllers\Admin;

use App\Models\Technology;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TechnologyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at";
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";

        $technologies = Technology::orderBy($sort, $order)->paginate(8)->withQueryString();
        return view('admin.technology.index', compact('technologies', 'sort', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $technology = new Technology();
        return view('admin.technology.form', compact('technology'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'color' => 'required|string|size:7'
        ],
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo può essere al massimo 50 caratteri',

            'color.required' => 'Il colore è obbligatorio',
            'color.string' => 'Il colore deve essere una stringa',
            'color.size' => 'Il colore deve essere un esadecimale di 7 caratteri',
        ]);

        $technology = new Technology();
        $technology->fill($request->all());
        $technology->save();

        return to_route('admin.technology.index')
            ->with('message', 'Tecnologia creata corretamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function show(Technology $technology)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function edit(Technology $technology)
    {
        return view('admin.technology.form', compact('technology'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Technology $technology)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'color' => 'required|string|size:7'
        ],
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo può essere al massimo 50 caratteri',

            'color.required' => 'Il colore è obbligatorio',
            'color.string' => 'Il colore deve essere una stringa',
            'color.size' => 'Il colore deve essere un esadecimale di 7 caratteri',
        ]);

        
        $technology->update($request->all());
        return to_route('admin.technology.index')
            ->with('message', 'Tecnologia modificata corretamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Technology  $technology
     * @return \Illuminate\Http\Response
     */
    public function destroy(Technology $technology)
    {
        $technology->delete();
        
        return to_route('admin.technology.index')
            ->with('message_error', 'danger')
            ->with('message', 'Tecnologia eliminata corretamente!');
    }
}
