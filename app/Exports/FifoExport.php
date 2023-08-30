<?php

namespace App\Exports;
use App\Models\ItemIn;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class FifoExport implements FromView
{
    /**
    * @return \Illuminate\Support\FromView
    */
    public function view(): View
    {
        return view('exports.fifo', [
            'fifo' => ItemIn::with(['items'])->orderBy('date_expired', 'asc')->get()
        ]);
    }

}
