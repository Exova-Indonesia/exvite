<?php

namespace App\Exports;

use App\Models\OrderSuccess;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Illuminate\Contracts\Queue\ShouldQueue;

class RevenueExport implements FromView, ShouldAutoSize, ShouldQueue
{
    use Exportable;
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view(): View
    {
        return view('exports.revenue', [
            'revenue' => OrderSuccess::where('studio_id', studio()->id)->with(['orders.products' => function($q) {
                $q->select('jasa_id', 'jasa_name');
            }])->select('order_id', 'amount', 'paid', 'created_at')->get()
        ]);
    }
}