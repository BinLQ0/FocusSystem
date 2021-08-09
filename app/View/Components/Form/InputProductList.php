<?php

namespace App\View\Components\Form;

use App\Models\Product;
use Illuminate\Support\Collection;
use Illuminate\View\Component;

class InputProductList extends Component
{
    /**
     * List of Products
     * 
     * @var Illuminate\Support\Collection 
     */
    public $products;

    /**
     * List of Product Option
     * 
     * @var Illuminate\Support\Collection 
     */
    public $productOption;

    /**
     * List of Rack Option
     * 
     * @var Illuminate\Support\Collection 
     */
    public $rackOption;

    /**
     * Title of this table
     */
    public $title;

    /**
     * Show column needed
     * 
     * @var Illuminate\Support\Collection
     */
    public $views;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(?Collection $products, $title = null, $productType = null, array $only = [], array $except = [])
    {
        $this->title        = $title;
        $this->productType  = $productType;

        $this->products     = optional($products)->load('history.rack.warehouse');

        $this->setupViews($only, $except);
        $this->makeProductOption();
    }

    /**
     * Create product list option by productType
     */
    public function makeProductOption()
    {
        // Convert to query
        $product = Product::query();

        // Check if want to get Material Product
        $product = $product->ofType($this->productType);

        $this->productOption = $product->orderBy('name')
            ->pluck("name", "id");
    }

    /**
     * Setup Allowed View
     */
    private function setupViews($only, $except)
    {
        // Default Setting
        $views = collect(['product', 'location', 'quantity', 'stock']);

        // Filter
        $this->views = (empty($only) && empty($except)) ? $views
            : $views->filter(function ($value, $key) use ($only, $except) {
                return in_array($value, $only) && !in_array($value, $except);
            });
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
        return view('components.form.input-product-list');
    }
}
