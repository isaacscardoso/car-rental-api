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
        return Response($this->customer->create($request->all()), 201);
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

        if ($obj !== null)
            $obj->update($request->all());
        else
            return Response(['INFO' => 'O cliente a ser atualizado não foi encontrado!'], 404);

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
