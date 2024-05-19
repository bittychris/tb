@extends('layouts.admin')

@section('title', 'Report List')

@section('admin-content')

    <livewire:report-live :report="$report" />

@endsection
