<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CarBrand extends Model
{
    use HasFactory;

    protected $table = 'carros_marcas';

    protected $fillable = ['nome', 'imagem'];

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'nome' => 'required|unique:carros_marcas,nome,' . $this->id . '|min:3',
            'imagem' => 'required|file|mimes:png,jpg,jpeg,svg',
        ];
    }

    /**
     * @return string[]
     */
    public function feedback(): array
    {
        return [
            'required' => 'Preencha o campo :attribute.',
            'nome.unique' => 'O nome da marca já existe.',
            'imagem.mimes' => 'Os formatos aceitos para imagens são: PNG, JPG, JPEG, SVG'
        ];
    }

    /**
     * Uma MARCA de carro pode pertencer a vários MODELOS de carros
     */
    public function carModels(): HasMany
    {
        return $this->hasMany(CarModel::class, 'marca_id');
    }
}
