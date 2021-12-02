<?php

namespace App\Http\Controllers;

use App\Models\CarModel;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class CarModelController extends Controller
{
    /**
     * @var CarModel
     */
    private CarModel $carModel;

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
        // $obj = $this->carModel::all();
        $obj = $this->carModel::with('carBrand')->get();
        return count($obj) <= 0 ? Response(['INFO' => 'Nenhum modelo de carro foi encontrado!'], 404) : Response($obj);
    }

    /**
     * @param Request $request
     * @return string
     */
    public function catchImage(Request $request): string
    {
        $image = $request->file('imagem');
        return $image->store('images/modelos', 'public');
    }

    /**
     * Método responsável por INSERIR 1 dado na tabela.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request): Response
    {
        $request->validate($this->carModel->rules(), $this->carModel->feedback());
        $obj = $this->carModel->create([
            'marca_id'      => $request->input('marca_id'),
            'nome'          => $request->input('nome'),
            'imagem'        => $this->catchImage($request),
            'numero_portas' => $request->input('numero_portas'),
            'lugares'       => $request->input('lugares'),
            'air_bag'       => $request->input('air_bag'),
            'abs'           => $request->input('abs')
        ]);

        return Response($obj, 201);
    }

    /**
     * Método responsável por RETORNAR 1 dado da tabela conforme o seu ID.
     *
     * @param integer $carModel
     * @return Response
     */
    public function show(int $carModel): Response
    {
        // $obj = $this->findById($carModel);
        $obj = $this->carModel->with('carBrand')->find($carModel);
        return isset($obj) ? Response($obj) : Response(['INFO' => 'O modelo de carro pesquisado não foi encontrado!'], 404);
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
        $message = 'O modelo de carro a ser atualizado não foi encontrado!';
        $comparisonMethod = 'PATCH';

        if (isset($obj)) {
            if ($request->method() === $comparisonMethod) {
                $dynamicRules = array();
                // Percorrendo todas as regras definidas no Model
                foreach ($obj->rules() as $input => $rule) {
                    // Coletar apenas as regras aplicáveis aos parâmetros parciais da requisição
                    if (array_key_exists($input, $request->all())) {
                        $dynamicRules[$input] = $rule;
                    }
                }
                $request->validate($dynamicRules, $obj->feedback());
            } else {
                $request->validate($obj->rules(), $obj->feedback());
            }
            if ($request->file('imagem')) {
                // Deleta a imagem antiga
                Storage::disk('public')->delete($obj->imagem);
                $obj->update($request->all());
                $obj->update([
                    'imagem' => $this->catchImage($request)
                ]);
            } else {
                $obj->update($request->all());
            }
            return Response($obj);
        } else {
            return Response(['INFO' => $message], 404);
        }
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
        if (isset($obj)) {
            Storage::disk('public')->delete($obj->imagem);
            $obj->delete();
            return Response($obj);
        } else {
            return Response(['INFO' => 'O modelo de carro a ser deletado não foi encontrado!'], 404);
        }
    }

}
