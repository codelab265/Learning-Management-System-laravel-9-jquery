<?php

namespace App\Http\Controllers\Admin;

use App\Helper\Reply;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $users = User::where('role', 1)->get();
            return DataTables::of($users)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    $btn = '';
                    $btn .= '<div class="btn-group">';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-primary btn-sm editButton" data-id="' . $row->id . '">Edit</a>';
                    $btn .= '<a href="javascript:void(0)" class="btn btn-danger btn-sm deleteButton" data-id="' . $row->id . '">Delete</a>';
                    $btn .= '</div>';
                    return $btn;
                })->editColumn('is_active', function ($row) {
                    if ($row->is_active) {
                        $status = '<span class="badge rounded-pill bg-success">Active</span>';
                    } else {
                        $status = '<span class="badge rounded-pill bg-danger">Deactivated</span>';
                    }
                    return $status;
                })
                ->rawColumns(['action', 'is_active'])
                ->make(true);
        }
        return view('admin.users.index');
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
        $data = $request->only('name', 'email', 'phone_number');
        $data['is_active'] = true;
        $data['role'] = 1;
        $data['password'] = Hash::make($request->password);

        User::create($data);

        return Reply::success('Added Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $data = $request->only('name', 'email', 'phone_number');
        if ($request->password != "") {
            $data['password'] = Hash::make($request->password);
        }

        $data['is_active'] = (isset($request->is_active)) ? true : false;

        $user->update($data);
        return Reply::success('Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();
        return Reply::success('Deleted Successfully');
    }
}