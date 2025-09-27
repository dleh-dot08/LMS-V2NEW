<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class File extends Model
{
    use HasFactory;

    protected $table = 'files';
    protected $primaryKey = 'id';

    protected $fillable = [
        'filename',
        'storage_path',
        'mime',
        'size',
        'uploaded_by',
        'meta',
    ];

    // Relasi: file diupload oleh user
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
