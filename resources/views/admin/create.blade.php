@extends('layouts.app')

@section('content')

<div class="container">
  <h2 class="fs-4 text-secondary mt-4">
    {{ __('Create new project') }}
  </h2>

  <form action="{{route('admin.projects.store')}}" method="POST">
    @csrf
    <div class="mb-3">

      <label for="title" class="form-label">Project Title</label>
      <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title')}}">
      @error('title')
      <div class="invalid-feedback">
        {{ $message }}
      </div>
      @enderror
    </div>

    <div class="row row-cols-2">
      <div class="mb-3">
        <label for="lenguages" class="form-label">Types of lenguages</label>
        <input type="text" class="form-control @error('lenguages') is-invalid @enderror" id="lenguages" name="lenguages" value="{{old('lenguages')}}">
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="mb-3">
        <label for="link" class="form-label">Link to the project</label>
        <input type="url" class="form-control @error('lenguages') is-invalid @enderror" id="link" name="link" value="{{old('link')}}">
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