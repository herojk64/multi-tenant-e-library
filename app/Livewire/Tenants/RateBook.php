<?php

namespace App\Livewire\Tenants;

use App\Models\Rating;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class RateBook extends Component
{
    public $book;
    public $rating = 0;

    public function mount($book)
    {
        // Fetch existing rating if the user has rated this book
        $existingRating = Rating::where('book_id', $this->book->id)
            ->where('user_id', Auth::id())
            ->first();

        if ($existingRating) {
            $this->rating = $existingRating->rating;
        }
    }

    public function rate($value)
    {
        $this->rating = $value;

        // Update or create rating for the book by the user
        Rating::updateOrCreate(
            [
                'book_id' => $this->book->id,
                'user_id' => auth()->user()->id,
            ],
            [
                'rating' => $this->rating,
            ]
        );

        // You can dispatch an event or a notification if needed
        session()->flash('message', 'Your rating has been saved!');
    }

    public function render()
    {
        return view('livewire.tenants.rate-book');
    }
}
