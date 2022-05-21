<?php

namespace App\Jobs;

class SearchCep extends Job
{

    private int $cep;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($cep)
    {
        $this->cep = $cep;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $cep = $this->cep;
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => "$_ENV[VIA_CEP]$cep/json",
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => "GET",
        ]);
        $response = curl_exec($curl);
        $err = curl_error($curl);
        curl_close($curl);
        if ($err) {
            echo "cURL Error #:" . $err;
        } else {
            return $response;
        }
    }
}
