<?php

namespace App\Exports;

use App\Models\Product;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStrictNullComparison;

class StockExport implements FromCollection, WithHeadings, WithMapping, WithStrictNullComparison, ShouldAutoSize
{
    use Exportable;

    protected $date;

    public function __construct(Carbon $date)
    {
        $this->date = $date->format('Y-m-d');
    }

    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $collection = collect();

        // Put data into Collection
        Product::with(['racks.warehouse', 'history'])->chunk(100, function ($products) use ($collection) {
            foreach ($products as $product) {
                foreach ($product->racks->unique('code') as $rack) {

                    $rackWithHistory = $rack->filterHistory('product_id', $products);

                    $collection->push([
                        'product_name'          => $product->name,
                        'product_description'   => $product->description,
                        'warehouse'             => $rack->warehouse->name,
                        'location'              => $rack->code,
                        'quantity'              => $rackWithHistory->history->calculateStock()
                    ]);
                }
            }
        });

        return $collection;
    }

    /**
     * @return array
     */
    public function headings(): array
    {
        return [
            'Product Name',
            'Description',
            'Warehouse',
            'Location',
            'Actual Quantity'
        ];
    }

    /**
     * @var Product $product
     */
    public function map($item): array
    {
        return [
            $item['product_name'],
            $item['product_description'],
            $item['warehouse'],
            $item['location'],
            $item['quantity']
        ];
    }
}
