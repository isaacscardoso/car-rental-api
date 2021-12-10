<?php

namespace App\Http\Controllers;

use App\Models\CarBrand;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CarBrandController extends Controller
{
    /**
     * @var CarBrand
     */
    private CarBrand $carBrand;

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
        // $obj = $this->carBrand::all();
        $obj = $this->carBrand::with('carModels')->get();
        return count($obj) <= 0 ? Response(['INFO' => 'Nenhuma marca de carro foi encontrada'], 404) : Response($obj);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function catchImage(Request $request): string
    {
        $image = $request->file('imagem');
        return $image->store('images/marcas', 'public');
    }

    /**
     * Método responsável por INSERIR 1 dado na tabela.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $request->validate($this->carBrand->rules(), $this->carBrand->feedback());
        $obj = $this->carBrand->create([
            'nome' => $request->input('nome'),
            'imagem' => $this->catchImage($request)
        ]);

        return Response($obj, 201);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $carBrand
     * @return Response
     */
    public function show(int $carBrand): Response
    {
        // $obj = $this->findById($carBrand);
        $obj = $this->carBrand->with('carModels')->find($carBrand);
        return (isset($obj)) ? Response($obj) : Response(['INFO' => 'A marca de carro pesquisada não foi encontrada!'], 404);
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
        $message = 'A marca de carro a ser atualizada não foi encontrada!';
        return $this->dynamicUpdate($request, $message, $obj);
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
        if (isset($obj)) {
            // Deleta a imagem do diretório
            Storage::disk('public')->delete($obj->imagem);
            $obj->delete();
            return Response($obj);
        } else {
            return Response(['INFO' => 'A marca de carro a ser deletada não foi encontrada!'], 404);
        }
    }

}
