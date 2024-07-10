<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

/**
 * @property int id
 * @property int user_id
 * @property string name
 * @property string language
 * @property string prompt
 * @property string response_format
 * @property string temperature
 * @property string timestamp_granularity
 * @property string file_name
 * @property string file_path
 * @property string transcription
 * @property Carbon created_at
 * @property Carbon updated_at
 */
class Transcription extends Model
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
        'transcription',
        'language',
        'prompt',
        'response_format',
        'temperature',
        'timestamp_granularity',
    ];

    protected $casts = [
        'transcription' => 'json',
    ];

    /**
     * Returns the User that has the Transcription
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
