<?php

namespace App\Exports;

use App\Invoice;
use App\Models\Disbursement;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class DisbursementExport implements FromView, ShouldAutoSize
{
    public function __construct($batch)
    {
        $this->batch = $batch;
    }

    public function view(): View
    {
        return view('exports.disbursement', [
            'data' => Disbursement::where("batch", $this->batch)->get()
        ]);
    }
}

