<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

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
            'marca_id'      => 'exists:carros_marcas,id',
            'nome'          => 'required|unique:carros_modelos,nome,' . $this->id . '|min:3',
            'imagem'        => 'required|file|mimes:png,jpg,jpeg,svg',
            'numero_portas' => 'required|integer|digits_between:1,5', // valores aceitos (2, 3, 4)
            'lugares'       => 'required|integer|digits_between:1,40',
            'air_bag'       => 'required|boolean',
            'abs'           => 'required|boolean'
        ];
    }

    /**
     * @return string[]
     */
    public function feedback(): array
    {
        return [
            'required'     => 'Preencha o campo :attribute.',
            'nome.unique'  => 'O nome do modelo já existe.',
            'imagem.mimes' => 'Os formatos aceitos para imagens são: PNG, JPG, JPEG, SVG'
        ];
    }

    /**
     *  Vários MODELOS de carros podem pertencer a 1 MARCA de carro
     *
     * @return BelongsTo
     */
    public function carBrand(): BelongsTo
    {
        return $this->belongsTo(CarBrand::class,'marca_id');
    }
}
