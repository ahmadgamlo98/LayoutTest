<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContactDepartment extends Model
{
    protected $fillable = [
        'contact_id',
        'department_id',
    ];
    public $timestamps = false;
}
