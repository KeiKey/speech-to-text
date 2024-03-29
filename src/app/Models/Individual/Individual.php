<?php

namespace App\Models\Individual;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Individual
 *
 * @property int id
 */
class Individual extends Model
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
        'name',
        'email',
        'address',
        'phone_number',
        'vat_number'
    ];

    /**
     * The attributes that will not be included in the serialized representation of the model.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
