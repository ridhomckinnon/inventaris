<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemIn;
use App\Models\Type;
use App\Imports\ItemImport;
use App\Exports\ItemExport;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;
use Validator;
class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemIn = ItemIn::all();
        $type = Type::all();
        // dd($itemIn);
        if ($request->ajax()) {
            // $data = Item::with(['itemIn'])->withSum('itemIn','quantity')
            //         ->get();
            $data = Item::all();
            // dd($data);
            return Datatables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $btnAction = '<div class="d-flex">
                    <button type="button" name="edit" id="'.$data->id.'" class="btn btn-success btn-sm btn-edit mx-1"><i class="fa fa-edit"></i></i></button>
                    <button type="button" name="delete" id="'.$data->id.'" class="btn btn-danger btn-sm btn-delete mx-1"><i class="fa fa-trash"></i></i></button>
                    <button type="button" name="detail" id="'.$data->id.'" class="btn btn-primary btn-sm btn-detail mx-1"><i class="fa fa-eye"></i></i></button>
                    </div>
                    ';
                    return $btnAction;

                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }

        return view('items.item',['itemIn' => $itemIn, 'type' => $type]);
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
        // $request->validate([
        //     'code' => 'required|max:50',
        //     'name' => 'required|min:5|max:255',
        //     'supplier_name' => 'required|min:5|max:255',
        //     'place' => 'required|min:5|max:255',
        //     'quantity' => 'required|numeric',
        //     'quantity_unit' => 'required|min:2',
        //     'cost_price' => 'required|numeric',
        //     'sell_price' => 'required|numeric',
        //     'status' => 'required',
        //     'description' => 'required',
        //     'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',

        // ]);
        $item = [
            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
            'type' => $request->type,
            'quantity' => 0,

        ];
        $image = $request->file('image');
        if($image){
            $imageName = $image->hashName();
            $path = $image->move('images', $imageName);
            $item['image'] = $imageName;
        }
        $data = Item::create($item);
        $type = [
            'item_id' => $data->id,
            'name' => $data->type
        ];
        Type::create($type);

        return redirect()->route('item');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(request()->ajax())
        {
            $data = Item::with(['itemIn'])->findOrFail($id);
            // dd($data);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = Item::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        // $rules = array(
        //     'code' => 'required|max:50',
        //     'name' => 'required|min:5|max:255',
        //     'supplier_name' => 'required|min:5|max:255',
        //     'place' => 'required|min:5|max:255',
        //     'quantity' => 'required|numeric',
        //     'quantity_unit' => 'required|min:2',
        //     'cost_price' => 'required|numeric',
        //     'sell_price' => 'required|numeric',
        //     'status' => 'required',
        //     'description' => 'required',
        //     'image' => 'nullable|mimes:png,jpg,jpeg|max:2048',
        // );

        // $error = Validator::make($request->all(), $rules);

        // if($error->fails())
        // {
        //     return response()->json(['errors' => $error->errors()->all()]);
        // }

        $item = [

            'code' => $request->code,
            'name' => $request->name,
            'description' => $request->description,
        ];

        $image = $request->file('image');
        if($image){
            $imageName = $image->hashName();
            $path = $image->move('images', $imageName);
            $item['image'] = $imageName;
        }
        Item::findOrFail($request->id)->update($item);
        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Item::findOrFail($id);
        $data->delete();
    }
    public function import(Request $request)
    {

        Excel::import(new ItemImport, $request->file('file'));

        return redirect()->route('item')->with('success', 'Berhasil Import Barang');
    }

    public function export()
    {
        return Excel::download(new ItemExport, 'barang.xlsx');
    }
}
