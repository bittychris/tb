@extends('layouts.admin')

@section('title', 'Admins')

@section('admin-content')

    <livewire:admin_panel.admin-list :admins_status="true" />

@endsection
