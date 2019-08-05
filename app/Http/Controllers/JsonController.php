<?php

namespace App\Http\Controllers;

use App\Licencias;
use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function __construc()
    {

    }

    /**
     * checkLicencia Metodo para la comprobacion de codigo de Licencia
     * [ si existe y no ha expirado ]
     * @req parametro @lic
     */
    public function checkLicencia(Request $req)
    {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *'); 
        // header('Accept: *');
        // header('Access-Control-Allow-Headers: *');
        // header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');

        $data = Licencias::where('code', $req->lic)
            ->get()
            ->makeHidden('updated_at')
            ->makeHidden('created_at');

        // Respuesta por defecto en caso que no exista ese codigo de licencia
        $response = array("error" => "licencia no encontrada", "data" => null);

        if (count($data) > 0) {

            $currenDate = date('Y-m-d');
            $noExpiro   = (strtotime($data[0]->expire) > strtotime($currenDate));

            if ($noExpiro) {
                $data[0]->confirmada = $currenDate; // Agrego la fecha en que fue confirmada
                $data[0]->save(); // Actualizo este registro con la fecha en que se confirmo
                $response = array("error" => null, "data" => $data[0]); // nueva respuesta
            } else {
                // # cuando ya expiro
                $response = array(
                    "error" => "Lo sentimos pero esta licencia ya ha expirado",
                    "data"  => null,
                );
            }
        }
        header('Access-Control-Allow-Origin: *');
        header("Content-type: application/json; charset=utf-8");
        return $response;
    }
}
