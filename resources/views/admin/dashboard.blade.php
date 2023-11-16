@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="fs-4 text-secondary my-4">
        <i class="bi bi-body-text"></i> {{__('Welcome')}} {{Auth::user()->name}}!
    </h2>
    @if (session('status'))
    <div class="alert alert-success" role="alert">
        {{ session('status') }}
    </div>
    @endif



    <div class="row justify-content-center">
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-uppercase">
                        <i class="fa-solid fa-folder-open fa-lg fa-fw"></i> Total Projects
                    </h4>
                    <strong class="fs-2">{{$total_projects}}</strong>
                </div>
                <div class="card-footer text-end">
                    <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Go
                        <i class="fa-solid fa-share"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-uppercase">
                        <i class="fa-solid fa-user"></i> Users
                    </h4>
                    <strong class="fs-2">{{$total_users}}</strong>

                </div>
                <div class="card-footer text-end">
                    <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Go
                        <i class="fa-solid fa-share"></i>
                    </a>
                </div>
            </div>
        </div>
        <div class="col">
            <div class="card">
                <div class="card-body">
                    <h4 class="text-uppercase">
                        <i class="fa-solid fa-gear"></i> Tech used
                    </h4>
                    <strong class="fs-2">{{$total_technologies}}</strong>

                </div>
                <div class="card-footer text-end">
                    <a href="{{route('admin.projects.index')}}" class="btn btn-primary">Go
                        <i class="fa-solid fa-share"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
