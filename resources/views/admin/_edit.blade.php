@extends('layouts.app')

@section('cdns')
{{-- bootstrap icons --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
@endsection

@section('content')

<div class="container">
  <div class="d-flex justify-content-between align-items-center mt-4">
    <h2 class="fs-4 text-secondary">
    Edit Project {{$project->title}}
    </h2>
    <div>
      <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Torna alla lista</a>
      <a href="{{route('admin.projects.show', $project)}}" class="btn btn-primary my-2"><i class="bi bi-eye"></i></a>
      <button type="submit" class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#destroyModal-{{$project->id}}"><i class="bi bi-trash3"></i></button>
    </div>
  </div>

  <form action="{{route('admin.projects.update', $project)}}" method="POST">
    @method('PUT')
    @csrf
    
    <div class="mb-3">
      <label for="title" class="form-label">Project Title</label>
      <input type="text" class="form-control" id="title" name="title" value="{{ $project->title }}">
    </div>

    <div class="row row-cols-2">
      <div class="mb-3">
        <label for="lenguages" class="form-label">Types of lenguages</label>
        <input type="text" class="form-control" id="lenguages" name="lenguages" value="{{ $project->lenguages }}">
      </div>
      <div class="mb-3">
        <label for="link" class="form-label">Link to the project</label>
        <input type="url" class="form-control" id="link" name="link" value="{{ $project->link }}">
      </div>
    </div>
    <input type="submit" class="btn btn-success" value="Save">
  </form>
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