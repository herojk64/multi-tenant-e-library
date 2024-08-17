<?php

namespace App\Models;

use App\Enum\BookType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Books extends Model
{
    use HasFactory;
    protected $fillable = ['title','category_id','author_name','published_date','description','file_path','file_type','type'];

    protected $casts = ['type'=>BookType::class];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
