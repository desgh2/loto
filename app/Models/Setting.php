<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{

    use HasFactory;

	protected $table = 'setting';

	protected $fillable = [
        'title',
        'description',
        'heading',
        'text',
        'lottery_count',
        'result_count',
        'recommend',
        'address',
        'email',
        'phone'
    ];


}