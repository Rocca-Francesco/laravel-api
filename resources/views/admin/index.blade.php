@extends('layouts.app')

@section('content')
    
<div class="container">
    <h2 class="fs-4 text-secondary mt-4">
        {{ __('Projects List') }}
    </h2>
    <div class="row justify-content-center">
			@foreach ($projects as $project)
        <div class="col g-4">
					<div class="card" style="width: 18rem;">
							<div class="card-body">
								<h5 class="card-title">{{$project->title}}</h5>
								<p class="card-text">Programming Lenguages used: {{$project->lenguages}} </p>
                <a href="{{route('admin.projects.show', $project)}}" class="btn btn-primary my-2">Go to detail about project</a>
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
