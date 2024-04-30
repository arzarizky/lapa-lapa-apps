<?php

namespace App\Exports;

use App\Models\Kota;
use App\Models\Rekapharga;
use Illuminate\Contracts\Support\Responsable;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ApiDetailExport implements FromView, ShouldAutoSize
{
    use Exportable;
    /**
     * @return \Illuminate\Support\Collection
     */
    private $your_collection;
    private $filename = 'Detail.xlsx';

    public function __construct($pts)
    {
        $this->your_collection = $pts;
    }

    // public function collection()
    // {
    //     return $this->your_collection;
    // }
    public function view(): View
    {
        return view('export.detail', [
            'data' => $this->your_collection,
        ]);
    }
}
