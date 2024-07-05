<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class Transcription extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'name',
        'file_name',
        'Transcription',
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
        Storage::delete($this->file_name);

        return parent::delete();
    }
}
