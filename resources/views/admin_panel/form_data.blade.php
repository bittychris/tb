@extends('layouts.admin')

@section('title', '{{ $form->scanning_name }}')

@section('admin-content')

    <livewire:admin_panel.form-data :form="$form"/>

@endsection
