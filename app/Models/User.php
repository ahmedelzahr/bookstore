<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Cashier\Billable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens;
    use Billable;
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'adminstration_level'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function isAdmin(){
        return($this->adminstration_level>0);
    }
     public function isSuperAdmin(){
        return($this->adminstration_level>1);
    }

    public function ratings(){
        return $this->hasMany(Rating::class);
    }
    public function rated(Book $book){
        return $this->ratings->where('book_id',$book->id)->isNotEmpty();
    }
    public function bookRating(Book $book){
       return $this->rated($book) ?$this->ratings->where('book_id',$book->id)->first()->value:null;
    }
 
    public function booksOnCart(){
        return $this->belongsToMany(Book::class)->withPivot('bought','price','number_of_copies','stripe_payment_intent_id')->wherePivot('bought',false);
    }

    public function purchasedBooks(){
         return $this->belongsToMany(Book::class)->withPivot('bought','price','number_of_copies','stripe_payment_intent_id','created_at')->wherePivot('bought',true);
    }

    public function isPurchased($book_id){
        return $this->purchasedBooks->contains($book_id);
    }

    public function booksOnCartPrice(){
        $total=0;
        foreach ($this->booksOnCart as $book) {
            $total += ($book->pivot->number_of_copies)*$book->price;
        }
        return $total;
    }
    
   
    
}
