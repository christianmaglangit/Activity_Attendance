<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addstudent extends Model
{
    use HasFactory;

    protected $table = "addstudent";

    protected $fillable = [
        'name',
        'idnumber',
        'course',
        'yearlevel',
        'collegedep',
        'account_id',
    ];
}

