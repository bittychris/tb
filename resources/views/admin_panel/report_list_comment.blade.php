@extends('layouts.admin')

@section('title', 'Report List')

@section('admin-content')

    <livewire:admin_panel.report-list :form="$form" />

@endsection
