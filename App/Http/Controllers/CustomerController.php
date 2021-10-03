<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * @var
     */
    private $customer;

    /**
     * Construtor da Classe
     *
     * @param Customer $customer
     */
    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    /**
     * Método intermediário — responsável por retornar 1 dado conforme o seu ID.
     *
     * @param integer $id
     * @return mixed
     */
    private function findById(int $id)
    {
        return $this->customer->find($id);
    }

    /**
     * Método responsável por RETORNAR TODOS os dados da tabela.
     *
     * @return Response
     */
    public function index(): Response
    {
        $obj = $this->customer::all();

        if (count($obj) <= 0)
            return Response(['INFO' => 'Nenhum cliente foi encontrado!'], 404);
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
        $request->validate($this->customer->rules(), $this->customer->feedback());
        $obj = $this->customer->create($request->all());

        return Response($obj, 201);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $customer
     * @return Response
     */
    public function show(int $customer): Response
    {
        $obj = $this->findById($customer);

        if ($obj !== null)
            return Response($obj);
        else
            return Response(['INFO' => 'O cliente pesquisado não foi encontrado!'], 404);
    }

    /**
     * Método responsável por ATUALIZAR 1 dado da tabela conforme o seu ID.
     *
     * @param Request $request
     * @param integer $customer
     * @return Response
     */
    public function update(Request $request, int $customer): Response
    {
        $obj = $this->findById($customer);

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
            return Response(['INFO' => 'A conta cliente a ser atualizada não foi encontrada!'], 404);

        return Response($obj);
    }

    /**
     * Método responsável por DELETAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $customer
     * @return Response
     */
    public function destroy(int $customer): Response
    {
        $obj = $this->findById($customer);

        if ($obj !== null)
            $obj->delete();
        else
            return Response(['INFO' => 'O cliente a ser deletado não foi encontrado!'], 404);

        return Response($obj);
    }
}
