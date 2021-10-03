<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
            'nome' => 'required|unique:carros_marcas,nome,' . $this->id,
            'imagem' => 'required',
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
        ];
    }
}
