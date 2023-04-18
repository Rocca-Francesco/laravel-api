<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index() {
    $projects = Project::orderBy('updated_at', 'DESC')->paginate(8);
    return view('guest.home', compact('projects'));
    }

    public function show(Project $project)
    {
        return view('guest.show', compact('project'));
    }
}
