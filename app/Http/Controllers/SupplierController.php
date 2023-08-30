<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Imports\SupplierImport;
use App\Exports\SupplierExport;
use Maatwebsite\Excel\Facades\Excel;

use DataTables;
use Validator;
class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Supplier::latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $btnAction = '<div class="d-flex ">
                        <button type="button" name="edit" id="'.$data->id.'" class="btn btn-success btn-sm btn-edit mx-1"><i class="fa fa-edit"></i></i></button>
                        <button type="button" name="delete" id="'.$data->id.'" class="btn btn-danger btn-sm btn-delete mx-1"><i class="fa fa-trash"></i></i></button>
                    </div>
                    ';
                    return $btnAction;

                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('suppliers.supplier');
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
            'code' => 'required|max:50',
            'name' => 'required|max:255',
            'phone' => 'required|numeric|min:11',
            'address' => 'required|min:5|max:1000',
            'logo' => 'nullable|mimes:png,jpg,jpeg|max:2048',

        ]
        );
        $supplier = [
           'code' => $request->code,
           'name' => $request->name,
           'phone' => $request->phone,
           'address' => $request->address,
        ];
        $image = $request->file('logo');
        if($image){
            $imageName = $image->hashName();
            $path = $image->move('images', $imageName);
            $supplier['logo'] = $imageName;
        }
        Supplier::create($supplier);
        return redirect()->route('supplier');
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
            $data = Supplier::findOrFail($id);
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

        // $rules = array(
        //     'code' => 'required|max:50',
        //     'name' => 'required|max:255',
        //     'phone' => 'required|numeric',
        //     'address' => 'required|min:5|max:1000',
        //     'logo' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        // );

        // $error = Validator::make($request->all(), $rules);

        // if($error->fails())
        // {
        //     return response()->json(['errors' => $error->errors()->all()]);
        // }
        $supplier = [
            'code' => $request->code,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
        ];

        $image = $request->file('logo');
        if($image){
            $imageName = $image->hashName();
            $path = $image->move('images', $imageName);

            $supplier['logo'] = $imageName;
        }
        Supplier::findOrFail($request->id)->update($supplier);
        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Supplier::findOrFail($id);
        $data->delete();
    }
    public function import(Request $request)
    {

        Excel::import(new SupplierImport, $request->file('file'));

        return redirect()->route('supplier')->with('success', 'Berhasil Import Supplier');
    }

    public function export()
    {
        return Excel::download(new SupplierExport, 'supplier.xlsx');
    }
}
