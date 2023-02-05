<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Portafolio extends Model
{
    use HasFactory;
    protected $fillable = [
        "project_title",
        "project_img",
        "project_description",
        "project_tech",
        "created_at",
        'project_github',
        'project_deployment',
        'user_id',
        "updated_at"];

/* Relacion uno a muchos inversa */
public function user(){
    return $this->belongsTo('App\Models\User');
}

}
