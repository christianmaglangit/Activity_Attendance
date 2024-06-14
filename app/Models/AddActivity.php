<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AddActivity extends Model
{
    use HasFactory;
    protected $table = 'addactivity';
    protected $fillable = [
        'activityname',
        'TImorningStartTime',
        'TImorningEndTime',
        'TOmorningStartTime',
        'TOmorningEndTime',
        'noonStartTime',
        'noonEndTime',
        'afternoonStartTime',
        'afternoonEndTime',
        'account_id'
    ];
}
