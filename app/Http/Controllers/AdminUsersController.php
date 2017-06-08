<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Role;
use App\Http\Requests\UsersRequest;
use App\Photo;
use App\Http\Requests\UsersEditRequest;

class AdminUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        //
        $roles = Role::pluck('name', 'id')->all();
    	
        return view('admin.users.create', compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UsersRequest $request)
    {
    	
//     	$user = new User();
//     	$user->name = $request->name;
//     	$user->email = $request->email;
//     	$user->role_id = $request->role_id;
//     	$user->is_active = $request->is_active;
//     	$user->photo_id = $request->photo_id;
//     	$user->password = $request->password;
//     	$user->save();
    	
//     	return $request->all();

    	
//     	User::create($request->all());

    	if(trim($request->password) == ''){
    		$input = $request->except('password');
    	} else {
    		$input = $request->all();
    	}
    
    	if($file = $request->file('photo_id')) {
    		$name = time() . $file->getClientOriginalName();
    		
    		$file->move('images', $name);
    		
 			$photo = Photo::create(['file' => $name]);
 			
 			$input['photo_id'] = $photo->id;
 			
 			
    	}
    	$input['password'] = bcrypt($request->password);
    	User::create($input);
    	
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
        //
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
        //
        $user = User::findOrFail($id);
        
        $roles = Role::pluck('name', 'id')->all();
    	
        return view('admin.users.edit', compact('user', 'roles'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UsersEditRequest $request, $id)
    {
        //
        $user = User::findOrFail($id);
        
        if(trim($request->password) == ''){
        	$input = $request->except('password');
        } else {
        	$input = $request->all();
        }
        
    	if($file = $request->file('photo_id')){
    		$name = time() . $file->getClientOriginalName();
    		$file->move('images', $name);
    		$photo = Photo::create(['file' => $name]);
    		
    		$input['photo_id'] = $photo->id;
    		
    	}
    	
    	$input['password'] = bcrypt($request->password); 
    	$user->update($input);
    	return redirect()->back();
        
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
