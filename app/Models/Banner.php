<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    use HasFactory;

    protected $table = 'banner';

    protected $fillable = [
        'loto_id',
        'name',
        'size',
        'script',
        'type',
    ];

    /**
     * Типы баннеров
     *
     * @var array
     */
    public static $types = [
        'horizontal' => 'Горизонтальный',
        'vertical'   => 'Вертикальный',
        'square'     => 'Квадрат',
    ];

    //Тип баннера
    public function type()
    {
        return self::$types[$this->type];
    }

    //Лотерея
    public function lottery()
    {
        return $this->belongsTo(Lottery::class, 'loto_id', 'id');
    }

    //Вертикальный баннер
    public static function verticalBanner($loto_id)
    {
        if ($loto_id) {
            return self::where('loto_id', '!=', $loto_id)
            ->where('type', 'vertical')
            ->first()
            ->script;
        }
        return self::inRandomOrder()
            ->where('type', 'vertical')
            ->first()
            ->script;
    }

    //Горизонтальный баннер
    public static function horizontalBanner($loto_id)
    {
        if ($loto_id) {
            return self::where('loto_id', '!=', $loto_id)
            ->where('type', 'horizontal')
            ->first()
            ->script;
        }
        return self::inRandomOrder()
            ->where('type', 'horizontal')
            ->first()
            ->script;
    }

}
