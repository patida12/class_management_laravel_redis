<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view(
            'users.index',
            ['users' => $users]
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

        return redirect()->action([StudentController::class, 'index']);
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

        $user->password = Hash::make($request->password);
        $user->fullname = $request->fullname;
        $user->save();

        return redirect()->action([StudentController::class, 'index']);
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

        return redirect()->action([StudentController::class, 'index']);
    }
}
