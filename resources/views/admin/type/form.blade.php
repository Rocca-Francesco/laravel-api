@extends('layouts.app')

@section('cdns')
{{-- bootstrap icons --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
@endsection

@section('content')

<div class="container">
    @if($type->id)
    <div class="d-flex justify-content-between align-items-center mt-4">
      <h2 class="fs-4 text-secondary">
        Edit Project {{$type->title}}
      </h2>
      <div>
        <a href="{{route('admin.type.index')}}" class="btn btn-primary">Torna alla lista</a>
        <button type="submit" class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#destroyModal-{{$type->id}}"><i class="bi bi-trash3"></i></button>
      </div>
    </div>
    @else
    <h2 class="fs-4 text-secondary">
    Create new type
    </h2>
    @endif

  @if($type->id)
    <form action="{{route('admin.type.update', $type)}}" method="POST" enctype="multipart/form-data">
    @method('PUT')
  @else
    <form action="{{route('admin.type.store')}}" method="POST" enctype="multipart/form-data">
  @endif
  @csrf
    <div class="row">
      <div class="col-6 mb-3">
        <label for="title" class="form-label">Type Title</label>
        <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{old('title', $type->title)}}">
        @error('title')
        <div class="invalid-feedback">
          {{ $message }}
        </div>
        @enderror
      </div>
      <div class="col-6 mb-3">
        <label for="color" class="form-label">Color</label>
        <input type="text" class="form-control @error('color') is-invalid @enderror" id="color" name="color" value="{{old('color', $type->color)}}">
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