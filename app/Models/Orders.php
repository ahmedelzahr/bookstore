<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Table('book_user')]
class Orders extends Model
{
    protected $table='book_user';
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
 
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
