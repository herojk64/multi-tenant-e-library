<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Books;
use App\Models\Category;

class BookFilter extends Component
{
    use WithPagination;

    public $search = '';
    public $selectedCategories = [];
    public $categories;

    public function mount()
    {
        $this->categories = Category::all();
    }

    public function updatedSearch()
    {
        $this->resetPage(); // Reset pagination when search term changes
    }

    public function updatedSelectedCategories()
    {
        $this->resetPage(); // Reset pagination when selected categories change
    }

    public function filterByCategory($categoryId)
    {
        if (in_array($categoryId, $this->selectedCategories)) {
            // Remove category if unchecked
            $this->selectedCategories = array_diff($this->selectedCategories, [$categoryId]);
        } else {
            // Add category if checked
            $this->selectedCategories[] = $categoryId;
        }
    }

    public function getBooksProperty()
    {
        return Books::when($this->search, function ($query) {
            $query->where('title', 'like', '%' . $this->search . '%');
        })->when(count($this->selectedCategories), function ($query) {
            $query->whereIn('category_id', $this->selectedCategories);
        })->paginate(10); // Adjust the number of items per page as needed
    }

    public function render()
    {
        return view('livewire.book-filter', [
            'books' => $this->books,
            'categories' => $this->categories,
        ]);
    }
}

