<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\ItemIn;
use App\Models\ItemOut;
use Illuminate\Http\Request;
use App\Exports\ItemOutExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class ItemOutController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $items = Item::all();
        if ($request->ajax()) {
            $data = ItemOut::with('items')->latest()->get();
            return DataTables::of($data)->addIndexColumn()
                ->addColumn('action', function($data){
                    $btnAction = '<div class="d-flex">
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
        return view('items.itemOut', ['items' => $items]);
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
        $itemOut = [
            'item_id' => $request->item_id,
            'quantity' => $request->quantity,
            'quantity_unit' => $request->quantity_unit,
            'cost_price' => $request->cost_price,
            'sell_price' => $request->sell_price,
            'place' => $request->place,
            'quantity_unit' => $request->quantity_unit,
            'date_out' => $request->date_out,
            'date_expired' => $request->date_expired,

        ];

        $item = Item::findOrFail($request->item_id);

        $item->quantity = $item->quantity - $request->quantity;
        $item->save();

        ItemOut::create($itemOut);



        return redirect()->route('itemOut');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\ItemOut  $itemOut
     * @return \Illuminate\Http\Response
     */
    public function show(ItemOut $itemOut)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemOut  $itemOut
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemOut $itemOut)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemOut  $itemOut
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemOut $itemOut)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ItemOut  $itemOut
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = ItemOut::findOrFail($id);
        $data->delete();
    }
    public function export()
    {
        return Excel::download(new ItemOutExport, 'barang-keluar.xlsx');
    }
}
