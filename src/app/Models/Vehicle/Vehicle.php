<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Carbon;

/**
 * @property int id
 * @property int brand_id
 * @property string vehicle_code
 * @property string series
 * @property string size
 * @property string configuration
 * @property string model
 * @property string sales_name
 * @property string year
 * @property string cylinder
 * @property string type_of_drive
 * @property string engine_output
 * @property string country
 * @property string primary_category
 * @property string secondary_category
 * @property Carbon deleted_at
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Vehicle extends Model
{
    use HasFactory, RelationshipTrait, ScopesTrait, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'brand_id',
        'vehicle_code',
        'series',
        'size',
        'configuration',
        'model',
        'sales_name',
        'year',
        'cylinder',
        'type_of_drive',
        'engine_output',
        'country',
        'primary_category',
        'secondary_category',
    ];
}
