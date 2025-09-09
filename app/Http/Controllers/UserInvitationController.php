<?php

namespace App\Http\Controllers;

use App\Models\UserInvitation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserInvitationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $users = Auth::user()->organization()->users();


        //Get of users
        $userInvitations = Auth::user()->organization->userInvitations()->get();
        return view("invites.index", [
            'userInvitations'=> $userInvitations
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('invites.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(UserInvitation $userInvitation)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(UserInvitation $userInvitation)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, UserInvitation $userInvitation)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(UserInvitation $userInvitation)
    {
        //
    }
}
