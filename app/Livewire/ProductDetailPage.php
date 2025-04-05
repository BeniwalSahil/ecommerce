<?php

namespace App\Livewire;

use Jantinnerezo\LivewireAlert\Concerns\SweetAlert2;
use Jantinnerezo\LivewireAlert\Facades\LivewireAlert;
use Jantinnerezo\LivewireAlert\Enums\position;
use Livewire\Attributes\Title;
use Livewire\Component;
use App\Helpers\CartMangement;
use App\Livewire\Partials\Navbar;
use App\Models\Product;

#[Title('Product Detail - SAHIL BENIWAL')]

class ProductDetailPage extends Component
{
    use SweetAlert2;
    public $slug;
    public $quantity = 1;
    public function mount($slug)
    {
        $this->slug = $slug;
    }
    public function increaseQTY()
    {
        $this->quantity++;
    }
    public function decreaseQTY()
    {
        if ($this->quantity > 1) {
            $this->quantity--;
        }
    }
    public function addToCart($product_id)
    {
        $total_count = CartMangement::addItemToCartWthQty($product_id, $this->quantity);
        $this->dispatch('update-cart-count', total_count: $total_count)->to(Navbar::class);

        LivewireAlert::title('')
            ->text('Product added to Cart successfully!')
            ->position('bottom-end')
            ->timer(3000)
            ->toast(true)
            ->show();
    }
    public function render()
    {
        return view('livewire.product-detail-page', [
            'product' => Product::where('slug', $this->slug)->firstOrFail(),
        ]);
    }
}