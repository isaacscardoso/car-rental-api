<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $table = 'carros';

    protected $fillable = ['modelo_id', 'placa', 'disponivel', 'km'];

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'modelo_id' => 'required:carros' . $this->id,
            'placa' => 'required|unique:carros,placa' . $this->id,
            'disponivel' => 'required',
            'km' => 'required'
        ];
    }

    /**
     * @return string[]
     */
    public function feedback(): array
    {
        return [
            'required' => 'Preencha o campo :attribute.',
            'placa.unique' => 'Já existe um registro para esta placa.'
        ];
    }
}
