@extends('layouts.template')
@section('title')
    Courses
@endsection
@section('main')
    <h1>Courses</h1>
    <form method="get" action="/course" id="searchForm">
        <div class="row">
            <div class="col-sm-6 mb-2">
                <input type="text" class="form-control" name="course" id="course"
                       value="" placeholder="Filter Course Name or Description">
            </div>
            <div class="col-sm-4 mb-2">
                <select class="form-control" name="programme_id" id="programme_id">
                    <option value="%">All Programmes </option>
                    @foreach($programmes as $programme)
                        <option value="{{ $programme->id }}">{{ $programme->name }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2 mb-2">
                <button type="submit" class="btn btn-success btn-block">Search</button>
            </div>
        </div>
    </form>
    <hr>
    @if ($courses->count() == 0)
        <div class="alert alert-danger alert-dismissible fade show">
            Can't find any course with <b>'{{ request()->course }}'</b> in it
            <button type="button" class="close" data-dismiss="alert">
                <span>&times;</span>
            </button>
        </div>
    @endif
    <div class="row">
        @foreach($courses as $course)
            <div class="col-sm-6 col-md-4 col-lg-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"> {{ $course->name }}</h5>
                        <p class="card-text"> {{ $course->description }}</p>
                        <a href="#" > {{ $course->programme->name }}</a>
                    </div>
                    @auth
                        <div class="card-footer d-flex justify-content-between">
                            <a href="course/{{ $course->id }}" class="btn btn-outline-info btn-sm btn-block">Manage Students</a>
                        </div>
                    @endauth
                </div>
            </div>
        @endforeach
    </div>
@endsection
