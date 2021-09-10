<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarBrandController extends Controller
{
    /**
     * @var CarBrand
     */
    private $carBrand;

    /**
     * Construtor da Classe
     *
     * @param CarBrand $carBrand
     */
    public function __construct(CarBrand $carBrand)
    {
        $this->carBrand = $carBrand;
    }

    /**
     * Método intermediário — responsável por retornar 1 dado conforme o seu ID.
     *
     * @param integer $id
     * @return mixed
     */
    private function findById(int $id)
    {
        return $this->carBrand->find($id);
    }

    /**
     * Método responsável por RETORNAR TODOS os dados da tabela.
     *
     * @return Response
     */
    public function index(): Response
    {
        $obj = $this->carBrand::all();

        if (count($obj) <= 0)
            return Response(['INFO' => 'Nenhuma marca de carro foi encontrada!'], 404);
        else
            return Response($obj);
    }

    /**
     * Método responsável por INSERIR 1 dado na tabela.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        return Response($this->carBrand->create($request->all()), 201);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $carBrand
     * @return Response
     */
    public function show(int $carBrand): Response
    {
        $obj = $this->findById($carBrand);

        if ($obj !== null)
            return Response($obj);
        else
            return Response(['INFO' => 'A marca de carro pesquisada não foi encontrada!'], 404);
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

        if ($obj !== null)
            $obj->update($request->all());
        else
            return Response(['INFO' => 'A marca de carro a ser atualizada não foi encontrada!'], 404);

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

        if ($obj !== null)
            $obj->delete();
        else
            return Response(['INFO' => 'A marca de carro a ser deletada não foi encontrada!'], 404);

        return Response($obj);
    }
}
