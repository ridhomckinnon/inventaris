<?php

namespace App\Exports;

use App\Models\ItemIn;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItemInExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
        return view('exports.itemIn', [
            'itemIn' => ItemIn::with(['items','supplier'])->get()
        ]);
    }
}
