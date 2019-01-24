<?php

function curl_get_contents($url)
{
    $ch = curl_init();
   curl_setopt($ch, CURLOPT_URL, $url);
   curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
   curl_setopt($ch,CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/2.0.0.13');
   $html = curl_exec($ch);
   $data = curl_exec($ch);
   curl_close($ch);
   return $data;
}

if ($_SERVER['REQUEST_METHOD'] == 'GET') {

    if (isset($_GET['url'])) {        
        // Obtener parámetro
        $parametro = $_GET['url'];
        $sujeto = curl_get_contents($parametro); 
        
        if ($sujeto) {
        //Cojemos el div que tiene la imformación
        $cadena_ini='featured-item-meta';
        $cadena_fin='featured-item-notice primary';
        $pos1 = strpos($sujeto, $cadena_ini);
        $pos1 = $pos1 + strlen($cadena_ini) + 2;
        $pos2 = strpos($sujeto, $cadena_fin);
        $div_data = substr($sujeto, $pos1, $pos2); 

        //Eliminamos tags
        $patrones = array();
        $patrones[0] = '{<a[^>]*>}';
        $patrones[1] = '{</a>}';
        $patrones[2] = '{<span>}';
        $patrones[3] = '{</span>}';
        $patrones[4] = '{more}';
        $div_data = preg_replace($patrones,'',$div_data);

        $pattern = "#<[^>]+>(.*)</[^>]+>#U";
        preg_match_all($pattern, $div_data, $salida, PREG_PATTERN_ORDER);
        //echo htmlentities($div_data).'<br><br>';

        for ($i = 1; $i <= 15; $i++) {
        $salida[1][$i] = trim(str_replace('<strong>', "", $salida[1][$i]));
        //echo $i.' '.htmlentities($salida[1][$i]). "<br>";
        }

        $abilities = "None";

        switch ($salida[1][10]) {
            case "Abilities":
                $abilities = $salida[1][11];
                break;
            case "Group Affiliations":
                $groups = $salida[1][11];
                break;
        }

        switch ($salida[1][12]) {
            case "First Appearance":
                $first = $salida[1][13];
                break;
            case "Group Affiliations":
                $groups = $salida[1][13];
                break;
        }

        switch ($salida[1][14]) {
            case "First Appearance":
                $first = $salida[1][15];
                break;  
        }

        //echo htmlspecialchars_decode($salida[1][4],ENT_QUOTES);    
        $atributos = array(
              "name"=>htmlspecialchars_decode($salida[1][2],ENT_QUOTES),
              "height" => htmlspecialchars_decode($salida[1][4],ENT_QUOTES),  
              "weight" => htmlspecialchars_decode($salida[1][6],ENT_QUOTES),
              "powers" => htmlspecialchars_decode($salida[1][8],ENT_QUOTES),
              "abilities" => htmlspecialchars_decode($abilities,ENT_QUOTES),  
              "groups" => htmlspecialchars_decode($groups,ENT_QUOTES),
              "first" => htmlspecialchars_decode($first,ENT_QUOTES)
        ); 

        $data = (object)$atributos;
        $myJSON = json_encode($data);

        print $myJSON;
            
        }
        } else {
            // Enviar respuesta de error general
            print json_encode(
                array(
                    'estado' => '2',
                    'mensaje' => 'No se obtuvo el registro'
                )
            );
        }

    } else {
        // Enviar respuesta de error
        print json_encode(
            array(
                'estado' => '3',
                'mensaje' => 'Se necesita un identificador'
            )
        );
    }


?>
