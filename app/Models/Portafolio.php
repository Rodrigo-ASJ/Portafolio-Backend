<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portafolio extends Model
{
    use HasFactory;
    protected $fillable = ["project_title", "project_url", "created_at", "updated_at"];

}
