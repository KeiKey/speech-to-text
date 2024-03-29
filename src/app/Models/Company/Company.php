<?php

namespace App\Models\Company;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Company
 *
 * @property int id
 */
class Company extends Model
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
        'vat_number',
        'contact_name',
        'contact_phone',
        'contact_email'
    ];

    /**
     * The attributes that will not be included in the serialized representation of the model.
     *
     * @var array
     */
    protected $guarded = ['id'];
}
