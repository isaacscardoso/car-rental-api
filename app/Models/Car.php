<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $all)
 * @method static findOrFail(int $id)
 */
class Car extends Model
{
    use HasFactory;

    protected $table = 'carros';

    protected $fillable = ['modelo_id', 'placa', 'disponivel', 'km'];
}
