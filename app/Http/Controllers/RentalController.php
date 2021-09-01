<?php

namespace App\Http\Controllers;

use App\Models\Rental;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class RentalController extends Controller
{
    /**
     * Método responsável por RETORNAR TODOS os dados da tabela.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Response(Rental::all());
    }

    /**
     * Método responsável por INSERIR 1 dado na tabela.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        return Response(Rental::create($request->all()));
    }

    /**
     * Método intermediário — responsável por retornar 1 dado conforme o seu ID.
     *
     * @param integer $id
     * @return mixed
     */
    private function findById(int $id)
    {
        return Rental::findOrFail($id);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $rental
     * @return Response
     */
    public function show(int $rental): Response
    {
        return Response($this->findById($rental));
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
        $obj->update($request->all());
        return Response($obj);
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
        $obj->delete();
        return Response($obj);
    }
}
