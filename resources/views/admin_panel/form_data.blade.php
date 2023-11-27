@extends('layouts.admin')

@section('title', 'Insert Data')

@section('admin-content')

    <livewire:admin_panel.form-data :form="$form"/>

@endsection
