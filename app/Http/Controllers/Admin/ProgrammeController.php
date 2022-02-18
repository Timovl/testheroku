<?php

namespace App\Http\Controllers\Admin;

use App\Course;
use App\Http\Controllers\Controller;
use App\Programme;
use Facades\App\Helpers\Json;
use Illuminate\Http\Request;

class ProgrammeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programmes = Programme::orderBy('name')->get();
        $result = compact('programmes');
        Json::dump($result);

        return view('admin.programmes.index', $result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $programmes = Programme::select(['id', 'name'])->orderBy('name')->get();
        $result = compact('programmes');
        Json::dump($result);
        return view('admin.programmes.create', $result);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
           'coursename',
           'description',
            'id',
            'name' => 'unique:programmes,name'
        ]);

        if ($request->id){
            $course = new Course();
            $course->name = $request->coursename;
            $course->description = $request->description;
            $course->programme_id = $request->id;
            $course->save();
            // Flash a success message to the session
            session()->flash('success');
            // Redirect to the public detail page for the newly created record
            return redirect("/admin/programmes/$course->programme_id");
        }


        elseif ($request->name) {
            // Create new genre
            $programme = new Programme();
            $programme->name = $request->name;
            $programme->save();

            // Flash a success message to the session
            session()->flash('success', "The Programme <b>$programme->name</b> has been added");
//         Redirect to the master page
            return redirect('admin/programmes');
        }


    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function show(Programme $programme)
    {
        $courses = Course::where([['programme_id', $programme->id]])->get();
        $result = compact('programme', 'courses');
        Json::dump($result);
        return view('admin.programmes.show', $result);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function edit(Programme $programme)
    {
        $result = compact('programme');
        Json::dump($result);
        return view('admin.programmes.edit', $result);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Programme $programme)
    {
        // Validate $request
        $this->validate($request,[
            'name' => 'required|min:3|unique:programmes,name,' . $programme->id
        ]);

        // Update programme
        $programme->name = $request->name;
        $programme->save();

        // Flash a success message to the session
        session()->flash('success', 'The programme has been updated');
        // Redirect to the master page
        return redirect('admin/programmes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Programme  $programme
     * @return \Illuminate\Http\Response
     */
    public function destroy(Programme $programme)
    {
        $programme->delete();
        session()->flash('success', "The programme <b>$programme->name</b> has been deleted");
        return redirect('admin/programmes');
    }
}
