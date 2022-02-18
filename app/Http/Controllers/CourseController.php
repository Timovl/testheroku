<?php

namespace App\Http\Controllers;

use App\Course;
use App\Programme;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;

class CourseController extends Controller
{
    public function index(Request $request)
    {
        $programme_id = $request->input('programme_id') ?? '%';
        $course_title = '%' . $request->input('course') . '%';
        $courses = Course::with('programme')
            ->where([
                ['name', 'like', $course_title],
                ['programme_id', 'like', $programme_id]
            ])
            ->orWhere([
                ['description', 'like', $course_title],
                ['programme_id', 'like', $programme_id]
            ])
            ->get();
        $programmes = Programme::orderBy('name')->get();
        $result = compact('courses', 'programmes');
        Json::dump($result);

        return view('course.index', $result);
    }
    public function show($id)
    {
        $courses = Course::with('studentcourse')->with('studentcourse.student')->findOrFail($id);
        $result = compact('courses');
        Json::dump($result);
        return view('course.show', $result);
    }
}
