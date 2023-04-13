@extends('layouts.app')

@section('content')
    
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
			<h2 class="fs-4 text-secondary mt-4">
        {{ __('Projects List') }}
    	</h2>
			<a href="{{route('admin.projects.create')}}" class="btn btn-primary mt-4">Create new project</a>
		</div>
    <div class="row justify-content-center">
			@foreach ($projects as $project)
        <div class="col g-4">
					<div class="card" style="width: 18rem;">
							<div class="card-body">
								<h5 class="card-title">{{$project->title}}</h5>
								<p class="card-text">Programming Lenguages used: {{$project->lenguages}} </p>
                <a href="{{route('admin.projects.show', $project)}}" class="btn btn-primary my-2">Go to detail about project</a>
								<a href="{{route('admin.projects.edit', $project)}}" class="btn btn-primary my-2">Change project info</a>
								<a href="{{$project->link}}" class="btn btn-primary">Go to project</a>
							</div>
						</div>
					</div>
			@endforeach

    </div>
		<div class="my-2">
			{{$projects->links()}}
		</div>
	</div>
	
@endsection
