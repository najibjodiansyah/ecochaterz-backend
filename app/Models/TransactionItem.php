<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionItem extends Model
{
    use HasFactory;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'users_id',
        'products_id',
        'quantity',
        'transactions_id',
    ];

    public function product()
    {
        return $this->hasOne(Product::class, 'transactions_id', 'id');
    }

}
