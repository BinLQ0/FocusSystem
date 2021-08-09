<?php

namespace App\View\Components\Form;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class ProductList extends Component
{
    /**
     * @var App\Models\Product
     */
    public $product;

    /**
     * List of Product Option
     */
    public $productOption;

    /**
     * Index's Row Table
     *
     * @var Mixed      
     */
    public $row;

    /**
     * Index's Row Table
     *
     * @var Illuminate\Support\Collection      
     */
    public $views;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?Product $product, $row = null, $productOption = [], Collection $views)
    {
        $this->productOption    = $productOption;
        $this->product          = $product;
        $this->views            = $views;
        $this->row              = $row;

        if ($this->hasIndex()) {

            $this->product->id       = old('product')[$row->index];
            $this->product->location = old('location')[$row->index] ?? null;
            $this->product->quantity = old('quantity')[$row->index] ?? 0;
            $this->product->stock    = old('stock')[$row->index] ?? 0;
        }
    }

    /**
     * Create option's rack
     * @return Illuminate\Support\Collection
     */
    public function optionRacks()
    {
        return $this->product->history
            ->groupBy('rack.id')
            ->mapWithKeys(function ($group, $key) {
                $history = $group->first();
                return [
                    $key => $history->rack->code . ' ( ' . $history->rack->warehouse->name . ' )'
                ];
            });
    }

    /**
     * Set Selected Location
     * 
     * @return array
     */
    public function getSelectedLocation(): array
    {
        if ($this->product->location) {
            return [$this->product->location];
        }

        if (!isset($this->product->pivot)) {
            return []; // Default Value 
        }

        return [$this->product->pivot->rack_id];
    }

    /**
     * Set Quantity
     * 
     * @return int
     */
    public function getQuantity(): int
    {
        if ($this->product->quantity) {
            return $this->product->quantity;
        }

        if (!isset($this->product->pivot)) {
            return 0; // Default Value
        }

        return $this->product->pivot->quantity;
    }

    /**
     * Set Stock
     * 
     * @return int
     */
    public function getStock(): int
    {
        if (!isset($this->product->stock)) {

            if (isset($this->product->id)) {

                return $this->product->history
                    ->calculateStock() + $this->product->pivot->quantity;
            }

            return 0; // Default Value
        }

        return $this->product->stock;
    }

    /**
     * Create Class for 'Action Button'
     */
    public function createActionButtonClass()
    {
        $classes      = ['btn btn-sm '];
        $classes[]    = isset($this->row) && $this->product->id ? 'btn-danger' : 'btn-secondary';

        return \implode(' ', $classes);
    }

    /**
     * Set 'Action Button' attribute disabled condition
     */
    public function isActionButtonDisabled()
    {
        if (isset($this->row) && $this->product->id) {
            return '';
        }

        return 'disabled';
    }

    /**
     * Check if this component has row
     */
    private function hasIndex()
    {
        return isset($this->row) && old('product');
    }

    /**
     * The function used to check 
     * whether it can be seen or not
     */
    public function canView($value)
    {
        return $this->views->contains($value);
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.product-list');
    }
}
