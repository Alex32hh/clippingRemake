<?php
setlocale(LC_TIME, 'pt_PT', 'pt_BR.utf-8', 'pt_PT.utf-8', 'portuguese');

try {
        // define('DB_SERVER', 'localhost');
        // define('DB_USERNAME', 'manifext_Alexandre');
        // define('DB_PASSWORD', 'Francisco32hh01');
        // define('DB_DATABASE', 'manifext_clipping');
        // $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);
       
        define('DB_SERVER', 'localhost');
        define('DB_USERNAME', 'root');
        define('DB_PASSWORD', 'root');
        define('DB_DATABASE', 'id11598184_usuarios');
        $db = mysqli_connect(DB_SERVER,DB_USERNAME,DB_PASSWORD,DB_DATABASE);

        $sql = "SELECT * FROM alertas";
        $result = $db->query($sql);
      if ($result->num_rows > 0) {
            // output data of each row
        while($row = $result->fetch_assoc()) {
          if(strpos($row['alerta'], ',') == true){

            for($i = 0;$i < count($row['alerta']);$i++){   
                $ch = curl_init();
                curl_setopt($ch, CURLOPT_URL, "https://wrapapi.com/use/tremetrex09/newsclipscrapper/pagesPost/latest");
                curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                curl_setopt($ch, CURLOPT_POST, true);
                curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode(["p" => explode(',',$row['alerta'])[$i],"wrapAPIKey" => "nEutonp6nd0EhAOCJ8Ti4lYFcF9dWUKo"]));
                curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
                $response = curl_exec($ch);
                $data = json_decode($response, true);
                $envia =  false;

                for($i = 0;$i < count($data['data']['output']['Titulo']);$i++){
                  if(strpos($data['data']['output']['data'][$i],'minutos')){
                    $link = $data['data']['output']['link'][$i];
                    $url = curl_init();
                    curl_setopt($url, CURLOPT_URL, "https://wrapapi.com/use/CaracasX9/scrapper/Link/0.0.1");
                    curl_setopt($url, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
                    curl_setopt($url, CURLOPT_POST, true);
                    curl_setopt($url, CURLOPT_POSTFIELDS, json_encode(["id" => explode("/", $link)[2],"wrapAPIKey" => "QUQT5jn3cznd09gx6qt4Ukz9LPlvwOZ9"]));
                    curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
                    $rqu = curl_exec($url);
                    $resul = json_decode($rqu, true);
                     
                    $linkUrl =   $resul['data']['Article']['Link'];

                    $titulo = $data['data']['output']['Titulo'][$i];

                    if($data['data']['output']['imagem'][$i] == null)
                       $imagem = "https://bhmlib.org/wp-content/themes/cosimo-pro/images/no-image-box.png";
                    else
                       $imagem = explode("=",$data['data']['output']['imagem'][$i])[0];

                    $fonteNot = ucfirst(strtolower($data['data']['output']['fonte'][$i]));
                    $$linkNoticia = $linkOfficial[1][0];
            
                    $descricao = $data['data']['output']['descricao'][$i];

                    $ano = substr($data['data']['output']['dataTime'][$i],0,4);
                    $mes = substr($data['data']['output']['dataTime'][$i],5,2);
                    $dia = substr($data['data']['output']['dataTime'][$i],8,2);
                    $dataT = $dia.'/'.$mes.'/'.$ano;

                   // ,fonte =".$fonteNot."' ### $sql = "INSERT INTO trakingNews (idusuario,nomeNoticia,fonte)SELECT  '".$row['idusuario']."','".$titulo."','".$fonteNot."' FROM trakingNews  WHERE NOT EXIST(  
                    $query = "SELECT fonte, UserName FROM trakingNews WHERE idusuario= '".$row['idusuario']."'  ";
                    $query_run = mysqli_query($db,$query);
                    if (mysqli_num_rows($query_run)!=1){
                                $Insert = "INSERT INTO trakingNews (idusuario,nomeNoticia,fonte,idpesquisa,mes)VALUES('".$row['idusuario']."','".$titulo."','".$fonteNot."','".$row['alerta']."','".str_pad(date('m'),1, '0', STR_PAD_LEFT)."')";
                                mysqli_query($db,$Insert);
                                echo "Inserido<br>";
                    }
                    

        }

    }
  }

  }else{
      $ch = curl_init();
      curl_setopt($ch, CURLOPT_URL, "https://wrapapi.com/use/tremetrex09/newsclipscrapper/pagesPost/latest");
      curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
      curl_setopt($ch, CURLOPT_POST, true);
      curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
      "p" => $row['alerta'],
      "wrapAPIKey" => "nEutonp6nd0EhAOCJ8Ti4lYFcF9dWUKo"
      ]));
      curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
      $response = curl_exec($ch);
      $data = json_decode($response, true);

      $envia =  false;

      for($i = 0;$i < count($data['data']['output']['Titulo']);$i++){

        if(strpos($data['data']['output']['data'][$i],'minutos')){
          $link = $data['data']['output']['link'][$i];
          
          $url = curl_init();
          curl_setopt($url, CURLOPT_URL, "https://wrapapi.com/use/CaracasX9/scrapper/Link/0.0.1");
          curl_setopt($url, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
          curl_setopt($url, CURLOPT_POST, true);
          curl_setopt($url, CURLOPT_POSTFIELDS, json_encode([
            "id" => explode("/", $link)[2]
            ,"wrapAPIKey" => "QUQT5jn3cznd09gx6qt4Ukz9LPlvwOZ9"
          ]));
          curl_setopt($url, CURLOPT_RETURNTRANSFER, true);
          $rqu = curl_exec($url);
          $resul = json_decode($rqu, true);
           
          $linkUrl =   $resul['data']['Article']['Link'];

          $titulo = $data['data']['output']['Titulo'][$i];

          if($data['data']['output']['imagem'][$i] == null)
             $imagem = "https://bhmlib.org/wp-content/themes/cosimo-pro/images/no-image-box.png";
          else
             $imagem = explode("=",$data['data']['output']['imagem'][$i])[0];

          $fonteNot = ucfirst(strtolower($data['data']['output']['fonte'][$i]));
          $$linkNoticia = $linkOfficial[1][0];
  
          $descricao = $data['data']['output']['descricao'][$i];

          $ano = substr($data['data']['output']['dataTime'][$i],0,4);
          $mes = substr($data['data']['output']['dataTime'][$i],5,2);
          $dia = substr($data['data']['output']['dataTime'][$i],8,2);
          $dataT = $dia.'/'.$mes.'/'.$ano;

         // $sql = "INSERT INTO trakingNews (idusuario,nomeNoticia,fonte)SELECT  '".$row['idusuario']."','".$titulo."','".$fonteNot."' FROM trakingNews  WHERE NOT EXIST(  
          $query = "SELECT fonte, UserName FROM trakingNews WHERE idusuario= '".$row['idusuario']."',fonte =".$fonteNot."'  ";
          $query_run = mysqli_query($db,$query);
          if (mysqli_num_rows($query_run)!=1){
                      $Insert = "INSERT INTO trakingNews (idusuario,nomeNoticia,fonte,idpesquisa,mes)VALUES('".$row['idusuario']."','".$titulo."','".$fonteNot."','".$row['alerta']."','".str_pad(date('m'),1, '0', STR_PAD_LEFT)."')";
                      mysqli_query($db,$Insert);
                      echo "inserido<br>";
          }

    }
   }
  }
 }
}
            
         
            
   
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}

function highlight($text, $word){
  if(strlen($text) > 0 && strlen($word) > 0)
  {
    return (str_ireplace($word, "<b style='color:#00B28D;'>{$word}</b>", $text));
  }
  return ($text);
}




