@extends('layouts.app')

@section('cdns')
{{-- bootstrap icons --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
@endsection

@section('content')

<div class="container">
    @if($technology->id)
    <div class="d-flex justify-content-between align-items-center mt-4">
      <h2 class="fs-4 text-secondary">
        Edit Technology {{$technology->title}}
      </h2>
      <div>
        <a href="{{route('admin.technology.index')}}" class="btn btn-primary">Torna alla lista</a>
        <button type="submit" class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#destroyModal-{{$technology->id}}"><i class="bi bi-trash3"></i></button>
      </div>
    </div>
    @else
    <h2 class="fs-4 text-secondary">
    Create new technology
    </h2>
    @endif

  @if($technology->id)
    <form action="{{route('admin.technology.update', $technology)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
  @else
    <form action="{{route('admin.technology.store')}}" method="POST" enctype="multipart/form-data">
  @endif
  @csrf
    <div class="row">
      <div class="col-6 mb-3">
        <label for="title" class="form-label">Technology Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $technology->title)}}">
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="col-6 mb-3">
        <label for="color" class="form-label">Color</label>
        <input type="color" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{old('color', $technology->color)}}">
        @error('color')
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