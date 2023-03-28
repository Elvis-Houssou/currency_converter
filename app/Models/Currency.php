<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Currency extends Model
{
    use HasFactory;

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

     /**
     * The attributes that are mass assignable.
     *
     * @var array<string>
     */
    protected $fillable = ['firstCurrency','secondCurrency'];

    /**
     * Get the phone associated with the user.
     */
    // public function CurrencyPairs(): BelongsTo
    // {
    //     return $this->BelongsTo(CurrencyPairs::class);
    // }

    /**
     *
     */
    public function ConvertionRate(): HasOne
    {
        return $this->hasOne(ConvertionRate::class);
    }
}
