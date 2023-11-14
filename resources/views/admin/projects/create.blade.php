@extends('layouts.admin')

@section('content')

    <h1>Upload a new project</h1>


    @if ($errors->any())
        <div class="alert alert-danger" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif


    <div class="card shadow">
        <div class="card-body">
            <form action="{{ route('admin.projects.store') }}" method="post" enctype="multipart/form-data">

                @csrf


                <div class="mb-3">
                    <label for="title" class="form-label">Titolo</label>
                    {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
                    <input type="text" class="form-control" name="title" id="title" aria-describedby="helpId"
                        placeholder="scrivi un titolo per il tuo progetto" value="{{ old('title') }}">
                    <small id="titleHelper" class="form-text text-muted">Scrivi un titolo per il tuo progetto</small>
                </div>

                <div class="mb-3">
                    <label for="thumb" class="form-label">Choose file</label>
                    <input type="file" class="form-control" name="thumb" id="thumb" placeholder="Choose file"
                    aria-describedby="fileHelpId">
                    <div id="fileHelpId" class="form-text">Add an image</div>
                </div>

                <div class="mb-3">
                    <label for="description" class="form-label">Descrizione</label>
                    {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
                    <textarea type="text" class="form-control" name="description" id="description" aria-describedby="helpId"
                    placeholder="Scrivi una descrizione per il tuo progetto" value="{{ old('description') }}"></textarea>
                </div>
                
                <div class="mb-3">
                    <label for="type_id" class="form-label">Types</label>
                    <select class="form-select @error('type_id') is-invalid  @enderror" name="type_id" id="type_id">
                        <option selected disabled>Select a type</option>
                        <option value="">Uncategorized</option>

                        @forelse ($types as $type)
                            <option value="{{ $type->id }}" {{ $type->id == old('type_id') ? 'selected' : '' }}>
                                {{ $type->type }}</option>
                        @empty
                        @endforelse


                    </select>
                </div>
                @error('type_id')
                    <div class="text-danger">{{ $message }}</div>
                @enderror
                
                <div class="mb-3">
                    <label for="authors" class="form-label">Tech</label>
                    {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
                    <input type="text" class="form-control" name="tech" id="tech" aria-describedby="help"
                        placeholder="Scrivi la tech utilizzata" value="{{ old('tech') }}">
                    <small id="techHelper" class="form-text text-muted">Scrivi la tech utilizzata</small>
                </div>

                <div class="mb-3">
                    <label for="github" class="form-label">Github</label>
                    {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
                    <input type="text" class="form-control" name="github" id="github" aria-describedby="help"
                        placeholder="Inserisci il link di Github" value="{{ old('github') }}">
                    <small id="githubHelper" class="form-text text-muted">Inserisci il link di Github</small>
                </div>

                <div class="mb-3">
                    <label for="link" class="form-label">Link</label>
                    {{-- utilizziamo la funzione old per ridare all'utente i valori inseriti prima,in caso di errore --}}
                    <input type="text" class="form-control" name="link" id="link" aria-describedby="help"
                        placeholder="Scrivi gli autori del tuo progetto" value="{{ old('link') }}">
                    <small id="linkHelper" class="form-text text-muted">Scrivi gli autori del tuo progetto</small>
                </div>


                <button type="submit" class="btn btn-primary">Aggiungi progetto</button>


            </form>
        </div>
    </div>
@endsection
