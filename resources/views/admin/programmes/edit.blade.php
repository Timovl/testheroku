@extends('layouts.template')
@section('title', 'Edit programmes')
@section('main')
    <h1>Edit genre: {{ $programme->name }}</h1>
    <form action="/admin/programmes/{{ $programme->id }}" method="post">
        @method('put')
        @include('admin.programmes.form')
    </form>
@endsection
