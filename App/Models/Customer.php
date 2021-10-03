<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'clientes';

    protected $fillable = ['nome'];

    /**
     * @return string[]
     */
    public function rules(): array
    {
        return [
            'nome' => 'required'
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
