<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemIn;
use App\Exports\FifoExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class FifoController extends Controller
{
    //

    public function fifo(Request $request){
        if ($request->ajax()) {
            $data = ItemIn::with(['items','supplier'])->orderBy('date_expired', 'asc')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addIndexColumn()
            ->make(true);

            }

        return view('methods.fifo');
    }
    public function export()
    {
        return Excel::download(new FifoExport, 'fifo.xlsx');
    }
}
