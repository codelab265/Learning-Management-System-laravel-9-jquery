<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Models\SchoolYear;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SchoolYearController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
        if ($request->ajax()) {
            $users = SchoolYear::all();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<div class="btn-group">';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm editButton" data-id="' . $row->id . '">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm deleteButton" data-id="' . $row->id . '">Delete</a>';
                    $btn .= '</div>';
                    return $btn;
                })->editColumn('status', function ($row) {
                    if ($row->status) {
                        $status = '<span class="badge rounded-pill bg-success">Default</span>';
                    } else {
                        $status = '<span>-</span>';
                    }
                    return $status;
                })
                ->rawColumns(['action', 'status'])
                ->make(true);
        }
        return view('admin.school-year.index');
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
            'school_year' => 'required|unique:school_years,school_year',
        ]);

        if (isset($request->status)) {
            SchoolYear::where('status', 1)->update(['status' => 0]);
        }
        SchoolYear::create($request->only('school_year', 'status'));
        return Reply::success('Added successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolYear $schoolYear)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function edit(SchoolYear $schoolYear)
    {
        return view('admin.school-year.edit', compact('schoolYear'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, SchoolYear $schoolYear)
    {
        if (isset($request->status)) {
            SchoolYear::where('status', 1)->update(['status' => 0]);
            $schoolYear->update(['status' => 1]);
        }

        return Reply::success('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolYear  $schoolYear
     * @return \Illuminate\Http\Response
     */
    public function destroy(SchoolYear $schoolYear)
    {
        if ($schoolYear->status == 1) {
            return Reply::error('You cannot delete the default school year');
        } else {
            $schoolYear->delete();
        }

        return Reply::success('Deleted successfully');
    }
}