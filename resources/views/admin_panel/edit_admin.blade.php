@extends('layouts.admin')

@section('title', 'Edit Admin details')

@section('admin-content')

    <livewire:admin_panel.add-admin :admin_id="$admin_id"/>

@endsection
