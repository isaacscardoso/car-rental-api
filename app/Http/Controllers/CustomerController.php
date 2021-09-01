<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CustomerController extends Controller
{
    /**
     * Método responsável por RETORNAR TODOS os dados da tabela.
     *
     * @return Response
     */
    public function index(): Response
    {
        return Response(Customer::all());
    }

    /**
     * Método responsável por INSERIR 1 dado na tabela.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        return Response(Customer::create($request->all()));
    }

    /**
     * Método intermediário — responsável por retornar 1 dado conforme o seu ID.
     *
     * @param integer $id
     * @return mixed
     */
    private function findById(int $id)
    {
        return Customer::findOrFail($id);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $customer
     * @return Response
     */
    public function show(int $customer): Response
    {
        return Response($this->findById($customer));
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
        $obj->update($request->all());
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
        $obj->delete();
        return Response($obj);
    }
}
