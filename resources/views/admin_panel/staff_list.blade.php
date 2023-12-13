@extends('layouts.admin')

@section('title', 'Staffs')

@section('admin-content')

    <livewire:admin_panel.staff-list :staffs_status="true" />

@endsection
