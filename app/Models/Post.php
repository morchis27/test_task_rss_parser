<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

/**
 * @method firstOrCreate(array|null[]|string[] $array, array $array1)
 * @method create(array $data)
 * @method findOrFail(int $id)
 */
class Post extends Model
{
    protected $fillable = [
        'title',
        'link',
        'description',
        'pub_date',
    ];


    protected function casts(): array
    {
        return [
            'pub_date' => 'datetime',
        ];
    }
}
