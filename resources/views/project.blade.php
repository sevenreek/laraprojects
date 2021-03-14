@extends('layouts.base')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        <h1 class="h3 mb-0 text-gray-800">{{ $project->name }}</h1>
        @can('project-manage', $project->id)
        <a href="{{ url('/project/' .$project->id. '/edit') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-pen fa-sm text-white-50"></i> {{ __('project.edit_information') }}</a>
        @endcan
    </div>

    <!-- Content Row -->
    <div class="row">

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">{{ __('project.owner') }}</div>
                            <div class="row no-gutters align-items-center">
                                <div class="col-auto">
                                    <a href="{{ url('/user/'.$project->creator_id) }}">
                                        <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">{{ $project->creator_name }}</div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">{{ __('project.started_on') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $project->created_at }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">{{ __('project.price') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ $project->price }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>



        <!-- Pending Requests Card Example -->
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-danger shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-danger text-uppercase mb-1">{{ __('project.deadline') }}</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $project->deadline }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Content Row -->

    <div class="row">

        <!-- Descripion -->
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('project.description') }}</h6>
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    {{ $project->description }}
                </div>
            </div>
        </div>

        <!-- Contributors -->
        <div class="col-xl-4 col-lg-4">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('project.contributors') }}</h6>
                    @can('project-manage', $project->id)
                    <a href="{{ url('/project/'.$project->id.'/adduser') }}" role="button">
                        <i class="fas fa-plus fa-sm fa-fw text-gray-400"></i>
                    </a>
                    @endcan
                </div>
                <!-- Card Body -->
                <div class="card-body">

                    @foreach($contribs as $contrib)
                    <div class="row">
                        <div class="col-2">
                            <img class="rounded-circle" src="https://robohash.org/{{ $contrib->contributor }}.bmp?size=50x50&amp;set=set1">
                        </div>
                        <div class="col-10">
                            <!--<div class="dropdown no-arrow" style="float:right;">
                                <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                                </a>
                                
                                <div class="dropdown-menu dropdown-menu-right shadow animated--fade-in" aria-labelledby="dropdownMenuLink">
                                    <div class="dropdown-header">Manage user:</div>
                                    <a class="dropdown-item" href="#">Make worker</a>
                                    <a class="dropdown-item" href="#">Make viewer</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="#">Remove contributor</a>
                                </div>
                                
                            </div>-->
                            <div><a href="{{url('/user/'.$contrib->contributor_id)}}">{{ $contrib->contributor }}</a></div>
                            <div>{{ $contrib->access }}</div>
                        </div>
                    </div>
                    @if(!$loop->last)
                    <hr>
                    @endif
                    @endforeach

                </div>
            </div>
        </div>

        <!-- Tasks -->
        <div class="col-xl-8 col-lg-8">
            <div class="card shadow mb-4">
                <!-- Card Header - Dropdown -->
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">{{ __('project.tasks') }}</h6>
                    @can('project-work', $project->id)
                    <form class="form-inline float-right" id="new-task-form" method="post" action="{{ url('project/'.$project->id.'/addtask') }}">
                        @csrf
                        <div class="input-group">
                            <input type="text" class="form-control bg-white border-0 small" name="new_task" placeholder="{{ __('project.tasks_new_placeholder') }}">
                            <div class="input-group-append">
                                <a href="javascript:{}" onclick="{document.getElementById('new-task-form').submit();}">
                                    <button class="btn btn-primary" type="button">
                                        <i class="fas fa-plus fa-sm"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </form>
                    @endcan
                </div>
                <!-- Card Body -->
                <div class="card-body">
                    <form id='task-toggle' method='post' action="{{ url('project/'.$project->id.'/settask') }}">
                        @csrf
                        <input type='hidden' name='task_id' id="task_id">
                        <input type='hidden' name='set_to' id="set_to">
                    </form>
                    @foreach($jobs as $job)
                    <div class="row">
                        <div class="col-11 h5 font-weight-bold text-gray-800">
                            <div class="task-name">{{ $job->name }}</div>
                        </div>

                        <div class="col-1">
                            @if(is_null($job->completed_at))
                            <a href="javascript:{}" onclick="{document.getElementById('task_id').value=({{ $job->id }}); document.getElementById('set_to').value=(1); document.getElementById('task-toggle').submit();}">

                                <i class="fas fa-check-square fa-2x text-gray-300"></i>
                            </a>
                            @else
                            <a href="javascript:{}" onclick="{document.getElementById('task_id').value=({{ $job->id }}); document.getElementById('set_to').value=(0); document.getElementById('task-toggle').submit();}">
                                <i class="fas fa-check-square fa-2x text-green-300"></i>
                            </a>
                            @endif

                        </div>
                    </div>
                    @if(!$loop->last)
                    <hr>
                    @endif
                    @endforeach
                </div>

            </div>
        </div>
    </div>



</div>
<!-- /.container-fluid -->

@endsection