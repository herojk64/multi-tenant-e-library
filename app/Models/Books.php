<?php

namespace App\Models;

use App\Enum\BookType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = ['thumbnail','title','category_id','author_name','published_date','description','file','type'];

    protected $casts = ['type'=>BookType::class];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function rating()
    {
        return $this->hasMany(Rating::class,'book_id');
    }

    public function averageRating()
    {
        return round($this->rating()->avg('rating'),1) ?? 0;
    }

    public function bayesianRating()
    {
        $globalAverageRating = Rating::avg('rating') ?? 0;  // Global average rating, default to 0 if no ratings
        $minimumRatingsForReliability = 5; // Minimum number of ratings required to be considered reliable
        $bookAverageRating = $this->averageRating(); // Average rating for this specific book
//        dd($bookAverageRating);
        $bookRatingCount = $this->rating()->count(); // Number of ratings this book has

        // If there are no ratings, return 0
        if ($bookRatingCount === 0) {
            return 0;
        }

        // Bayesian formula
        $bayesianScore = ($bookRatingCount / ($bookRatingCount + $minimumRatingsForReliability)) * $bookAverageRating
            + ($minimumRatingsForReliability / ($bookRatingCount + $minimumRatingsForReliability)) * $globalAverageRating;

        return round($bayesianScore, 1);
    }

    public function views()
    {
        return $this->belongsToMany(User::class, 'book_user_views')
            ->withTimestamps()
            ->withPivot('viewed_at');
    }




}
