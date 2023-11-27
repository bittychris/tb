@extends('layouts.admin')

@section('title', 'Form')

@section('admin-content')

    <livewire:admin_panel.create-form :form_attributes_id="$form_attributes_id"/>

@endsection
