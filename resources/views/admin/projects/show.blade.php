@extends('layouts.admin')

@section('content')
    <div class="container">

        <h2 class=" my-4">
            {{ __('Project Details for') }} {{ Auth::user()->name }}.
        </h2>
        <h3 class="fs-5 text-secondary">
            {{ __('Showing Project') }} ID: {{ $project->id }}
        </h3>

        <div class="row justify-content-center my-3">
            <div class="col-6">
                <div class="card">
                    <div class="card-header">
                        <h5>Title: {{ $project->title }}</h5>
                    </div>

                    @if (str_contains($project->thumb, 'http'))
                        <img class="img-fluid object-fit-cover" style="height: 400px" src="{{ $project->thumb }}"
                            alt="{{ $project->title }}">
                    @else
                        <img class="img-fluid object-fit-cover" style="height: 400px"
                            src="{{ asset('storage/' . $project->thumb) }}">
                    @endif

                    <div class="card-body">
                        <p><strong>Description: </strong>{{ $project->description }}</p>
                        <p><strong>Type used: </strong>{{ $project->type ? $project->type->type : 'nessuna tecnologia usata'  }}</p>
                        <p><strong>Technologies used: </strong>{{ $project->tech }}</p>
                        <p><i class="fa-brands fa-github"></i> {{ $project->github }}</p>
                        <p><i class="fa-solid fa-link"></i> {{ $project->link }}</p>
                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary my-3">
            <i class="fa-solid fa-circle-chevron-left"></i> Back</a>

    </div>
@endsection
