<?php

namespace App\Models\Transaction;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Transaction
 *
 * @property int id
 * @property string amount
 * @property string description
 * @property string currency
 * @property string status
 * @property string issuer
 * @property string transaction_date
 */
class Transaction extends Model
{
    use AttributesTrait,
        RelationshipTrait,
        ScopesTrait,
        SoftDeletes,
        HasUUID;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'amount',
        'description',
        'currency',
        'status',
        'issuer',
        'transaction_date'
    ];

    /**
     * The attributes that will not be included in the serialized representation of the model.
     *
     * @var array
     */
    protected $guarded = ['id'];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'transaction_date' => 'datetime',
    ];
}
