<?php
use Goutte\Client;
require 'cron-jobs/vendor/autoload.php';

include 'config.php';
    session_start();
    if ($_SERVER["REQUEST_METHOD"] == "POST" && $_SESSION['email'] == null) {
        // username and password sent from form 

        $myusername = mysqli_real_escape_string($db, $_POST['email']);
        $mypassword = mysqli_real_escape_string($db, $_POST['password']);

        $sql = "SELECT id FROM assinantes WHERE Email = '$myusername' and senha = '$mypassword'";
        $result = mysqli_query($db, $sql);
        $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
        $active = $row['status'];

        $count = mysqli_num_rows($result);

        // If result matched $myusername and $mypassword, table row must be 1 row

        if ($count == 1) {
            session_start();
            $_SESSION['email'] = $myusername;
            $_SESSION['senha'] = $mypassword;

            
            echo '<script>
            $(".login-content-page").css( "border", "3px solid rgb(45,208,121)");
            window.location.href= "/clipping/";
            </script>';
        } else {
            echo '<script>
         
            $(".login-content-page").addClass("danger");
            $(".login-danger").html("E-mail ou senha errada");
            $(".inputBox-email").val("'.$myusername.'");
            $(".inputBox-senha").val("'.$mypassword.'");
           
             </script>';
        }
    }

function logoff(){
        session_destroy();
        echo '<script>window.location.href= "/clipping/";</script>';
}



function feachData($pesquisa){
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, "https://wrapapi.com/use/tremetrex09/newsclipscrapper/pagesPost/latest");
    curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type: application/json"));
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
    "p" => "". str_replace('+','%',$pesquisa)."",
    "wrapAPIKey" => "nEutonp6nd0EhAOCJ8Ti4lYFcF9dWUKo"
    ]));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    $response = curl_exec($ch);
    $data = json_decode($response, true);

    $arrayCleUp =  array();
    for ($i = 0; $i < count($data['data']['output']['imagem']); $i++) {

        $link = $data['data']['output']['link'][$i];
        $urlGc = ('https://news.google.com/' . $link);
        // $css_selector = "noscript a";
        // $thing_to_scrape = "href";
        // $client = new Client();
        // $crawler = $client->request('GET', $urlGc);
        // $output = $crawler->filter($css_selector)->extract($thing_to_scrape);
        // // var_dump($output);
        // $urlGc = $output[0];

        $imagem = explode("=", $data['data']['output']['imagem'][$i])[0];
        if ($imagem == null)
            $imagem = "https://bhmlib.org/wp-content/themes/cosimo-pro/images/no-image-box.png";

        $fonteNot = ucfirst(strtolower($data['data']['output']['fonte'][$i]));

        if (strlen($data['data']['output']['data'][$i]) <= 5 && strpos($data['data']['output']['data'][$i], '/') !== false) {
            $ano = substr($data['data']['output']['dataTime'][$i], 0, 4);
            $mes = substr($data['data']['output']['dataTime'][$i], 5, 2);
            $dia = substr($data['data']['output']['dataTime'][$i], 8, 2);
            $dataT = $dia . '/' . $mes . '/' . $ano;
        } else
            $dataT = $data['data']['output']['data'][$i];

        array_push($arrayCleUp, array('Titulo' => $data['data']['output']['Titulo'][$i], 'imagem' => $imagem, 'link' => $urlGc, 'dataT' => $dataT, 'fonte' => $fonteNot, 'descricao' => $data['data']['output']['descricao'][$i], 'dataTime' => $data['data']['output']['dataTime'][$i]));
    }
    $gfg_array = $arrayCleUp;

    class geekSchool
    {

        var $imagem, $link, $descricao, $dataT, $fonte, $Titulo, $dataTime;

        // Constructor for class initialization 
        public function geekSchool($dataSet)
        {
            $this->imagem = $dataSet['imagem'];
            $this->link = $dataSet['link'];
            $this->descricao = $dataSet['descricao'];
            $this->dataT = $dataSet['dataT'];
            $this->fonte = $dataSet['fonte'];
            $this->Titulo = $dataSet['Titulo'];
            $this->dataTime = $dataSet['dataTime'];
        }
    }
    function data2Object($dataSet)
    {
        $class_object = new geekSchool($dataSet);
        return $class_object;
    }
    function comparator($object1, $object2)
    {
        return $object1->dataTime < $object2->dataTime;
    }
    $school_data = array_map('data2Object', $gfg_array);
    usort($school_data, 'comparator');

    return $school_data;
}


function featchDataUrl($url){
        $css_selector = "noscript a";
        $thing_to_scrape = "href";
        $client = new Client();
        $crawler = $client->request('GET', $url);
        $output = $crawler->filter($css_selector)->extract($thing_to_scrape);
        // var_dump($output);
        return $output[0];
}
