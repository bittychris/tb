@extends('layouts.admin')

@section('title', 'Edit Form Attributes')

@section('admin-content')

    <livewire:admin_panel.add-form-attribute :form_id="$form_id"/>

@endsection
