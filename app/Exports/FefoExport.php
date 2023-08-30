<?php

namespace App\Exports;
use App\Models\ItemIn;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FefoExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
        return view('exports.fefo', [
            'fefo' => ItemIn::with(['items'])->orderBy('date_expired', 'desc')->get()
        ]);
    }
}
