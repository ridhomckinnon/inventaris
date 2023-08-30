<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemIn;
use App\Models\Type;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Exports\ItemInExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class ItemInController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $suppliers = Supplier::all();
        $items = Item::all();
        $types = Type::all();
        $typeTab = isset($request->name) ? $request->name : $types->first()->name;
        if ($request->ajax()) {
            // dd($request->type);
            if($request->type == null){
                $data = ItemIn::with(['items','supplier'])->get();
            }
            else{
                $data = ItemIn::with(['items','supplier'])->whereHas('items',  function($q) use($request){
                    $q->where('type','=', $request->type);
                })->get();

            }
            // dd($data->toArray());

            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($items){

                    $btnAction = '<div class="d-flex">
                    <button type="button" name="edit" id="'.$items->id.'" class="btn btn-success btn-sm btn-edit mx-1"><i class="fa fa-edit"></i></i></button>
                    <button type="button" name="delete" id="'.$items->id.'" class="btn btn-danger btn-sm btn-delete mx-1"><i class="fa fa-trash"></i></i></button>
                    </div>
                    ';
                    return $btnAction;

                })
                ->addIndexColumn()
                ->rawColumns(['action'])
                ->make(true);
        }
        return view('items.itemIn', ['suppliers' => $suppliers, 'types' => $types, 'items' => $items, 'typeTab' => $typeTab]);
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
        $itemIn = [
            'item_id' => $request->item_id,
            'no_in' => $request->no_in,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'quantity_unit' => $request->quantity_unit,
            'cost_price' => $request->cost_price,
            'sell_price' => $request->sell_price,
            'status' => $request->status,
            'place' => $request->place,
            'date_in' => $request->date_in,
            'date_expired' => $request->date_expired,

        ];
        $image = $request->file('image');
        if($image){
            $imageName = $image->hashName();
            $path = $image->move('images', $imageName);
            $item['image'] = $imageName;
        }
        $item = Item::findOrFail($request->item_id);

        $item->quantity = $item->quantity + $request->quantity;
        $item->save();

        ItemIn::create($itemIn);


        return redirect()->route('itemIn');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemIn  $itemIn
     * @return \Illuminate\Http\Response
     */
    public function show(ItemIn $itemIn)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemIn  $itemIn
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(request()->ajax())
        {
            $data = ItemIn::findOrFail($id);
            return response()->json(['result' => $data]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemIn  $itemIn
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        // $rules = array(
        //     'code' => 'required|max:50',
        //     'name' => 'required|min:5|max:255',
        //     'supplier_name' => 'required|min:5|max:255',
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

            'item_id' => $request->item_id,
            'supplier_id' => $request->supplier_id,
            'quantity' => $request->quantity,
            'quantity_unit' => $request->quantity_unit,
            'date_in' => $request->date_in,
            'date_expired' => $request->date_expired,
        ];

        $image = $request->file('image');
        if($image){
            $imageName = $image->hashName();
            $path = $image->move('images', $imageName);
            $item['image'] = $imageName;
        }
        ItemIn::findOrFail($request->id)->update($item);
        return response()->json(['success' => 'Data is successfully updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemIn  $itemIn
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ItemIn::findOrFail($id);
        $data->delete();
    }
    public function export()
    {
        return Excel::download(new ItemInExport, 'barang-masuk.xlsx');
    }
}
