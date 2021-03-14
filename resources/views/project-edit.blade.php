@extends('layouts.base')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        @isset($project)
        <h1 class="h3 mb-0 text-gray-800">{{ __('project_edit.header_edit') }}</h1>
        <a href="javascript:{}" onclick="document.getElementById('project-form').submit();" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-save fa-sm text-white-50"></i> {{ __('project_edit.save') }}</a>
        @else
        <h1 class="h3 mb-0 text-gray-800">{{ __('project_edit.header_create') }}</h1>
        <a href="javascript:{}" onclick="document.getElementById('project-form').submit();" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus fa-sm text-white-50"></i> {{ __('project_edit.create') }}</a>
        @endisset
    </div>

    <!-- Content Row -->


    <div class="row">

        <!-- Area Chart -->
        <div class="col-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('project_edit.basics') }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    @isset($project)
                    <form class="d-inline form-inline" method="POST" action="{{ url('project/'. $project->id .'/edit') }}" id="project-form">
                    @else
                    <form class="d-inline form-inline" method="POST" action="{{ url('project/new') }}" id="project-form">
                    @endisset
                    @csrf
                        <h6>{{ __('project_edit.title') }}:</h6>
                        <div class="form-group">
                            <input type="text" name="title" class="form-control bg-light border-0" placeholder="{{ __('project_edit.title') }}" value="{{ $project->name ?? ''}}">
                        </div>
                        <hr>
                        <h6>{{ __('project_edit.description') }}:</h6>
                        <div class="form-group">
                            <textarea class="form-control" name="description" id="exampleFormControlTextarea1" rows="4" placeholder="{{ __('project_edit.description') }}">{{ $project->description  ?? ''}}</textarea>
                        </div>
                        <hr>
                        <h6>{{ __('project_edit.price') }}:</h6>
                        <div class="form-group">
                            <input type="number" name="price" class="form-control bg-light border-0" placeholder="$" value="{{ $project->price ?? ''}}">
                        </div>
                        <hr>
                        <h6>{{ __('project_edit.deadline') }}:</h6>
                        <div class="form-group">
                            <input type="date" name="deadline" class="form-control bg-light border-0" placeholder="Deadline" value="{{ date('Y-m-d', strtotime($project->deadline ?? '')) }}">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- End of Main Content -->


</div>
<!-- End of Content Wrapper -->
@endsection