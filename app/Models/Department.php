<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $fillable = [
        'name',
    ];

    public function contact_department(){
        return $this->belongsToMany(Contact::class,'contact_departments','department_id','contact_id');
    }
}

