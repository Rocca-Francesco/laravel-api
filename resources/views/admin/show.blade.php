@extends('layouts.app')

@section('cdns')
{{-- bootstrap icons --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
@endsection

@section('content')
    
<div class="container">
		<div class="d-flex justify-content-between align-items-center my-4">
			<h2 class="fs-4 text-secondary">
				Project {{$project->title}}
			</h2>
			<div>
				<a href="{{route('admin.projects.index')}}" class="btn btn-primary">Torna alla lista</a>
				<a href="{{route('admin.projects.edit', $project)}}" class="btn btn-primary my-2"><i class="bi bi-pencil-square"></i></a>
				<button type="submit" class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#destroyModal-{{$project->id}}"><i class="bi bi-trash3"></i></button>	
			</div>
		</div>
    <div class="row justify-content-center">
        <div class="col">
						
						<div class="card">
							<div class="card-body">
								<img class="imgCards" src="{{$project->getLinkUrl()}}" alt="">
								<h5 class="card-title">{{$project->title}}</h5>
								<p class="card-text">Programming Lenguages used: {{$project->lenguages}} </p>
								<a href="{{$project->link}}" class="btn btn-primary">Go to project link</a>
							</div>
						</div>
				</div>
    </div>
</div>

@endsection

@section('modals')
	<div class="modal fade" id="destroyModal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Vuoi eliminare {{$project->title}}? </h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Vuoi eliminare il progetto? <br>
					Questa operaione è irreversibile.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<form action="{{route('admin.projects.destroy', $project)}}" method="POST">
            @method('delete')
            @csrf

            <button type="submit" class="btn btn-danger">Delete</button>

        </form>
				</div>
			</div>
		</div>
	</div>
@endsection

