<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use App\Models\Category;
use Livewire\Component;


#[Title('categories - SAHIL BENIWAL')]
class CategoriesPage extends Component
{
    public function render()
    {
        $categories = Category::where('is_active', 1)->get();
        return view('livewire.categories-page', [
            'categories' => $categories,

        ]);
    }
}