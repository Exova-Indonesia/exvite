<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use App\Models\Transaction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\Exportable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;

class Transactions implements FromView, ShouldAutoSize
{
        use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */

    public $id;
    public function __construct($id) {
        $this->id = $id;
    }

    public function view(): View
    {
        return view('exports.transaction', [
            'revenue' => Transaction::all()
        ]);
    }
}
