@extends('layouts.admin')

@section('title', 'Assign Permissions to role')

@section('admin-content') 

    <livewire:admin_panel.add-permissions-to-role :role_id="null" />

@endsection