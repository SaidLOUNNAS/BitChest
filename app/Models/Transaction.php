<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
class Transaction extends Model
{
    public $timestamps = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    use HasFactory;
    protected $fillable = [
        'currency_id', 'user_id', 'amount', 'quantity', 'purchase_price', 'purchase_date', 'sold', 'selling_amount', 'selling_date'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [];

    /**
     * the currency linked to transaction.
     */
    public function currency()
    {
        return $this->belongsTo('App\Models\Currency');
    }
}
