@extends('layouts.base')

@section('content')

<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">

        @isset($project)
        <h1 class="h3 mb-0 text-gray-800">{{ __('users.add') }} {{ $project->name }}</h1>
        <form id='user-add' method='post' action="{{ url('project/'.$project->id.'/adduser') }}">
            @csrf
            <input type='hidden' name='project_id' value="{{ $project->id }}">
            <input type='hidden' name='user_id' id="user_id">
        </form>
        @else
        <h1 class="h3 mb-0 text-gray-800">{{ __('users.list') }}</h1>
        @endisset
    </div>

    <!-- Content Row -->
    <div class="row">
        @forelse($users as $user)
        <!-- Earnings (Monthly) Card Example -->
        <div class="col-xl-3 col-lg-4 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col-10">
                            <div class="d-flex align-items-center">
                                <div class="d-inline-block mr-1">
                                    <img class="rounded-circle" src="https://robohash.org/{{ $user->name }}.bmp?size=50x50&amp;set=set1">
                                </div>
                                <div class="d-inline-block">
                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                        <a href="{{ url('/user/'.$user->id) }}">{{ $user->name }}</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                        @isset($project)
                        <div class="col-2">
                            <a href="javascript:{}" onclick="{document.getElementById('user_id').value=({{ $user->id }});} document.getElementById('user-add').submit();">
                                <i class="fas fa-plus fa-2x text-gray-300"></i>
                            </a>
                        </div>
                        @endisset
                    </div>
                </div>
            </div>
        </div>
        @empty
        @isset($project)
        {{ __('users.no_more_add') }}
        @else
        {{ __('users.no_more_list') }}
        @endisset
        @endforelse


    </div>
    <!-- /.container-fluid -->

    @endsection