<?php

namespace App\Livewire\Export\Product;

use App\Models\Product;
use Livewire\Component;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ToExcel extends Component
{


    public $status = '';

    protected $rules = [
        'status' => 'required',
    ];

    public function exportProductToExcel()
    {
        $this->validate();

        $query = $this->status === 'All' ? Product::query() : Product::where('status', $this->status);
        $total = $query->count();
        $chunkSize = 1000;
        $fileCount = ceil($total / $chunkSize);
    
        for ($i = 0; $i < $fileCount; $i++) {
            $data = $query->skip($i * $chunkSize)->take($chunkSize)->get();  // Hanya gunakan get() di sini
    
            $filteredData = $data->map(function ($item) {
                return [
                    'ID' => $item->id,
                    'Name' => $item->name,
                    'Price' => $item->price,
                    'Stock' => $item->stock,
                    'Status' => $item->status,
                    'Created At' => $item->created_at->format('Y-m-d H:i:s'),
                ];
            });
    
            return response()->streamDownload(function () use ($filteredData) {
                SimpleExcelWriter::streamDownload('products.xlsx')
                    ->addHeader(['ID', 'Name', 'Price', 'Stock','Status','Created At'])
                    ->addRows($filteredData->toArray());
            }, 'products.xlsx');
        }
    }
    
    public function render()
    {
        return view('livewire.export.product.to-excel');
    }
}
