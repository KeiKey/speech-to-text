<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property int id
 * @property int user_id
 * @property string name
 * @property string prompt
 * @property string response_format
 * @property string temperature
 * @property string file_name
 * @property string file_path
 * @property string translation
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Translation extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'user_id',
        'name',
        'file_name',
        'file_path',
        'translation',
        'prompt',
        'response_format',
        'temperature',
    ];

    protected $casts = [
        'translation' => 'json',
    ];

    /**
     * Returns the User that has the Translation
     *
     * @return BelongsTo
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Delete its file from storage before deleting.
     *
     * @return bool|null
     * @throws \Exception
     */
    public function delete(): ?bool
    {
        Storage::delete($this->file_path);

        return parent::delete();
    }
}
