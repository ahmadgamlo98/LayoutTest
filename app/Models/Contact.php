<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $fillable = [
        'name',
        'phone',
    ];
    public function department(){
        return $this->belongsToMany(Department::class,'contact_departments','contact_id','department_id');
    }

    
    
}
