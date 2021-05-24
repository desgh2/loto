<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    use HasFactory;

	protected $table = 'result';
	protected $fillable = ['lottery_id', 'name', 'image', 'jackpot', 'close_date', 'draw_result'];


    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'lottery_id', 'loto_id');
    }

}
