

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


if(isset($_GET['delite']) && !isset($_GET['deletado'])){
    echo '<div class="popup">
    <form class="form-input-style">
  
        <div class="input-data-field" style="background:#fff;">
        Tem certeza que deseja apagar o alerta?
        </div>
 
        <div class="input-data-field"> </div>

        <div class="button-action" style="background: #fff;">
          <a></a>
          <a href="'.$request.'&deletado=" type="submit" name="save" style="background:#fff">
        <label style="font-size:15px;">  Sim </label>
          </a>
          <a href="/clipping/alertas/" type="submit" name="save" style="background:#fff">
          <label style="font-size:15px;">  Cancelar </label>
            </a>

              <a style="background: #fff;  transform: scale(1,1) !important;"></a>
              <a style="background: #fff;  transform: scale(1,1) !important;"></a>
        </div>

    <form>
    </div> ';
}

if (isset($_GET['deletado'])) {
    // sql to delete a record
    $sql = "DELETE FROM alertas WHERE id='" .$_GET['delite'] . "' and idusuario='" . $_SESSION['email'] . "' ";
    if ($db->query($sql) === TRUE) {
      echo ' <div class="popup">
      <form class="form-input-style">
  
      <div class="input-data-field" style="background:#fff;">
        Alerta apagado com sucesso!
      </div>

      <div class="input-data-field"> </div>

      <div class="button-action" style="background: #fff;">
        <a></a>
        <a href="/clipping/alertas/" type="submit" name="save" style="background:#fff">
      <label style="font-size:15px;">  Ok </label>
        </a>
        <a href="/clipping/alertas/" type="submit" name="save" style="background:#fff; visibility:hidden;">
        <label style="font-size:15px;">  Cancelar </label>
          </a>

            <a style="background: #fff;  transform: scale(1,1) !important;"></a>
            <a style="background: #fff;  transform: scale(1,1) !important;"></a>
      </div>

  <form></div>
  ';
    } else {
      echo '
      <div class="popup">
      <form class="form-input-style">
  
      <div class="input-data-field" style="background:#fff;">
      ' . $db->error . '
      </div>

      <div class="input-data-field"> </div>

      <div class="button-action" style="background: #fff;">
        <a></a>
        <a href="'.$request.'&deletado=" type="submit" name="save" style="background:#fff">
      <label style="font-size:15px;">  Sim </label>
        </a>
        <a href="/clipping/alertas/" type="submit" name="save" style="background:#fff">
        <label style="font-size:15px;">  Cancelar </label>
          </a>

            <a style="background: #fff;  transform: scale(1,1) !important;"></a>
            <a style="background: #fff;  transform: scale(1,1) !important;"></a>
      </div>

  <form></div>
';
    }
  
    $db->close();
  }



function newAlert(){
    return '
      <div class="popup mainPop" style="display:none;">
        <form class="form-input-style" method="POST">

        <div class="input-data-field" style="background:#fff">

        <div style="background:#fff">
        Esta Ação ira criar um alerta para  <b>'.$_GET['p'].'</b>
        <a onclick="toggle(\'mainPop\')" class="close-btn"> <i class="fas fa-times-circle" class="close-btn"></i></a>
        </div>
        </div>

        
        <div class="input-data-field">
        <input name="newsList" style="border: 1px solid red !important;" data-role="tagsinput" value="'.$_GET['p'].'" />
        <div class="prefix-button">
           <i class="fas fa-bell"></i>
        </div>
       </div>

       <div class="input-data-field">
       <input name="userid" style="border: 1px solid red !important;" data-role="tagsinput" value="'.$_SESSION['email'].'" />
       <div class="prefix-button">
          <i class="fas fa-paper-plane"></i>
       </div>
      </div>
            
        <div id="more">
            <div class="input-data-field" style="border-bottom:6px solid #fff;">
            <select>
            <option value=" ">
            Em que Frequência quer Receber o Alerta...
            </option>
            <option value="00">A Cada Nova Ocorrência</option>
            <option value="12">Uma Vez Por dia</option>
            <option value="60">Uma Vez Por Semana</option>
            <option value="225">Uma vez por Mês</option>

            </select>
            <div class="prefix-button"><i class="fas fa-calendar"></i></div>
            </div>
        <div class="input-data-field" style="border-bottom:6px solid #fff;">
            <select name="n">

            <option value=" ">
            Quantos Alertas Gostaria de receber...
            </option>
            <option value="5">Apenas 5</option>
            <option value="10">Apenas 10</option>
            <option value="30">Apenas 30</option>
            <option value="">Total Encontrados</option>
            </select>
            <div class="prefix-button"><i class="fas fa-sort-numeric-down-alt"></i></div>
            
            </div>

            <div class="input-data-field">

            <input type="time" style="height:30px; padding-left:10px;" class="tempo" name="f" value="09:00" />

            <div class="prefix-button"><i class="fas fa-clock"></i></div>
            </div>
            
            </div>

        <div class="button-action" style="background: #fff;">
            <a></a>


            <button style="cursor:pointer; width:10vh;" type="submit" name="nAlerta">
            <div class="iten-button" style="padding-bottom:3px;"> <i class="fas fa-bell" ></i> </div>
            <div class="iten-button" style="font-size:10px; margin-top:-5px;">Criar Alerta</div>
            </button>
            
            <a onclick="myFunction()" style="cursor:pointer; width:10vh;">
            <div class="iten-button"> <i class="fas fa-cog"></i> </div>
            <div class="iten-button">Mais opções</div>
            </a>

            <a style="background: #fff;  transform: scale(1,1) !important;"></a>
            </div>
        </form>
        </div>
            ';
}


