<?php

namespace App\Livewire;

use App\Helpers\CartMangement;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Category;
use Jantinnerezo\LivewireAlert\Concerns\SweetAlert2;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Livewire\Attributes\Title;
use Livewire\Component;
// use Jantinnerezo\LivewireAlert\LivewireAlert;
use App\Livewire\Partials\Navbar;
use Livewire\Attributes\Url;
use Livewire\Component\addToCart;
use Livewire\WithPagination;



#[Title('Products - SAHIL BENIWAL')]
class ProductsPage extends Component
{
    // use LivewireAlert;
    use SweetAlert2;

    use WithPagination;
    #[Url]
    public $selected_categories = [];

    #[Url]
    public $selected_brands = [];

    #[Url]
    public $featured;

    #[Url]
    public $on_sale;

    #[Url]
    public $price_range = 300000;
    #[Url]
    public $sort = 'latest';
    // add product to cart method
    #[Url]
    public function addToCart($product_id)
    {
        $total_count = CartMangement::addItemToCart($product_id);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        LivewireAlert::title('')
            ->text('Product added to Cart Successfully!')
            ->position('bottom-end')
            ->timer(3000)
            ->toast(true)
            ->show();
    }

    public function render()
    {
        $productQuery = Product::query()->where('is_active', 1);

        if (!empty($this->selected_categories)) {
            $productQuery->whereIn('category_id', $this->selected_categories);
        }
        if (!empty($this->selected_brands)) {
            $productQuery->whereIn('brand_id', $this->selected_brands);
        }
        if ($this->featured) {
            $productQuery->where('is_featured', 1);
        }

        if ($this->on_sale) {
            $productQuery->where('on_sale', 1);
        }
        if ($this->price_range) {
            $productQuery->whereBetween('price', [0, $this->price_range]);
        }
        if ($this->sort == 'latest') {
            $productQuery->latest();
        }

        if ($this->sort == 'price') {
            $productQuery->orderBy('price');
        }
        return view('livewire.products-page', [
            'products' => $productQuery->paginate(6),
            'brands' => Brand::where('is_active', 1)->get(['id', 'name', 'slug']),
            'categories' => Category::where('is_active', 1)->get(['id', 'name', 'slug']),
        ]);
    }
}