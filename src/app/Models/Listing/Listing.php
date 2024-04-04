<?php

namespace App\Models\Listing;

use App\Traits\HasUUID;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Listing
 */
class Listing extends Model
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
        'creator_id',
        'inspector_id',
        'title',
        'description',
        'address',
        'start',
        'end',
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

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'start' => 'datetime',
        'end'   => 'datetime'
    ];
}