function sharePopup($request){
    return '
    <div class="popup" id="ShareAlert" style="display:none;">
    <form class="form-input-style" method="POST">
  
        <div class="input-data-field" style="background:#fff;">
          Partilhar
        </div>

        <div class="input-data-field">
        <input name="newsList" class="inputClipBoard"  value="https://manifexto.com'.$request.'" style="height:30px; padding-left:10px;" />
        <div class="prefix-button" onclick="CopyToclip()">
           <i class="fas fa-copy"></i>
        </div>
       </div>

       <div class="button-action" style="background: #fff;">

       <a></a>

       <a href="#"   style="height:50px; width:50px; padding-top:18px; background: rgb(7, 114, 199);">
         <label style="font-size:15px;">  <img src="https://image.flaticon.com/icons/svg/733/733547.svg" style="width:2.5vh; margin:-5px auto;"> </label>
       </a>

       <a href="#"  style="height:50px; width:50px; padding-top:18px;">
       <label style="font-size:15px;">  <img src="https://image.flaticon.com/icons/svg/174/174855.svg" style="width:2.5vh;   margin:-5px auto;"> </label>
       </a>

       <a href="mailto:'.$_SESSION['email'].'" target="_blank"  style="height:50px; width:50px; padding-top:18px; margin-left:-15px;">
       <label style="font-size:15px;">  <img src="https://image.flaticon.com/icons/svg/888/888853.svg" style="width:2.5vh;   margin:-5px auto;"> </label>
       </a>

      <a style="background: #fff;  transform: scale(1,1) !important;"></a>
      <a style="background: #fff;  transform: scale(1,1) !important;"></a>
     </div>
       

        <div class="input-data-field"> </div>

          <div class="button-action" style="background: #fff;">

            <a></a>
            <a onclick="openClose(\'ShareAlert\')" style="background:#fff">
              <label style="font-size:15px;">  OK </label>
            </a>

            <a onclick="CopyToclip()" style="background:#fff">
              <label style="font-size:15px;">  Copiar </label>
            </a>


              <a style="background: #fff;  transform: scale(1,1) !important;"></a>
              <a style="background: #fff;  transform: scale(1,1) !important;"></a>
        </div>

    <form>
    </div> 
    ';
}


if (isset($_POST['nAlerta'])) {

    $fre = $_POST['f'];

    if ($_POST['n'] != '')
        $num = $_POST['n'];
    else
        $num = 1;
    
    $newsList = $_POST['newsList'];

    $sender = $_SESSION['email'];

    $sql = "INSERT INTO alertas (alerta, idusuario, frequancia,activado,quantidade,senderId)
  VALUES ('" . $newsList . "', '" . ($_SESSION['email']) . "','" . $fre . "','','" . $num . "','" . $sender . "')";

    if ($db->query($sql) === TRUE) {
        echo '
   <div class="popup">
    <form class="form-input-style" method="POST">
  
        <div class="input-data-field" style="background:#fff;">
        Alerta Criado Com Sucesso!
        </div>
 
        <div class="input-data-field"> </div>

        <div class="button-action" style="background: #fff;">
          <a></a>
          <a href="/clipping/alertas/" type="submit" name="save" style="background:#fff">
        <label style="font-size:15px;">  OK </label>
          </a>


              <a style="background: #fff;  transform: scale(1,1) !important;"></a>
              <a style="background: #fff;  transform: scale(1,1) !important;"></a>
        </div>

    <form>
    </div> 
 
  ';
    } else {
        echo '
   
   <div class="popup">
   <form class="form-input-style" method="POST">
 
       <div class="input-data-field" style="background:#fff;">
      ' . $db->error . '
       </div>

       <div class="input-data-field"> </div>

       <div class="button-action" style="background: #fff;">
         <a></a>
         <a href="/clipping/alertas/" type="submit" name="save" style="background:#fff">
       <label style="font-size:15px;">  OK </label>
         </a>


             <a style="background: #fff;  transform: scale(1,1) !important;"></a>
             <a style="background: #fff;  transform: scale(1,1) !important;"></a>
       </div>

   <form>
   </div> 
  ';
    }

    $db->close();
}



