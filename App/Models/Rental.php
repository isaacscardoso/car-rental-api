<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $table = 'locacoes';

    protected $fillable = [
        'cliente_id',
        'carro_id',
        'data_inicio_periodo',
        'data_final_previsto_periodo',
        'data_final_realizado_periodo',
        'valor_diaria',
        'km_inicial',
        'km_final'
    ];

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'client_id'                    => 'exists:clientes,id',
            'carro_id'                     => 'exists:carros,id',
            'data_inicio_periodo'          => 'required|date',
            'data_final_previsto_periodo'  => 'required|date|after:data_inicio_periodo',
            'data_final_realizado_periodo' => 'required|date|after:data_inicio_periodo',
            'valor_diaria'                 => 'required',
            'km_inicial'                   => 'required',
            'km_final'                     => 'required'
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
