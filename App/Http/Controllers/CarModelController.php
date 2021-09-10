<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarModelController extends Controller
{
    /**
     * @var CarModel
     */
    private $carModel;

    /**
     * Construtor da Classe
     *
     * @param CarModel $carModel
     */
    public function __construct(CarModel $carModel)
    {
        $this->carModel = $carModel;
    }

    /**
     * Método intermediário — responsável por retornar 1 dado conforme o seu ID.
     *
     * @param integer $id
     * @return mixed
     */
    private function findById(int $id)
    {
        return $this->carModel->find($id);
    }

    /**
     * Método responsável por RETORNAR TODOS os dados da tabela.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Response($this->carModel::all());
    }

    /**
     * Método responsável por INSERIR 1 dado na tabela.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        return Response($this->carModel->create($request->all()), 201);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $carModel
     * @return Response
     */
    public function show(int $carModel): Response
    {
        $obj = $this->findById($carModel);

        if ($obj !== null)
            return Response($obj);
        else
            return Response(['INFO' => 'O recurso pesquisado não foi encontrado!'], 404);
    }

    /**
     * Método responsável por ATUALIZAR 1 dado da tabela conforme o seu ID.
     *
     * @param Request $request
     * @param integer $carModel
     * @return Response
     */
    public function update(Request $request, int $carModel): Response
    {
        $obj = $this->findById($carModel);

        if ($obj !== null)
            $obj->update($request->all());
        else
            return Response(['INFO' => 'O recurso a ser atualizado não foi encontrado!'], 404);

        return Response($obj);
    }

    /**
     * Método responsável por DELETAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $carModel
     * @return Response
     */
    public function destroy(int $carModel): Response
    {
        $obj = $this->findById($carModel);

        if ($obj !== null)
            $obj->delete();
        else
            return Response(['INFO' => 'O recurso a ser deletado não foi encontado!'], 404);

        $obj->delete();
        return Response($obj);
    }
}
