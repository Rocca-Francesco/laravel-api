@extends('layouts.app')

@section('content')

<div class="container">
  <h2 class="fs-4 text-secondary mt-4">
    {{ __('Create new project') }}
  </h2>

  <form action="{{route('admin.projects.store')}}" method="POST"></form>
  <div class="mb-3">
    @csrf

    <label for="title" class="form-label">Project Title</label>
    <input type="text" class="form-control" id="title" name="title">
  </div>

  <div class="row row-cols-2">
    <div class="mb-3">
      <label for="lenguages" class="form-label">Types of lenguages</label>
      <input type="text" class="form-control" id="lenguages" name="lenguages">
    </div>
    <div class="mb-3">
      <label for="link" class="form-label">Link to the project</label>
      <input type="url" class="form-control" id="link" name="link">
    </div>
  </div>
  <input type="submit" class="btn btn-success" value="Save">
</div>
	
@endsection