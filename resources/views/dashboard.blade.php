@extends('template.main')

@section('content')

<div class="container-fluid px-4">
    @if(auth()->user()->role == 'up')
        
        @include('dashboard_roles.up')

    @elseif(auth()->user()->role == 'ppid')
        
        @include('dashboard_roles.ppid')

    @elseif(auth()->user()->role == 'manajemen')
        
        @include('dashboard_roles.manajemen')

    @endif

</div>  
@endsection