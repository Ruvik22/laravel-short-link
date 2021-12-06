<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TinyLink extends Model
{
    use HasFactory;

     /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'url',
        'slug',
        'expire_counter',
    ];

    /**
     * Increment expiration
     *
     * @return void
     */
    public function incrementExpirationCounter()
    {
        $this->expire_counter = ++$this->expire_counter;
        $this->save();
    }
}
