<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentalController extends Controller
{
    /**
     * @var Rental
     */
    private Rental $rental;

    /**
     * Construtor da Classe
     *
     * @param Rental $rental
     */
    public function __construct(Rental $rental)
    {
        $this->rental = $rental;
    }

    /**
     * Método intermediário — responsável por retornar 1 dado conforme o seu ID.
     *
     * @param integer $id
     * @return mixed
     */
    private function findById(int $id)
    {
        return $this->rental->find($id);
    }

    /**
     * Método responsável por RETORNAR TODOS os dados da tabela.
     *
     * @return Response
     */
    public function index(): Response
    {
        $obj = $this->rental::all();
        return count($obj) <= 0 ? Response(['INFO' => 'Nenhum aluguel de carro foi encontrado!'], 404) : Response($obj);
    }

    /**
     * Método responsável por INSERIR 1 dado na tabela.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $request->validate($this->rental->rules(), $this->rental->feedback());
        $obj = $this->rental->create($request->all());
        return Response($obj, 201);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $rental
     * @return Response
     */
    public function show(int $rental): Response
    {
        $obj = $this->findById($rental);
        return isset($obj) ? Response($obj) : Response(['INFO' => 'O aluguel de carro pesquisado não foi encontrado!'], 404);
    }

    /**
     * Método responsável por ATUALIZAR 1 dado da tabela conforme o seu ID.
     *
     * @param Request $request
     * @param integer $rental
     * @return Response
     */
    public function update(Request $request, int $rental): Response
    {
        $obj = $this->findById($rental);
        $message = 'A locação de carro a ser atualizada não foi encontrada!';
        return $this->dynamicUpdate($request, $message, $obj);
    }

    /**
     * Método responsável por DELETAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $rental
     * @return Response
     */
    public function destroy(int $rental): Response
    {
        $obj = $this->findById($rental);
        if (isset($obj)) {
            $obj->delete();
            return Response($obj);
        } else {
            return Response(['INFO' => 'O aluguel de carro a ser deletado não foi encontrado!'], 404);
        }
    }

}
