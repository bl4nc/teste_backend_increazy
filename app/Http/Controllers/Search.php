<?php

namespace App\Http\Controllers;

use App\Jobs\SearchCep;
use Illuminate\Support\Facades\Queue;

// use Illuminate\Http\Request;


class Search extends Controller
{

    function clean($cep)
    {
        return str_replace(['-', ' '], '', $cep);
    }

    function validade($cep)
    {
        return preg_match('/^[0-9]{5,5}([0-9]{3,3})?$/', $cep);
    }

    function prepare($cep)
    {
        $req = curl_init();
        curl_setopt_array($req, [
            CURLOPT_URL => "$_ENV[VIA_CEP]$cep/json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);
        return $req;
    }

    function request_api($request_list)
    {
        $mh = curl_multi_init();
        for ($i = 0; $i != count($request_list); $i++) {
            curl_multi_add_handle($mh, $request_list[$i]);
        }
        $running = null;
        do {
            curl_multi_exec($mh, $running);
        } while ($running);

        $responses = [];
        for ($i = 0; $i != count($request_list); $i++) {
            curl_multi_remove_handle($mh, $request_list[$i]);
            array_push($responses, curl_multi_getcontent($request_list[$i]));
        }
        curl_multi_close($mh);

        return $responses;
    }



    public function search($ceps)
    {
        $req_list = [];
        foreach (explode(',', $ceps) as $cep) {
            $cep = $this->clean($cep);
            if ($this->validade($cep)) array_push($req_list, $this->prepare($cep));
        }

        $ceps_data = $this->request_api($req_list);
        return $ceps_data;
    }
}
