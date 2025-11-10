<?php

namespace App\Models;

use App\Traits\FileUpload;
use App\Traits\HashUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Profile extends Model
{
    use HashUuid, HasFactory, FileUpload;

    protected $fillable = [
        'user_id',
        'photo'
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    protected $appends = ['photo_url'];

    protected function fileSettings(): void
    {
        $this->settings = [
            'attributes'  => ['jpeg', 'jpg', 'png'],
            'path'        => 'upload/profile/photo/',
            'softdelete'  => false
        ];
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function getPhotoUrlAttribute(): string | null
    {
        $this->fileSettings();
        return $this->photo
            ? asset($this->settings['path'] . $this->photo)
            : null;
    }
}
