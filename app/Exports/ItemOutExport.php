<?php

namespace App\Exports;

use App\Models\ItemOut;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItemOutExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
        return view('exports.itemOut', [
            'itemOut' => ItemOut::all()
        ]);
    }
}
