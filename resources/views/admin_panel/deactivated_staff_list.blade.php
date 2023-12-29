@extends('layouts.admin')

@section('title', 'Deleted Staffs')

@section('admin-content')

    <livewire:admin_panel.staff-list :staffs_status="$staffs_status" />

@endsection
