<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductResult;

class TransactionObserver
{
    /**
     * Handle the Moved "saving" event.
     *
     * @return void
     */
    public function saving($event)
    {
        if (!($event instanceof ProductResult)) {
            return;
        }

        $product        = Product::where('name', request('eproduct'))->first();
        $location_count = count(request('location'));

        $products = $this->duplicate($product->id, $location_count);

        request()->merge([
            'product' => $products,
        ]);
    }

    /**
     * Handle the Moved "saved" event.
     *
     * @return void
     */
    public function saved($event)
    {
        // Truncate
        $event->products()->sync([]);

        $products   = request('product');
        $quantity   = request('quantity');
        $locations  = request('location');

        for ($index = 0; $index < count($quantity) - 1; $index++) {

            // Attach to Relation
            $event->products()->attach([
                $products[$index] => [
                    'quantity'  => $quantity[$index],
                    'rack_id'   => $locations[$index],
                ]
            ]);
        }
    }

    /**
     * Handle the "deleting" event.
     *
     * @return void
     */
    public function deleting($event)
    {
        $event->products()->sync([]);
    }

    /**
     * create an array with the same value in a certain number
     */
    private function duplicate($value, $count): array
    {
        $values[] = $value;
        for ($index = 0; $index < $count; $index++) {
            array_push($values, $value);
        }

        return $values;
    }
}
