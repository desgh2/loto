<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lottery extends Model
{

    use HasFactory;

	protected $table = 'lottery';
	protected $fillable = [
        'loto_id',
        'name',
        'title',
        'description',
        'slug',
        'heading',
        'text',
        'ticket',
        'country',
        'image',
        'currency', 'jackpot', 'rating', 'bonusball', 'reintegro', 'extra', 'regular_min', 'regular_max', 'regular_per_line', 'special_min', 'special_max', 'special_per_line', 'close_date', 'countdown', 'published'];


    public function scopePublished($query)
    {
        return $query->where('published', true);
    }


    public function results()
    {
        return $this->hasMany(Result::class, 'lottery_id', 'loto_id')->latest();
    }


    public function result() {
    	return $this->hasOne(Result::class, 'lottery_id', 'loto_id')->latest();
    }


    public static function recommends($array)
    {
        return Lottery::whereIn('id', $array)->get();
    }
}
