@extends('layouts.admin')

@section('content')
    @if (session('message'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            <strong>Congratulazioni!</strong> {{ session('message') }}
        </div>
    @endif

    <h1>Projects all</h1>


    {{ $projects->links('pagination::bootstrap-5') }}

    <form class="mx-2" action="{{ route('admin.projects.create') }}">
        <button class="btn btn-success mb-3" type="submit">
            <i class="fa-solid fa-arrow-up-from-bracket"></i>
            Upload a new projects</button>
    </form>

    <div class="table-responsive mt-5">
        <table class="table table-striped table-hover table-borderless table-light align-middle">

            <thead class=" table-light">



                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Preview</th>
                    <th scope="col">Title</th>
                    <th scope="col">Description</th>
                    <th scope="col">Type used</th>
                    <th scope="col">Tech used</th>
                    <th scope="col">Github link</th>
                    <th scope="col">Project link</th>
                    <th scope="col">Actions</th>
                    <th></th>
                </tr>
            </thead>

            <tbody class=" table-group-divider">
                @forelse ($projects as $project)
                    <tr>
                        <td scope="row">{{ $project->id }}</td>

                        <td class="text-center align-middle">
                            @if (empty($project->thumb))
                                {{-- Se l'URL dell'immagine non è presente --}}
                                N/D
                            @elseif (Str_contains($project->thumb, 'http') || Str_contains($project->thumb, 'https'))
                                {{-- Se l'URL contiene 'http' o 'https', utilizza l'URL fornito --}}
                                <img class="img-fluid img-fluid object-fit-cover" style="height: 100px"
                                    src="{{ $project->thumb }}" alt="{{ $project->title }}">
                            @else
                                {{-- Altrimenti, utilizza l'URL relativo --}}
                                <img class="img-fluid img-fluid object-fit-cover" style="height: 100px"
                                    src="{{ asset('storage/' . $project->thumb) }}" alt="{{ $project->title }}">
                            @endif
                        </td>



                        <td>{{ $project->title }}</td>
                        <td>{{ $project->description }}</td>
                        <td>{{ $project->type ? $project->type->type : 'nessuna tipologia usata' }}</td>

                        <td>
                            @foreach ($project->technologies as $technology)
                                {{ $technology->name_tech }}
                            @endforeach
                        </td>
                        

                        {{-- {{dd($technology->technologies)}} --}}
                        {{-- <td>{{ $technology->name_tech ? $technology->name_tech : 'nessuna tecnologia usata' }}</td> --}}

                        <td class="align-middle text-center">
                            <div class="d-inline-block d-flex">
                                <a href="{{ $project->github }}" target="blank" class="btn btn-dark m-1">
                                    <i class="fa-brands fa-github"></i>
                                </a>
                            </div>
                        </td>

                        <td class="align-middle text-center">
                            <div class="d-inline-block d-flex">
                                <a href="{{ $project->link }}" target="blank" class="btn btn-info m-1">
                                    <i class="fa-solid fa-link"></i>
                                </a>
                            </div>
                        </td>
                        {{-- <td>{{ $project->github }}</td>
                        <td>{{ $project->link }}</td> --}}
                        <td class="align-middle text-center">
                            <div class="d-inline-block d-flex">
                                <a href="{{ route('admin.projects.show', $project) }}" class=" m-1 btn btn-primary">
                                    <i class="fa-regular fa-eye"></i>
                                </a>

                                <a href="{{ route('admin.projects.edit', $project) }}" class=" m-1 btn btn-info">
                                    <i class="fa-solid fa-pen-to-square"></i>
                                </a>

                                {{-- Modale --}}
                                <button type="button" class=" m-1 btn btn-danger" data-bs-toggle="modal"
                                    data-bs-target="#deleteProject-{{ $project->id }}">
                                    <i class="fa-regular fa-trash-can"></i>
                                </button>

                                {{-- Testo della modale --}}
                                <div class="modal fade" id="deleteProject-{{ $project->id }}" tabindex="-1"
                                    data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
                                    aria-labelledby="modalTitle-{{ $project->id }}" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm"
                                        role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="modalTitle-{{ $project->id }}">
                                                    {{ $project->title }}</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                    aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ⚠ Attention! This is a destructive operation. You cannot undo this!
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary"
                                                    data-bs-dismiss="modal">Close</button>


                                                <form action="{{ route('admin.projects.destroy', $project) }}"
                                                    method="post">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">⚡ Confirm</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </td>
                    </tr>
                @empty

                    <tr class="table-primary">
                        <td scope="row">No posts here! 🙀</td>

                    </tr>
                @endforelse



            </tbody>
            <tfoot>


            </tfoot>
        </table>

        <a href="{{ route('admin.dashboard') }}" class="btn btn-primary my-3">
            <i class="fa-solid fa-circle-chevron-left"></i> Back to Dashboard</a>

        {{ $projects->links('pagination::bootstrap-5') }}

    </div>
@endsection
