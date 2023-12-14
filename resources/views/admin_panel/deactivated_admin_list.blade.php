@extends('layouts.admin')

@section('title', 'Deleted Admins')

@section('admin-content')

    <livewire:admin_panel.admin-list :admins_status="false" />

@endsection
