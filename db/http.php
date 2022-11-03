<?php
 

class Http
{
    public function getHttpData($route, $data, $methode = 'POST') : Object
    {
        $curl = curl_init();

        $data["parms"] = ID_SYSTEM;
  

        curl_setopt_array($curl, array(
            CURLOPT_URL => URL_ROOT . $route,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => $methode,
            CURLOPT_POSTFIELDS => $data,
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $_SESSION['token'],
            ),
        ));

        $response = curl_exec($curl);

        
        curl_close($curl);

        return json_decode($response);
    }
}
