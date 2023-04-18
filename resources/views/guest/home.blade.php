@extends('layouts.guest')

@section('content')
    <div class="container text-center">
        <h2 class="text-danger">Benvenuto!</h2>
        <h3>Questa è la lista dei miei progetti</h3>
        <div class="row row-cols-4">
            @foreach ($projects as $project)
                <div class="col g-2">
                    <div class="card" style="width: 18rem;">
                        <div class="card-body">
                            <h5 class="card-title">{{$project->title}}</h5>
                            <p class="card-text">Programming Lenguages used: {{$project->lenguages}} </p>
                            <a href="{{route('guest.show', $project)}}" class="btn btn-primary my-2">Go to detail about project</a>
                            <a href="{{$project->link}}" class="btn btn-primary">Go to project</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="my-2">
			{{$projects->links()}}
		</div>
    </div>
@endsection