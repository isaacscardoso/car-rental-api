<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /**
     * Método responsável por lidar com atualização dinâmica do PATCH
     *
     * @param Request $request
     * @param string $message
     * @param $obj
     * @return Response
     */
    public function dynamicUpdate(Request $request, string $message, $obj): Response
    {
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
            $obj->update($request->all());
            return Response($obj);
        } else {
            return Response(['INFO' => $message], 404);
        }
    }
}
