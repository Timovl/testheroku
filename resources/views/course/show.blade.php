@extends('layouts.template')
@section('title')
    Course {{ $courses->name }}
@endsection
@section('main')
    <h1>{{ $courses->name }}</h1>
    <p>{{ $courses->description }}</p>

    @if($courses->studentcourse->count() != 0)
        <p>students enrolled:</p>
        <ul>
            @foreach($courses->studentcourse as $students)
                <li>{{$students->student->first_name}} {{$students->student->last_name}} (semester {{ $students->semester}})</li>
            @endforeach
        </ul>
    @else
        <p class="alert alert-danger font-weight-bold fade show " >No students enrolled!</p>
    @endif
@endsection
