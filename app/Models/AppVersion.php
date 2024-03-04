<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AppVersion extends Model
{
    use HasFactory;
    protected $table = 'app_version';
    protected $primaryKey='id';
    public $timestamps = false;
    protected $fillable = ["android", "ios","created_at", "updated_at"];
}
