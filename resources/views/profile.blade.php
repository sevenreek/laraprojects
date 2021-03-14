@extends('layouts.base')

@section('content')
<!-- Begin Page Content -->
<div class="container-fluid">

  <!-- Page Heading -->
  @if( Auth::user()->id == $user->id)
  <h1 class="h3 mb-2 text-gray-800">{{ __('profile.welcome_back') }} {{ $user->name }}!</h1>
  @endif

  <!-- Content Row -->
  <div class="row">

    <div class="col-7">

      <!-- Area Chart -->
      <div class="card shadow mb-4">
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('profile.information') }}</h6>
        </div>
        <div class="card-body">
          <div class="d-flex">
            <div class="d-inline-block mr-3">
              <img class="rounded-circle" src="https://robohash.org/{{ $user->name }}.bmp?size=100x100&amp;set=set1">
            </div>
            <div class="d-inline-block">
              <h1>{{ $user->name }}</h1>
              <h5><a href="mailto:{{ $user->email }}">{{ $user->email }}</a></h5>
              <h6>{{ __('profile.joined') }} {{ $user->created_at }}</h6>
            </div>
          </div>
          <hr>
          <div>
            <i>{{ $user->bio }}</i>
          </div>
        </div>
      </div>

    </div>
    <!-- Donut Chart -->
    <div class="col-5">
      <div class="card shadow mb-4">
        <!-- Card Header - Dropdown -->
        <div class="card-header py-3">
          <h6 class="m-0 font-weight-bold text-primary">{{ __('profile.assigned_projects') }}</h6>
        </div>
        <!-- Card Body -->
        <div class="card-body">
          @forelse($projects as $project)
          <div class="d-flex">
            <div class="d-inline-block mr-2">
              <a href="{{ url('/project/'.$project->id) }}">
                <img class="rounded-circle" src="https://dummyimage.com/50x50/99f/fff&text={{ substr($project->project,0,2) }}">
              </a>
            </div>
            <div class="d-inline-block">
              <div><a href="{{ url('/project/'.$project->id) }}">{{ $project->project }}</a></div>
              <div>{{ __('roles.'.$project->access) }}</div>
            </div>
          </div>
          @if(!$loop->last)
          <hr>
          @endif
          @empty
          @if( Auth::user()->id == $user->id)
          <i>{{ __('profile.no_projects_you') }}</i>
          @else
          <i>{{ $user->name }} {{ __('profile.no_projects_he') }}</i>
          @endif
          @endforelse
        </div>
      </div>
    </div>



  </div>
</div>
<!-- /.container-fluid -->
@endsection