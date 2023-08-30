<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ItemIn;
use App\Exports\FefoExport;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class FefoController extends Controller
{
    public function fefo(Request $request){
        if ($request->ajax()) {
            $data = ItemIn::with(['items'])->orderBy('date_expired', 'desc')->get();
            return Datatables::of($data)->addIndexColumn()
            ->addIndexColumn()
            ->make(true);

            }

        return view('methods.fefo');
    }
    public function export()
    {
        return Excel::download(new FefoExport, 'fefo.xlsx');
    }
}