if(isset($_GET['ident']) && !isset($_POST['save'])){

  echo '<div class="popup mainalert">
  
  <form class="form-input-style" method="POST" style=" background:#fff !important; width:100px;">
  <div class="input-data-field" style="background:#fff">
     <div style="background:#fff">';
     $sql = "SELECT * FROM alertas WHERE idusuario ='" . $_SESSION['email'] . "' and id='".$_GET['ident']."' ";
     $result = $db->query($sql);
  
     if ($result->num_rows > 0) {
       // output data of each row
       while ($row = $result->fetch_assoc()) {
         echo 'Editar Alerta <b>'.$row['alerta'].'</b>';
       }
    }
     echo'<a href="/clipping/alertas/" class="close-btn"> <i class="fas fa-times-circle" class="close-btn"></i></a>
     </div>
  </div>
  
  <div class="input-data-field" style="background:#fff"></div>';
  
    $sql = "SELECT * FROM alertas WHERE idusuario ='" . $_SESSION['email'] . "' and id='".$_GET['ident']."' ";
    $result = $db->query($sql);
  
    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
  
        echo '
        <div class="input-data-field">
        <input name="alerta"  data-role="tagsinput" value="'.$row['alerta'].'" />
        <div class="prefix-button">
           <i class="fas fa-bell"></i>
        </div>
       </div>
     
     <div class="input-data-field">
        <input name="userid"  data-role="tagsinput" value="'.$row['senderId'].','.$row['idusuario'].'" />
        <div class="prefix-button">
           <i class="fas fa-paper-plane"></i>
        </div>
     </div>';
        
  
    echo '
    <div id="moreb" style="display:none;">
        <div class="input-data-field" style="border-bottom:6px solid #fff;">
        <select name="f">
        <option value=" ">
        Em que Frequência quer Receber o Alerta...
        </option>
        <option value="00">A Cada Nova Ocorrência</option>
        <option value="12">Uma Vez Por dia</option>
        <option value="60">Uma Vez Por Semana</option>
        <option value="225">Uma vez por Mês</option>
  
        </select>
        <div class="prefix-button"><i class="fas fa-calendar"></i></div>
        </div>';
  
    echo '
    <div class="input-data-field" style="border-bottom:6px solid #fff;">
        <select name="n">
  
        <option value=" ">
        Quantos Alertas Gostaria de receber...
        </option>
        <option value="5">Apenas 5</option>
        <option value="10">Apenas 10</option>
        <option value="30">Apenas 30</option>
        <option value="">Total Encontrados</option>
        </select>
        <div class="prefix-button"><i class="fas fa-sort-numeric-down-alt"></i></div>
        
        </div>';
        echo '
        <div class="input-data-field">
  
        <input type="time" style="height:30px; padding-left:10px;" class="tempo" name="tempo" value="09:00" />
  
        <div class="prefix-button"><i class="fas fa-clock"></i></div>
        </div>
        
        </div>';
  
    echo '
    <div class="button-action" style="background: #fff;">
        <a></a>
        <button type="submit" name="save">
        <div class="iten-button"> <i class="fas fa-save"></i> </div>
        <div class="iten-button">Guardar</div>
        </button>
  
        <a href="/clipping/alertas/?delite='.$row['id'].'">
        <div class="iten-button"> <i class="fas fa-trash"></i> </div>
        <div class="iten-button">Apagar alerta</div>
        </a>
  
        <a onclick="myFunction()" style="cursor:pointer;">
        <div class="iten-button"> <i class="fas fa-cog"></i> </div>
        <div class="iten-button">Mais opções</div>
        </a>
        <a style="background: #fff;  transform: scale(1,1) !important;"></a>
        </div>
    </form>
    </div>';
     }
    } 
    $db->close();
  }
  








