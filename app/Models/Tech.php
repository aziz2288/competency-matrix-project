<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tech extends Model
{
    use HasFactory;
    protected $table="techs";
    protected $fillable=['id','name','description','create_at','update_at'];
}
