@extends('layouts.admin')

@section('title', 'Dashboard')

@section('admin-content')

    @if (auth()->user()->role->name == 'Admin' || auth()->user()->role->name == 'AMREF personnel')
        <livewire:admin-panel.dashboard-live />
    @elseif (auth()->user()->role->name == 'Regional coordinator')
        <livewire:admin-panel.rc-dashboard-live />
    @endif

@endsection
