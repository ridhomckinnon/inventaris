<?php

namespace App\Http\Controllers;
use App\Models\Operator;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use DataTables;

class OperatorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = User::role('operator')->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $btnAction = '<div class="d-flex ">
                        <button type="button" name="edit" id="'.$data->id.'" class="btn btn-success btn-sm btn-edit mx-1"><i class="fa fa-edit"></i></i></button>
                        <button type="button" name="delete" id="'.$data->id.'" class="btn btn-danger btn-sm btn-delete mx-1"><i class="fa fa-trash"></i></i></button>
                    </div>
                    ';
                    return $btnAction;

                })
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('operators.operator');
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
            'username' =>  'required',
            'email' =>  'required',
            'name' =>  'required',
            'password' =>  'required',
        ]);
        // dd($request->password);

        $operator = User::create([
            'username' => $request->username,
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
        ]);



        $permissions = Permission::pluck('id','id')->all();

        // $role->syncPermissions($permissions);

        $role = Role::where(['name' => 'operator'])->first();
        $operator->assignRole([$role->id]);
        // dd($operator);

        return redirect()->route('operator');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = User::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $operator = [
            'username' => $request->username,
            'email' => $request->email,
            'name' => $request->name,
            'password' => $request->password,
        ];

        User::findOrFail($request->id)->update($operator);

        return redirect()->route('operator');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = User::findOrFail($id);
        $data->delete();
    }
}
