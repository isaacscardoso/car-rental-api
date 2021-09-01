<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static findOrFail(int $id)
 */
class CarModel extends Model
{
    use HasFactory;

    protected $table = 'carros_modelos';

    protected $fillable = [
        'marca_id',
        'nome',
        'imagem',
        'numero_portas',
        'lugares',
        'air_bag',
        'abs'
    ];
}
