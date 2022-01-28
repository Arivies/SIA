<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:users.index')->only('index');
        $this->middleware('can:users.create')->only(['create','store']);
        $this->middleware('can:users.edit')->only(['edit','update']);
        $this->middleware('can:users.show')->only(['show']);
        $this->middleware('can:users.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $users = User::query()->paginate(5);

        return view('admin.users.index',compact('users'))
                ->with('i', (request()->input('page', 1) - 1) * 5);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all()->pluck('name', 'id');
        return view('admin.users.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = Validator::make($request->all(),[
                        'name' => 'required|max:255',
                        'username' => 'required|max:255|unique:users',
                        'email' => 'required|max:255|unique:users',
                        'password' => 'required|max:255'
                    ]);

        if($data->fails()){
            return redirect()->back()->withErrors($data->errors());
        }

        $user=User::create([
                        'name' => $request->input('name'),
                        'username' => $request->input('username'),
                        'email' => $request->input('email'),
                        'password' => Hash::make($request->input('password')),
                    ]);
        $roles=$request->input('role');
        $user->syncRoles($roles);
        return redirect()->route('users.index')->with('success','Se agrego usuario correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        $user->load('roles');
        //dd($user);
        return view('admin.users.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $roles = Role::all()->pluck('name','id');
        $user->load('roles');
        return view('admin.users.edit',compact('user','roles'));
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
        $data = $request->only('name', 'username', 'email');
        $password=$request->input('password');
        if($password)
        {
            $data['password'] = Hash::make($password);
        }

        $user->update($data);
        $roles=$request->input('role');
        $user->syncRoles($roles);

        return redirect()->route('users.index')->with('success','Usuario actualizado correctamente');
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
