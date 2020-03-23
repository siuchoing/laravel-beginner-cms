<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersRequest;
use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Photo;
use App\Country;


class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Use pluck() instead of lists(), which is deprecated!
        $roles = Role::pluck('name', 'id')->all();
        $countries = Country::pluck('name', 'id')->all();

        return view('admin.users.create', compact('roles', 'countries'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
        // Password
        if(trim($request->password) == ''){
            $input = $request->except('password');
        } else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        // photo_path
        if($file = $request->file('photo_path')) {
            // Get unique path name
            $photoName = time() . $file->getClientOriginalName();
            $pathName = str_replace(' ', '_', $photoName);

            // Create user
            $user = User::create([
                'name' => $input['name'],
                'email' => $input['email'],
                'password' => $input['password'],
                'is_active' => $input['is_active'],
                'country_id' => $input['country_id'],
                'photo_path' => $pathName,
                'role_id' => $input['role_id'],
            ]);

            // Move photo to public/images folder
            $file->move('images', $pathName);

            // Use Polymorphic Relation to create user's photo
            $theUser = User::where('photo_path', $pathName)->first();
            $photo = $theUser->photos()->create([
                'path' => $pathName,
            ]);
        }
        return redirect('/admin/users');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('admin.users.show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('admin.users.edit');
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
