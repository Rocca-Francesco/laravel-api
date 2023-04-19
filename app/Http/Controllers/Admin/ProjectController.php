<?php

namespace App\Http\Controllers\Admin;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $project = new Project;
        return view('admin.form', compact('project'));
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
            'link' => 'nullable|image|mimes:jpg.png,jpeg',
        ], 
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo deve avare al massimo 50 caratteri',

            'lenguages.required' => 'Il progetto deve avere almeno un linguaggio',
            'lenguages.string' => 'I linguaggi devono essere una stringa',
            'lenguages.max' => 'I linguaggi devono avare al massimo 100 caratteri',

            
            'link.url' => 'Il file deve essere un\'immagine',
            'link.mimes' => 'Il tipo d\'immagine deve essere jpg, png o jpeg',
        ]);

        $data = $request->all();

        if(Arr::exists($data, 'link')) {
            $img_path = Storage::put('uploads/projects', $data['link']);
            $data['link'] = $img_path;
        }

        $project = new Project;
        $project->fill($data);
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
        return view('admin.form', compact('project'));
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
            'link' => 'nullable|image|mimes:jpg.png,jpeg',
        ], 
        [
            'title.required' => 'Il titolo è obbligatorio',
            'title.string' => 'Il titolo deve essere una stringa',
            'title.max' => 'Il titolo deve avare al massimo 50 caratteri',

            'lenguages.required' => 'Il progetto deve avere almeno un linguaggio',
            'lenguages.string' => 'I linguaggi devono essere una stringa',
            'lenguages.max' => 'I linguaggi devono avare al massimo 100 caratteri',

            
            'link.url' => 'Il file deve essere un\'immagine',
            'link.mimes' => 'Il tipo d\'immagine deve essere jpg, png o jpeg',
        ]);
        
        $data = $request->all();

        if(Arr::exists($data, 'link')) {
            if($project->link) Storage::delete($project->link);
            $img_path = Storage::put('uploads/projects', $data['link']);
            $data['link'] = $img_path;
        }

        $project->fill($data);
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
        if($project->link) Storage::delete($project->link);
        $project->delete();
        
        return to_route('admin.projects.index')
            ->with('message_error', 'danger')
            ->with('message', 'Progetto eliminato corretamente!');
    }
}
