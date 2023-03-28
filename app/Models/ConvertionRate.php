<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ConvertionRate extends Model
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
    protected $fillable = ['value'];

    /**
     *
     */
    public function Currency(): BelongsTo
    {
        return $this->belongsTo(Currency::class);
    }
}
