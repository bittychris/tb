@extends('layouts.admin')

@section('title', 'View Single Report')

@section('admin-content')

    <livewire:admin_panel.single-form :form="$form" />

@endsection
