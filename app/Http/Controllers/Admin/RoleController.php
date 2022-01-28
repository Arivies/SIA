<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

Use Spatie\Permission\Models\Role;
Use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:roles.index')->only(['index']);
        $this->middleware('can:roles.create')->only(['create','store']);
        $this->middleware('can:roles.edit')->only(['edit','update']);
        $this->middleware('can:roles.show')->only(['show']);
        $this->middleware('can:roles.destroy')->only(['destroy']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::query()->paginate(5);
 return view('admin.roles.index',compact('roles'))
       
                ->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all()->pluck('name','id');
        //dd($permission);
        return view('admin.roles.create',compact('permissions'));
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
            'name' => 'required|unique:roles'
        ]);
        $roles = Role::create($request->all());
        $roles->permissions()->sync($request->input('permissions',[]));//metodo para registrar datos muchos a muchos
        return redirect()->route('roles.index')->with('success','Se agrego rol correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        $role->load('permissions');
        return view('admin.roles.show',compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {
        $permissions = Permission::all()->pluck('name','id');
        $role->load('permissions');
        return view('admin.roles.edit',compact('role','permissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        /*$request->validate([
            'name' => 'required|unique:roles,name'.$request->id
        ]);*/
        $role->update($request->only('name'));

        //$role->update($request->all());
        $role->permissions()->sync($request->input('permissions',[]));//metodo para registrar datos muchos a muchos

        return redirect()->route('roles.index')->with('success','Rol actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(/*$id*/ Role $role)
    {
        $role->delete();
        return redirect()->route('roles.index')->with('success','Rol eliminado correctamente');
        /*$role = Role::find($id)->delete();
        return response()->json(['success'=>'Rol eliminado correctamente']);*/
    }
}
