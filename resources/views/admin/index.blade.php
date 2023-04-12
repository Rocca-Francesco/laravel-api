@extends('layouts.app')

@section('content')
    
		<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        {{ __('Projects List') }}
    </h2>
    <div class="row justify-content-center">
			@foreach ($projects as $project)
        <div class="col g-4">
						<div class="card" style="width: 18rem;">
							<div class="card-body">
								<h5 class="card-title">{{$project->title}}</h5>
								<p class="card-text">Programming Lenguages used: {{$project->lenguages}} </p>
								<a href="{{$project->link}}" class="btn btn-primary">Go somewhere</a>
							</div>
						</div>
					</div>
			@endforeach
    </div>
</div>

@endsection
