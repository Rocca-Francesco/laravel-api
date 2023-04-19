@extends('layouts.app')

@section('cdns')
{{-- bootstrap icons --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
@endsection

@section('content')
    
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
			<h2 class="fs-4 text-secondary mt-4">
        {{ __('Type List') }}
    	</h2>
			<a href="{{route('admin.type.create')}}" class="btn btn-primary mt-4">Create new type</a>
		</div>
    <div class="row justify-content-center">
			<table class="table  table-striped">
				<thead>
					<tr>
						<th scope="col"><a href="{{ route('admin.type.index') }}?sort=id&order=@if ($sort == 'id' && $order != 'DESC') DESC @else ASC @endif ">
							ID
							@if($sort == 'id')
								<i class="bi bi-caret-up-fill d-inline-block @if ($order == 'DESC') rotation @endif "></i>
							@endif
						</a></th>
						<th scope="col"><a href="{{ route('admin.type.index') }}?sort=title&order=@if ($sort == 'title' && $order != 'DESC') DESC @else ASC @endif ">
							TITOLI
							@if($sort == 'title')
								<i class="bi bi-caret-up-fill d-inline-block @if ($order == 'DESC') rotation @endif "></i>
							@endif
						</a></th>
						<th scope="col"><a href="{{ route('admin.type.index') }}?sort=color @if ($sort == 'color' && $order != 'DESC') DESC @else ASC @endif ">
							COLORE
							@if($sort == 'color')
								<i class="bi bi-caret-up-fill d-inline-block @if ($order == 'DESC') rotation @endif "></i>
							@endif
						</a></th>
						<th>
							ANTEPRIMA
						</th>
						<th scope="col">actions</th>
					</tr>
				</thead>
				<tbody>
						@foreach ($types as $type)
						<tr>
							<th scope="row">{{$type->id}}</th>
							<td>{{$type->title}}</td>
							<td>{{$type->color}}</td>
							<td><span class="badge rounded-pill" style="background-color: {{$type->color}}">{{$type->title}}</span></td>
							<td>
								<a href="{{route('admin.type.edit', $type)}}" class="btn btn-primary my-2"><i class="bi bi-pencil-square"></i></a>
								<button type="submit" class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#destroyModal-{{$type->id}}"><i class="bi bi-trash3"></i></button>	
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

    </div>
		<div class="my-2">
			{{$types->links()}}
		</div>
	</div>
	
@endsection

@section('modals')
	@foreach ($types as $type)
	<div class="modal fade" id="destroyModal-{{$type->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Vuoi eliminare {{$type->title}}? </h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Vuoi eliminare il tipo? <br>
					Questa operazione è irreversibile.
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
				<form action="{{route('admin.type.destroy', $type)}}" method="POST">
            @method('delete')
            @csrf

            <button type="submit" class="btn btn-danger">Delete</button>

        </form>
				</div>
			</div>
		</div>
	</div>
	@endforeach
@endsection