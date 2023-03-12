<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Models\Classes;
use App\Models\Subject;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        $classes = Classes::all();
        if ($request->ajax()) {
            $subject = Subject::all();
            return DataTables::of($subject)
                ->addIndexColumn()
                ->editColumn('class_id', function ($row) {
                    return $row->class->name;
                })
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<div class="btn-group">';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm editButton" data-id="' . $row->id . '">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm deleteButton" data-id="' . $row->id . '">Delete</a>';
                    $btn .= '</div>';
                    return $btn;
                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('admin.subjects.index', compact('classes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'class_id' => 'required',
            'subject_code' => 'required|unique:subjects,subject_code',
            'subject_name' => 'required',
            'units' => 'required|min:1',
            'semester' => 'required'
        ]);

        Subject::create($request->only('class_id', 'subject_code', 'subject_name', 'units', 'semester', 'description'));
        return Reply::success('Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit(Subject $subject)
    {
        $classes = Classes::all();
        return view('admin.subjects.edit', compact('subject', 'classes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Subject $subject)
    {
        $subject->update($request->only('class_id', 'subject_code', 'subject_name', 'units', 'semester', 'description'));
        return Reply::success('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy(Subject $subject)
    {
        $subject->delete();
        return Reply::success('Deleted successfully');
    }
}