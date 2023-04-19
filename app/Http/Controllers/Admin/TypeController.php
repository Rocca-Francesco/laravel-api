<?php

namespace App\Http\Controllers\Admin;

use App\Models\Type;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TypeController extends Controller
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

        $types = Type::orderBy($sort, $order)->paginate(8)->withQueryString();
        return view('admin.type.index', compact('types', 'sort', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $type = new Type();
        return view('admin.type.form', compact('type'));
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
            'title' => 'required|string|unique|max:50',
            'color' => 'required|string|size:7'
        ],
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.unique' => 'Il titolo deve essere unico',
            'title.max' => 'Il titolo può essere al massimo 50 caratteri',

            'color.required' => 'Il colore è obbligatorio',
            'color.string' => 'Il colore deve essere una stringa',
            'color.size' => 'Il colore deve essere un esadecimale di 7 caratteri',
        ]);

        $type = new Type();
        $type->fill($request->all());
        $type->save();

        return to_route('admin.type.index')
            ->with('message', 'Tipo creato corretamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function show(Type $type)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function edit(Type $type)
    {
        return view('admin.type.form', compact('type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Type $type)
    {
        $request->validate([
            'title' => 'required|string|unique|max:50',
            'color' => 'required|string|size:7'
        ],
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.unique' => 'Il titolo deve essere unico',
            'title.max' => 'Il titolo può essere al massimo 50 caratteri',

            'color.required' => 'Il colore è obbligatorio',
            'color.string' => 'Il colore deve essere una stringa',
            'color.size' => 'Il colore deve essere un esadecimale di 7 caratteri',
        ]);

        
        $type->update($request->all());
        return to_route('admin.type.index')
            ->with('message', 'Tipo modificato corretamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Type  $type
     * @return \Illuminate\Http\Response
     */
    public function destroy(Type $type)
    {
        $type->delete();
        
        return to_route('admin.type.index')
            ->with('message_error', 'danger')
            ->with('message', 'Tipo eliminato corretamente!');
    }
}
