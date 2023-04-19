<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $sort = (!empty($sort_request = $request->get('sort'))) ? $sort_request : "updated_at";
        $order = (!empty($order_request = $request->get('order'))) ? $order_request : "DESC";

        $projects = project::orderBy($sort, $order)->paginate(8)->withQueryString();
        return view('admin.index', compact('projects', 'sort', 'order'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.create');
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
            'lenguages' => 'required|string|max:100',
            'link' => 'required|url|max:100',
        ], 
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo deve avare al massimo 50 caratteri',

            'lenguages.required' => 'Il progetto deve avere almeno un linguaggio',
            'lenguages.string' => 'I linguaggi devono essere una stringa',
            'lenguages.max' => 'I linguaggi devono avare al massimo 100 caratteri',

            'link.required' => 'Il link al progetto è obbligatorio',
            'link.url' => 'Il link deve essere un url',
            'link.max' => 'Il link deve avere al massimo 100 caratteri',
        ]);

        $project = new Project;
        $project->fill($request->all());
        $project->slug = Project::generateSlug($project->title);
        $project->save();

        return to_route('admin.projects.show', compact('project'))
            ->with('message', 'Progetto creato corretamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        return view('admin.show', compact('project'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {   
        return view('admin.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:50',
            'lenguages' => 'required|string|max:100',
            'link' => 'required|url|max:100',
        ], 
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo deve avare al massimo 50 caratteri',

            'lenguages.required' => 'Il progetto deve avere almeno un linguaggio',
            'lenguages.string' => 'I linguaggi devono essere una stringa',
            'lenguages.max' => 'I linguaggi devono avare al massimo 100 caratteri',

            'link.required' => 'Il link al progetto è obbligatorio',
            'link.url' => 'Il link deve essere un url',
            'link.max' => 'Il link deve avere al massimo 100 caratteri',
        ]);
        
        $project->fill($request->all());
        $project->slug = Project::generateSlug($project->title);
        $project->save();

        return to_route('admin.projects.show', compact('project'))
            ->with('message', 'Progetto modificato corretamente!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $project->delete();
        return to_route('admin.projects.index')
            ->with('message_error', 'danger')
            ->with('message', 'Progetto eliminato corretamente!');
    }
}
