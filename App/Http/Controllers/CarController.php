<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CarController extends Controller
{
    /**
     * @var Car
     */
    private $car;

    /**
     * Construtor da Classe
     *
     * @param Car $car
     */
    public function __construct(Car $car)
    {
        $this->car = $car;
    }

    /**
     * Método intermediário — responsável por retornar 1 dado conforme o seu ID.
     *
     * @param integer $id
     * @return mixed
     */
    private function findById(int $id)
    {
        return $this->car->find($id);
    }

    /**
     * Método responsável por RETORNAR TODOS os dados da tabela.
     *
     * @return Response
     */
    public function index(): Response
    {
        $obj = $this->car::all();

        if (count($obj) <= 0)
            return Response(['INFO' => 'Nenhum carro foi encontrado!'], 404);
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
        $request->validate($this->car->rules(), $this->car->feedback());
        $obj = $this->car->create($request->all());

        return Response($obj, 201);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $car
     * @return Response
     */
    public function show(int $car): Response
    {
        $obj = $this->findById($car);

        if ($obj !== null)
            return Response($obj);
        else
            return Response(['INFO' => 'O carro pesquisado não foi encontrado!'], 404);
    }

    /**
     * Método responsável por ATUALIZAR 1 dado da tabela conforme o seu ID.
     *
     * @param Request $request
     * @param integer $car
     * @return Response
     */
    public function update(Request $request, int $car): Response
    {
        $obj = $this->findById($car);

        if ($obj !== null) {
            if ($request->method() === 'PATCH') {
                $dynamicRules = array();
                foreach ($obj->rules() as $input => $rule) {
                    if (array_key_exists($input, $request->all())) {
                        $dynamicRules[$input] = $rule;
                    }
                }
                $request->validate($dynamicRules, $obj->feedback());
            } else {
                $request->validate($obj->rules(), $obj->feedback());
            }
            $obj->update($request->all());
        } else
            return Response(['INFO' => 'O carro a ser atualizado não foi encontrado!'], 404);

        return Response($obj);
    }

    /**
     * Método responsável por DELETAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $car
     * @return Response
     */
    public function destroy(int $car): Response
    {
        $obj = $this->findById($car);

        if ($obj !== null)
            $obj->delete();
        else
            return Response(['INFO' => 'O carro a ser deletado não foi encontrado!'], 404);

        return Response($obj);
    }
}
