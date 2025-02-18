<?php

namespace App\Livewire\Export\Transaction;

use App\Models\Selling;
use Livewire\Component;
use Spatie\SimpleExcel\SimpleExcelWriter;

class ToExcel extends Component
{
    public $startDate;
    public $endDate;

    protected $rules = [
        'startDate' => 'required|date',
        'endDate' => 'required|date',
    ];

    public function exportTransactionsExcel()
    {
        $this->validate();
        
        $query = Selling::whereBetween('created_at', [$this->startDate, $this->endDate])->with('user')->where('total_price', '!=', 0);
        $total = $query->count();
        $chunkSize = 1000;
        $fileCount = ceil($total / $chunkSize);

        for ($i = 0; $i < $fileCount; $i++) {
            $data = $query->skip($i * $chunkSize)->take($chunkSize)->get();

            $filteredData = $data->map(function ($item) {
                return [
                    'ID' => $item->id,
                    'Customer Name' => $item->customer_name,
                    'Date' => $item->created_at->format('Y-m-d'),
                    'Total price' => $item->total_price,
                    'Total Payment' => $item->total_payment,
                    'Total Change' => $item->total_change,
                    'User' => $item->user->name,
                    'Created At' => $item->created_at->format('Y-m-d H:i:s'),
                ];
            });

            return response()->streamDownload(function () use ($filteredData) {
                SimpleExcelWriter::streamDownload('transactions.xlsx')
                    ->addHeader(['ID', 'Customer Name', 'Date', 'Total price', 'Total Payment', 'Total Change', 'User', 'Created At'])
                    ->addRows($filteredData->toArray());
            }, 'transactions.xlsx');
        }
        session()->flash('sweet-alert', [
            'icon' => 'success',
            'title' => 'Transactions exported successfully!'
        ]);

        return redirect()->route('transaction');
    }

    public function exportAllTransactionsExcel()
    {
        $data = Selling::with('user')->where('total_price', '!=', 0)->get();

        $filteredData = $data->map(function ($item) {
            return [
                'ID' => $item->id,
                'Customer Name' => $item->customer_name,
                'Date' => $item->created_at->format('Y-m-d'),
                'Total price' => $item->total_price,
                'Total Payment' => $item->total_payment,
                'Total Change' => $item->total_change,
                'User' => $item->user->name,
                'Created At' => $item->created_at->format('Y-m-d H:i:s'),
            ];
        });

        return response()->streamDownload(function () use ($filteredData) {
            SimpleExcelWriter::streamDownload('transactions.xlsx')
                ->addHeader(['ID', 'Customer Name', 'Date', 'Total price', 'Total Payment', 'Total Change', 'User', 'Created At'])
                ->addRows($filteredData->toArray());
        }, 'transactions.xlsx');
    }

    public function render()
    {
        return view('livewire.export.transaction.to-excel');
    }
}
