<?php

namespace App\Exports;

use App\Models\Item;
use App\Models\ItemIn;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class ItemExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */

    public function view(): View
    {
        $itemIn = ItemIn::all();
        return view('exports.item', [
            'items' => Item::with(['itemIn'])->withSum('itemIn','quantity')->latest()->get()
        ]);
    }
}
