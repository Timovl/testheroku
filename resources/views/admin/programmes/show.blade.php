@extends('layouts.template')
@section('title')
    Programme {{ $programme->name }}
@endsection
@section('main')
    <h1>{{ $programme->name }}</h1>
    @if($courses->count() != 0)
        <p>Courses</p>
        <ul>
            @foreach($courses as $course)
                <li>
                    {{ $course->name }}
                </li>
            @endforeach
        </ul>
    @else
        <p class="alert alert-danger font-weight-bold fade show " >No courses for {{ $programme->name }}!</p>
    @endif
        <h2>Create new course</h2>
        <form action="/admin/programmes" method="post">
            @include('admin.programmes.form2')
        </form>
@endsection
