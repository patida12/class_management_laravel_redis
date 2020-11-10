<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
    }

    /**
     * Display a list students.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllStudents()
    {
        $users = User::where('permission', 0)->get();
        return view(
            'users.index',
            ['users' => $users, 'isListTeacher' => false]
        );
    }

    /**
     * Display a list teachers.
     *
     * @return \Illuminate\Http\Response
     */
    public function getAllTeachers()
    {
        $users = User::where('permission', 1)->get();
        return view(
            'users.index',
            ['users' => $users, 'isListTeacher' => true]
        );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('users.create');
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
            'fullname' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phonenumber' => ['string', 'max:255', 'unique:users'],
        ]);
        $user = new User();
        $user->username = $request->username;
        $user->password = Hash::make($request->password);
        $user->fullname = $request->fullname;
        $user->email = $request->email;
        $user->phonenumber = $request->phonenumber;
        $user->save();

        return redirect()->action([UserController::class, 'getAllStudents'])->with('success_add', 'Add thành công!');
    }

    /**
     * Display the current user.
     *
     * @param
     * @return \Illuminate\Http\Response
     */
    public function currentUser()
    {
        $user = Auth::user();
        return $user;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getProfile()
    {
        $id = Auth::user()->id;
        $user = User::find($id);

        return view(
            'users.profile',
            ['user' => $user]
        );
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        return view(
            'users.show',
            ['user' => $user]
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = User::find($id);
        return view(
            'users.edit',
            ['user' => $user]
        );
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::find($id);
        $username = $request->username;
        $email = $request->email;
        $phonenumber = $request->phonenumber;

        if ($username != $user->username) {
            $this->validate($request, [
                'username' => ['unique:users'],
            ]);
        }
        if ($email != $user->email) {
            $this->validate($request, [
                'email' => ['unique:users'],
            ]);
        }
        if ($phonenumber != $user->phonenumber) {
            $this->validate($request, [
                'phonenumber' => ['unique:users'],
            ]);
        }

        $this->validate($request, [
            'username' => ['required', 'string', 'max:255'],
            'fullname' => ['required', 'string', 'max:255'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phonenumber' => ['string', 'max:255'],
        ]);
        $user->username = $request->username;
        $user->email = $request->email;
        $user->phonenumber = $request->phonenumber;
        $user->password = Hash::make($request->password);
        $user->fullname = $request->fullname;
        $user->save();

        if ($user->permission != 0) {
            $url = 'getAllTeachers';
        }
        else {
            $url = 'getAllStudents';
        }
        return redirect()->action([UserController::class, $url])->with('success_update', 'Update thành công!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateProfile(Request $request)
    {
        $id = Auth::user()->id;
        $user = User::find($id);
        $email = $request->email;
        $phonenumber = $request->phonenumber;

        if ($email != $user->email) {
            $this->validate($request, [
                'email' => ['unique:users'],
            ]);
        }
        if ($phonenumber != $user->phonenumber) {
            $this->validate($request, [
                'phonenumber' => ['unique:users'],
            ]);
        }

        $this->validate($request, [
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phonenumber' => ['string', 'max:255'],
        ]);
        $user->email = $request->email;
        $user->phonenumber = $request->phonenumber;
        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->action([UserController::class, 'getProfile'])->with('success', 'Update thành công!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = User::find($id);
        $user->delete();

        return redirect()->action([UserController::class, 'getAllStudents'])->with('success_delete', 'Delete thành công!');
    }
}
