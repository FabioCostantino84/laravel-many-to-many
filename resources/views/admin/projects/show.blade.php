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
                        <p><strong>Type used:
                            </strong>{{ $project->type ? $project->type->type : 'nessuna tipologia usata' }}</p>

                        {{-- tech --}}
                        <div class="d-flex"><strong>Technologies used: </div>
                        @forelse ($project->technologies as $technology)
                            <p class="badge bg-secondary">
                                <i class="fas fa-tag fa-xs fa-fw"></i>
                                {{ $technology->name_tech }}
                            </p>
                        @empty
                            <p class="badge bg-secondary">Untagged</p>
                        @endforelse


                        {{-- git --}}
                        {{-- <p><i class="fa-brands fa-github"></i> {{ $project->github }}</p> --}}

                        <div class="d-inline-block d-flex">
                            <a href="{{ $project->github }}" target="blank" class="btn btn-dark m-1">
                                <i class="fa-brands fa-github"></i>
                            </a>
                        </div>

                        {{-- link --}}
                        <div class="d-inline-block d-flex">
                            <a href="{{ $project->link }}" target="blank" class="btn btn-info text-white">
                                <i class="fa-solid fa-link"></i>
                            </a>
                        </div>

                    </div>
                </div>
            </div>
        </div>

        <a href="{{ route('admin.projects.index') }}" class="btn btn-primary my-3">
            <i class="fa-solid fa-circle-chevron-left"></i> Back</a>

    </div>
@endsection
