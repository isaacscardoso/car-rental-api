<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarBrandController extends Controller
{
    /**
     * Método responsável por RETORNAR TODOS os dados da tabela.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Response(CarBrand::all());
    }

    /**
     * Método responsável por INSERIR 1 dado na tabela.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        return Response(CarBrand::create($request->all()));
    }

    /**
     * Método intermediário — responsável por retornar 1 dado conforme o seu ID.
     *
     * @param integer $id
     * @return mixed
     */
    private function findById(int $id)
    {
        return CarBrand::findOrFail($id);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $carBrand
     * @return Response
     */
    public function show(int $carBrand): Response
    {
        return Response($this->findById($carBrand));
    }

    /**
     * Método responsável por ATUALIZAR 1 dado da tabela conforme o seu ID.
     *
     * @param Request $request
     * @param integer $carBrand
     * @return Response
     */
    public function update(Request $request, int $carBrand): Response
    {
        $obj = $this->findById($carBrand);
        $obj->update($request->all());
        return Response($obj);
    }

    /**
     * Método responsável por DELETAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $carBrand
     * @return Response
     */
    public function destroy(int $carBrand): Response
    {
        $obj = $this->findById($carBrand);
        $obj->delete();
        return Response($obj);
    }
}
