@extends('layouts.app')

@section('content')

<div class="container">
    @if($project->id)
      <h2 class="fs-4 text-secondary">
      Create new project
      </h2>
    @else
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
    @endif

  @if($project->id)
    <form action="{{route('admin.projects.update', $project)}}" method="POST">
    @method('PUT')
  @else
    <form action="{{route('admin.projects.store')}}" method="POST">
  @endif
  @csrf

    <div class="mb-3">
      <label for="title" class="form-label">Project Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $post->title)}}">
      @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="row row-cols-2">
      <div class="mb-3">
        <label for="lenguages" class="form-label">Types of lenguages</label>
        <input type="text" class="form-control @error('lenguages') is-invalid @enderror" id="lenguages" name="lenguages" value="{{old('lenguages', $post->lenguages)}}">
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="link" class="form-label">Link to the project</label>
        <input type="url" class="form-control @error('lenguages') is-invalid @enderror" id="link" name="link" value="{{old('link', $post->link)}}">
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
    </div>
    <input type="submit" class="btn btn-success" value="Save">
  </form>
</div>
	
@endsection