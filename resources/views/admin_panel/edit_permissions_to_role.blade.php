@extends('layouts.admin')

@section('title', 'Update Permissions assigned to role')

@section('admin-content') 

    <livewire:admin_panel.add-permissions-to-role :role_id="$role_id" />

@endsection