<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'marca_id' => 'required',
            'nome' => 'required',
            'imagem' => 'required',
            'numero_portas' => 'required',
            'lugares' => 'required',
            'air_bag' => 'required',
            'abs' => 'required'
        ];
    }

    /**
     * @return string[]
     */
    public function feedback(): array
    {
        return [
            'required' => 'Preencha o campo :attribute.'
        ];
    }
}
