@extends('layouts.app')

@section('content')

<div class="container">
  <h2 class="fs-4 text-secondary mt-4">
    {{ __('Create new project') }}
  </h2>

  <div class="mb-3">
    <label for="title" class="form-label">Project Title</label>
    <input type="text" class="form-control" id="title">
  </div>

  <div class="row row-cols-2">
    <div class="mb-3">
      <label for="lenguages" class="form-label">Types of lenguages</label>
      <input type="text" class="form-control" id="lenguages">
    </div>
    <div class="mb-3">
      <label for="link" class="form-label">Link to the project</label>
      <input type="url" class="form-control" id="link">
    </div>
  </div>
  <a href="{{route('admin.projects.store', $project)}}" class="btn btn-success my-2">Save</a>
</div>
	
@endsection