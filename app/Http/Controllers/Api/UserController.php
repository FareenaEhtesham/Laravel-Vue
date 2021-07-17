<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // $this->authorize("isAdmin")
        if (\Gate::allows('isAdmin') || \Gate::allows('isAuthor')) {
            return User::orderBy('id', 'DESC')->get();
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:100',
            'email' => 'required|unique:users|string|max:200|email',
            'type' => 'required',
            'password' => 'required',
        ]);

        $form_data = array(
            'name'       =>   $request->name,
            'email'       =>   $request->email,
            'type'       =>   $request->type,
            'password'       =>   Hash::make($request->password)
        );

        User::create($form_data);
        return $request->all();

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function Profile()
    {
        return auth('api')->user();
    }
    public function UpdateProfile(Request $request, User $user)
    {
        $user = auth('api')->user(); //check authenticated user
        $current_photo = $user->photo;

        //if name of photo doesnot same with photo we have on database
        if($request->photo != $current_photo){

            $name = time().'.' . explode('/', explode(':', 
            substr($request->photo, 0, strpos($request->photo, ';')))[1])[1];

            \Image::make($request->photo)->save(public_path('img/profile/').$name);

            $request->merge(['photo' => $name]);

            $user_photo = public_path("/img/profile/").$current_photo;

            if(file_exists($user_photo)){
                @unlink($user_photo);
            }

        }

        if(!empty($request->password)){
            $request->merge(['password' =>  Hash::make($request['password'])]);
        }
        $user->update($request->all());
        return $user;

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $user->update($request->all());
        return $user;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //Only Admins have permission to delete users
        $this->authorize('isAdmin');
        $user = User::where('id', $id);
        $user->delete();
    }
}
