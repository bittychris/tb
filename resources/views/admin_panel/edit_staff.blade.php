@extends('layouts.admin')

@section('title', 'Edit Staff details')

@section('admin-content')

    <livewire:admin_panel.add-staff :staff_id="$staff_id"/>

@endsection
