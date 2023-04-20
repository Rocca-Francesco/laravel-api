@extends('layouts.app')

@section('cdns')
{{-- bootstrap icons --}}
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.4/font/bootstrap-icons.css">
@endsection

@section('content')
    
<div class="container">
    <div class="d-flex justify-content-between align-items-center">
			<h2 class="fs-4 text-secondary mt-4">
        {{ __('Projects List') }}
    	</h2>
			<a href="{{route('admin.projects.create')}}" class="btn btn-primary mt-4">Create new project</a>
		</div>
    <div class="row justify-content-center">
			<table class="table  table-striped">
				<thead>
					<tr>
						<th scope="col"><a href="{{ route('admin.projects.index') }}?sort=id&order=@if ($sort == 'id' && $order != 'DESC') DESC @else ASC @endif ">
							ID
							@if($sort == 'id')
								<i class="bi bi-caret-up-fill d-inline-block @if ($order == 'DESC') rotation @endif "></i>
							@endif
						</a></th>
						<th scope="col"><a href="{{ route('admin.projects.index') }}?sort=title&order=@if ($sort == 'title' && $order != 'DESC') DESC @else ASC @endif ">
							TITOLI
							@if($sort == 'title')
								<i class="bi bi-caret-up-fill d-inline-block @if ($order == 'DESC') rotation @endif "></i>
							@endif
						</a></th>
						<th>
							TIPI
						</th>
						<th>
							TECNOLOGIE
						</th>
						<th scope="col"><a href="{{ route('admin.projects.index') }}?sort=lenguages @if ($sort == 'lenguages' && $order != 'DESC') DESC @else ASC @endif ">
							LINGUAGGI
							@if($sort == 'lenguages')
								<i class="bi bi-caret-up-fill d-inline-block @if ($order == 'DESC') rotation @endif "></i>
							@endif
						</a></th>
						<th scope="col">actions</th>
					</tr>
				</thead>
				<tbody>
						@foreach ($projects as $project)
						<tr>
							<th scope="row">{{$project->id}}</th>
							<td>{{$project->title}}</td>
							<td><span class="badge rounded-pill" style="background-color: {{$project->type?->color}}">{{$project->type?->title}}</span></td>
							<td>
								@forelse($project->technologies as $technology)
									<span class="badge rounded-pill" style="background-color: {{$technology->color}}">{{$technology->title}}</span>
								@empty
									-
								@endforelse
							</td>
							<td>{{$project->lenguages}}</td>
							<td>
								<a href="{{route('admin.projects.show', $project)}}" class="btn btn-primary my-2"><i class="bi bi-eye"></i></a>
								<a href="{{route('admin.projects.edit', $project)}}" class="btn btn-primary my-2"><i class="bi bi-pencil-square"></i></a>
								<a href="{{$project->link}}" class="btn btn-primary"><i class="bi bi-link-45deg"></i></a>
								<button type="submit" class="btn btn-danger my-2" data-bs-toggle="modal" data-bs-target="#destroyModal-{{$project->id}}"><i class="bi bi-trash3"></i></button>	
							</td>
						</tr>
						@endforeach
					</tbody>
				</table>

    </div>
		<div class="my-2">
			{{$projects->links()}}
		</div>
	</div>
	
@endsection

@section('modals')
	@foreach ($projects as $project)
	<div class="modal fade" id="destroyModal-{{$project->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title fs-5" id="exampleModalLabel">Vuoi eliminare {{$project->title}}? </h1>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					Vuoi eliminare il progetto? <br>
					Questa operazione è irreversibile.
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
	@endforeach
@endsection