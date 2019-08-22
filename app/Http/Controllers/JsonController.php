<?php

namespace App\Http\Controllers;

use App\Licencias;
use Illuminate\Http\Request;

class JsonController extends Controller
{
    public function __construc()
    {

        header('Access-Control-Allow-Origin: *');
        header("Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS");
        header('Content-Type: application/json;charset=utf-8');
    }

    public function checkLogin(Request $req)
    {

        //header("Access-Control-Allow-Headers: apikey, Origin, X-Requested-With, Content-Type, Accept, Access-Control-Request-Method, Authorization");

        $jsonArr=array(
            'token'=>'eyJ0eXAiOiJKV1QiLCJhbGciOiJSUzUxMiJ9.eyJpYXQiOjE1NjY0OTAyMzIsImV4cCI6MTU2NjQ5MzgzMiwicm9sZXMiOlsiUk9MRV9VU0VSIl0sInVzZXJuYW1lIjoianVsaW84OTkifQ.BZ_E_FNtqkLFxC3DqJYGkxurPd2ms06jZHGKAakjyNRv-BIgoSYBkrUKbAp8VzEzHtCVpFwgO9W4hrFhNh-jl6XlTc_r53rO84e5iziBlKkiEEvS1CJZnLD1MxLazlKconhBnHlul1jivLZZTkuGWJklA9pfzqu2yEqobsMwMtyzTMsyEcm8jLCdm_EjRnN76EhVm7UGuN99FGtk_DoyZUIg8svKx1UPecbgKlalKIAiSWGkx0Sacb6zfOo5rpVsqxLDeoC2zMWbfnTI-n4zRCralsKFqTFrUf4BWaLf8d5K5RRetrjo7xWn5x4TCg8onyO60UnyVfpVwjPxtw3H2pB2wKOgyl2BWvguBcgC7jtvM-wYaY3EpwpWIw-VO_gqfxxoc0e72yjZ4T9v01AN6nFW8engGtyKfuMvikuKqW3mdVxmO_FBgRnIXekILJh-4psOsyUdENuYFoSU-P_tkJX0gTj3LLo14A9Lyr3Y4RsWHH3uzaEqa5whm-PzPV3RCw7zMBH-LNento0cS76mAnEsBavSMelwVP8EwViioBk-8zyvOkNyekOrRbWlIvUA4P_IxAsMUhXgUETDEfOlVIk3xfhylNXztLliFKumfBYGjiJ2gGryLggk7uj26qe-ZwIw3AJtXon9z1MgVCUa84_kVrsUEFqzvmTfKDePsc8'
        );

        return $jsonArr;
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
