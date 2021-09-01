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

        // Get Products
        $products = Product::with('history')->get();
        foreach ($products as $product) {

            // Get Racks by Product
            $racks = $product->calculateUniqueOf('rack.code', 'rack');
            foreach ($racks as $rack_code => $rack_quantity) {

                // Push Data to Collection
                $collection->push([
                    'product_name'          => $product->name,
                    'product_description'   => $product->description,
                    'location'              => $rack_code,
                    'quantity'              => $rack_quantity
                ]);
            }
        }

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
            $item['location'],
            $item['quantity']
        ];
    }
}
