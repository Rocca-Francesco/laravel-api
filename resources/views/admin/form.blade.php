@extends('layouts.app')

@section('cdns')
{{-- bootstrap icons --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
@endsection

@section('content')

<div class="container">
    @if($project->id)
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
    @else
    <h2 class="fs-4 text-secondary">
    Create new project
    </h2>
    @endif

  @if($project->id)
    <form action="{{route('admin.projects.update', $project)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
  @else
    <form action="{{route('admin.projects.store')}}" method="POST" enctype="multipart/form-data">
  @endif
  @csrf

    <div class="mb-3">
      <label for="title" class="form-label">Project Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $project->title)}}">
      @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="row">
      <div class="col-6 mb-3">
        <label for="lenguages" class="form-label">Types of lenguages</label>
        <input type="text" class="form-control @error('lenguages') is-invalid @enderror" id="lenguages" name="lenguages" value="{{old('lenguages', $project->lenguages)}}">
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="col-3 mb-3">
        <label for="link" class="form-label">Image of the project</label>
        <input type="file" class="form-control @error('link') is-invalid @enderror" id="link" name="link">
        @error('link')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="col-2">
        <img src="{{old('link', $project->link)}}" class="img-fluid" alt="">
      </div>
    </div>
    <input type="submit" class="btn btn-success" value="Save">
  </form>
</div>
	
@endsection