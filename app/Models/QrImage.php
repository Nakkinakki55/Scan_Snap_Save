<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QrImage extends Model
{
    protected $fillable = ['qr_data', 'image_path', 'user_id'];
}
