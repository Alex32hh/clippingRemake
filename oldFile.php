<div class='container'>
     <div href="#" class='content-title'><a href="/clipping/" class="normalLink">Clipping > <?php echo explode('/',$request)[2];?></a></div>

     <!-- ordenar o ultimo decresente -->
<?php
$meses = array('Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro');

$semanaPt = array('Sun' => 'Domingo', 'Mon' => 'Segunda-Feira', 'Tue' => 'Terca-Feira', 'Wed' => 'Quarta-Feira', 'Thu' => 'Quinta-Feira', 'Fri' => 'Sexta-Feira', 'Sat' => 'Sábado');

$diasRepetidos = array();
$diasNum = array();

$dias_da_semana = array();
$sql = "SELECT * FROM trakingNews  WHERE idusuario='" . $_SESSION['email'] . "' and idpesquisa ='" . $_GET['cp'] . "' ";
$result = $db->query($sql);
// echo $result->num_rows; 
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    $date = explode(' ', $row['data'])[0];
    $nameOfDay = date('D', strtotime($date));
    array_push($diasRepetidos, $semanaPt["$nameOfDay"]);

    if (!in_array($semanaPt["$nameOfDay"], $dias_da_semana))
      array_push($dias_da_semana, $semanaPt["$nameOfDay"]);
  }
} else
  array_push($dadosMensal, 0);

//remove os sinal de egual no array

foreach (array_count_values($diasRepetidos) as $a) array_push($diasNum, $a);
// var_dump($diasNum);


  $arrayCleUp =  array();
  $ek = "SELECT * FROM trakingNews WHERE idusuario='".$_SESSION['email']."' and  idpesquisa='".$_GET['cp']."' ORDER BY id desc ";
  $rpl = $db->query($ek);
  if ($rpl->num_rows > 0) {
    while ($rows = $rpl->fetch_assoc()) {
      //  echo $rows['fonte'].'-'. $rows['num'].'<br>';
      array_push($arrayCleUp, $rows['fonte']);
    }
  }
// var_dump(
//   $arrayCleUp
// );


$arrayChars = array();
$sql = "SELECT * FROM trakingNews WHERE idusuario ='" . $_SESSION['email'] . "' ORDER BY id desc ";
$result = $db->query($sql);
if ($result->num_rows > 0) {
  while ($row = $result->fetch_assoc()) {
    if ($row['idpesquisa'] == ($_GET['cp'])) {
      //  echo $row['idpesquisa'].'<->'.$_GET['cp'].'<br>';
      array_push($arrayChars, $row['fonte']);
    }
  }
}
$countArray = array_count_values($arrayChars);


function array_key_max_value($array)
{
  $max = null;
  $result = null;
  foreach ($array as $key => $value) {
    if ($max === null || $value > $max) {
      $result = $key;
      $max = $value;
    }
  }
  return $result;
}

$labelArray = array();
foreach( array_unique($arrayChars) as $item){
  array_push($labelArray,$item);
}

$dataArray = array();


foreach ($countArray as $f) {
  array_push($dataArray, $f);
}
$total = array_sum($dataArray);
$dadosMensal = array();

// var_dump($dataArray);

for ($i = 1; $i < (date('m') + 1); $i++) {

  $sql = "SELECT * FROM trakingNews WHERE mes ='" . str_pad($i, 2, '0', STR_PAD_LEFT) . "' and idpesquisa ='" . $_GET['cp'] . "' ";
  $result = $db->query($sql);
  // echo $result->num_rows; 
  if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
      if ($row['idusuario'] == $_SESSION['email']) {
        // echo $result->num_rows;
        array_push($dadosMensal, $total);
        break;
      }
    }
  } else
    array_push($dadosMensal, 0);
}
?>

        <div class="chart-container opn1">
            <canvas id="myChart"></canvas>
        </div>


        <div class="chart-container opn2" style="display: none;">
            <canvas id="semana"></canvas>
        </div>


        <br><br><br><br>
        <div class="row m-auto">
            <div class="col">
                <strong>Destrbuição</strong>
                <p style="text-align: justify;">Em relação à análise dos valores absolutos, o suporte que atingiu
                    mais visibilidade, foi
                    <strong style="color:rgb(134,208,143);"><?php echo array_key_max_value($countArray); ?> </strong>.
                    A publicação que atingiu um maior número de Posts foi o
                    <strong style="color:rgb(134,208,143);"><?php echo array_key_max_value($countArray); ?> </strong>
                    com <strong style="color:rgb(134,208,143);">
                        <?php
            // echo $dataArray[array_search(array_key_max_value($countArray), array_keys($dataArray))][0];
            echo  $countArray[array_key_max_value($countArray)];
            ?></strong> postagens.</p>
            </div>
        </div>
        <div class="chart-container">
            <canvas id="donout"></canvas>
        </div>


        <br><br><br><br>
        <div class="col">
            <!-- <p style="text-align: justify;">Os agregadores são programas que organizam as informações que são vistas de forma final pelo usuário. Tais programas são receptores de RSS Feed, uma tecnologia que permite a distribuição/recebimento de conteúdo sem a necessidade de acessar um website para poder recebê-lo.</p>
    </div> -->
        </div>
        <div class="row m-auto">
            <div class="col">
                <strong>Editores</strong>
                <?php $colors = array('rgb(134, 208, 142)','rgb(188, 39, 14)','rgb(255, 206, 86)','rgb(65, 119,203)','rgb(131, 171, 197)','rgb(255, 159, 64)','rgb(200, 0, 142)','rgb(288, 100, 100)','rgb(20, 106, 86)','rgb(65, 219,203)','rgb(222, 271, 197)','rgb(155, 159, 64)','rgb(134, 108, 142)','rgb(288, 38, 94)','rgb(155, 60, 86)','rgb(100, 116,203)','rgb(121, 171, 97)','rgb(255, 159, 64)','rgb(100, 60, 142)','rgb(288,0, 200)','rgb(80, 226, 106)','rgb(65, 19,103)','rgb(000,71, 197)','rgb(5, 39, 44)'
        );

        function cmp($a, $b)
        {
          if ($a == $b) {
            return 0;
          }
          return ($a > $b) ? -1 : 1;
        }

        usort($countArray, "cmp");

        for ($a = 0; $a <  count($arrayCleUp); $a++) {

          if ($countArray[$a]> 0) {
            echo ' <div class="progress mt-2">
        <div style="float:right; position:absolute; color:#000;">' .$labelArray[$a]. ' - ' . $countArray[$a] . '%</div>
        <div class="progress-bar progress-bar-animated bg-success" role="progressbar" style="width:' . ($countArray[$a]) . '%;Background:' . $colors[$a] . ' !important;" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100"></div>
        </div>';
          }
        }

        ?>
            </div>
        </div>
    </div>

    </div>
    <br><br>
    <div data-v-a035f31a="" class="pt-5 m-auto w-100 text-center">
        <a data-v-a035f31a="" href="https://simpluz.com" class="link-footer text-muted">
            <small data-v-a035f31a="">© Simpluz Tecnologias.</small></a>
    </div>
    <br>
</body>

<?php
if (isset($_POST['saveInfo'])) {

  $send = "INSERT INTO campanha (titulo, tag1, tag2,tag3,tag4,idEmail,activado,frequencia)
  VALUES ('" . ($_POST['campanhaNome']) . "','" . ($_POST['tag1']) . "','" . ($_POST['tag2']) . "','" . ($_POST['tag3']) . "','" . ($_POST['tag4']) . "','" . ($_SESSION['email']) . "','','8:00')";

  if ($db->query($send) === TRUE) {
    echo '<!-- Edicao do alerta -->
    <div class="coverAll" style="display: block;">
    <div class="card  shadow mb-2 m-auto popup popup-2">
    <div class="row card-body pb-0 pt-2 pr-0 pl-5">
    
     <span class="row" style="font-size:14px">AVISO</span>
     <div class="pt-5 pl-2"> Campanha criada com sucesso! </div>
    <a href="' . $request . '"> <div class="text-grenn-manifexto pt-5 mt-5 mb-3" style="font-size: 18px;"> OK</div></a>
    </div>
    </div>
    </div>';
  } else {
    echo "Error: " . $sql . "<br>" . $db->error;
  }
}
if (isset($_POST['nAlerta'])) {

  if ($_GET['f'] != '')
    $fre = $_GET['f'];
  else
    $fre = '12s';

  if ($_GET['n'] != '')
    $num = $_GET['n'];
  else
    $num = 1;


  $sql = "INSERT INTO alertas (alerta, idusuario, frequancia,activado,quantidade,activado)
      VALUES ('" . $_GET['p'] . "', '" . ($_SESSION['email']) . "','" . $fre . "','','" . $num . "','')";

  if ($db->query($sql) === TRUE) {
    echo '<div class="coverAll" style="display: block;">
      <!-- Alerta criado com sucesso -->
      <div class="card  shadow mb-2 m-auto popup" >
      <div class="row card-body pb-0 pt-2 pr-0 pl-5">
      
      <span class="row" style="font-size:14px">AVISO</span>
      <div class="pt-5 pl-2"> Alerta criado com sucesso! </div>
      <a href="/clipping/alertas/"><div class="text-grenn-manifexto pt-5 mt-5 mb-3" style="font-size: 18px;"> OK</div></a>
      
        </div>
      
      </div>
      
      </div>
      ';
  } else {
    echo '<div class="coverAll" style="display: block;">
      <!-- Alerta criado com sucesso -->
      <div class="card  shadow mb-2 m-auto popup" >
      <div class="row card-body pb-0 pt-2 pr-0 pl-5">
      
      <span class="row" style="font-size:14px">AVISO</span>
      <div class="pt-5 pl-2"> Erro ao  criar o Alerta!' . $sql . ', ' . $db->error . '</div>
      <a href="/clipping/"><div class="text-grenn-manifexto pt-5 mt-5 mb-3" style="font-size: 18px;"> OK</div></a>
      
        </div>
      </div>
      
      </div>
      ';
  }

  $db->close();
}
?>


<script>
var options = {
    maintainAspectRatio: false,
    scales: {
        yAxes: [{
            stacked: true,
            gridLines: {
                display: true,
                color: "rgb(134, 208, 142)"
            }
        }],
        xAxes: [{
            gridLines: {
                display: true,
                color: "rgb(134, 208, 142)"
            }
        }]
    }
};


var ctx = document.getElementById('myChart').getContext('2d');
var meses = <?php echo count(array_slice($meses, 0, date('m'))) > 0 ? json_encode(array_slice($meses, 0, date('m'))) :'0'; ?>;
var dadaMonth = <?php echo count($dadosMensal) > 0 ? json_encode($dadosMensal) : '0'; ?> ;


var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'line',
        // The data for our dataset
        data: {
            labels: meses,
            datasets: [{
                label: 'Número de Artigos Por Ano',
                backgroundColor: 'rgb(134, 208, 142)',
                borderColor: 'rgb(100, 100, 192)',
                data: dadaMonth
            }]
        },

        // Configuration options go here
        options: options
    }

);
</script>


<script>
var js_array = <?php echo count($dataArray) > 0 ? json_encode($dataArray) : ['0','0']; ?>;
var php_var = <?php echo count($labelArray) > 0 ? json_encode($labelArray) : ['indesponivel','indesponivel']; ?>;
var dounut = document.getElementById('donout').getContext('2d');
// And for a doughnut chartao definid

var myDoughnutChart = new Chart(dounut, {

    type: 'doughnut',
    data: {
        labels: php_var,
        datasets: [{
            label: '# of Votes',
            data: js_array.length <= 0 ? ['0'] : js_array,
            backgroundColor: ['rgb(134, 208, 142)','rgb(188, 39, 14)','rgb(255, 206, 86)','rgb(65, 119,203)','rgb(131, 171, 197)','rgb(255, 159, 64)','rgb(200, 0, 142)','rgb(288, 100, 100)','rgb(20, 106, 86)','rgb(65, 219,203)','rgb(222, 271, 197)','rgb(155, 159, 64)','rgb(134, 108, 142)','rgb(288, 38, 94)','rgb(155, 60, 86)','rgb(100, 116,203)','rgb(121, 171, 97)','rgb(255, 159, 64)','rgb(100, 60, 142)','rgb(288,0, 200)','rgb(80, 226, 106)','rgb(65, 19,103)','rgb(000,71, 197)','rgb(5, 39, 44)'
            ],

        }]
    },
    options: {
        maintainAspectRatio: false,
    }
});
</script>



<script>

  var semana = <?php echo count(($dias_da_semana)) > 0 ? json_encode(($dias_da_semana)) : 'indesponivel'; ?>;
  var diasNum = <?php echo count(($diasNum)) > 0 ? json_encode(($diasNum)) : 'indesponivel'; ?> ;

  var data = {
      labels: semana,
      datasets: [{
          label: "Número de Artigos Por Semana",
          backgroundColor: [
              'rgb(134, 208, 142)',
              'rgb(188, 39, 14)',
              'rgb(255, 206, 86)',
              'rgb(65, 119,203)',
              'rgb(131, 171, 197)',
              'rgb(255, 159, 64)',
              'rgb(200, 0, 142)',
              'rgb(288, 100, 100)',
              'rgb(20, 106, 86)',
              'rgb(65, 219,203)',
              'rgb(222, 271, 197)',
              'rgb(155, 159, 64)',
              'rgb(134, 108, 142)',
              'rgb(288, 38, 94)',
              'rgb(155, 60, 86)',
              'rgb(100, 116,203)',
              'rgb(121, 171, 97)',
              'rgb(255, 159, 64)',
              'rgb(100, 60, 142)',
              'rgb(288,0, 200)',
              'rgb(80, 226, 106)',
              'rgb(65, 19,103)',
              'rgb(000,71, 197)',
              'rgb(5, 39, 44)'
          ],
          borderColor: 'rgb(134, 208, 142)',
          borderWidth: 2,
          hoverBackgroundColor: 'rgb(80, 226, 106)',
          hoverBorderColor: "rgba(255,99,132,1)",
          data: diasNum,
      }]
  };

  var options = {
      maintainAspectRatio: false,
      scales: {
          yAxes: [{
              stacked: true,
              gridLines: {
                  display: true,
                  color: "rgba(255,99,132,0.2)"
              }
          }],
          xAxes: [{
              gridLines: {
                  display: false
              }
          }]
      }
  };

  Chart.Bar('semana', {
      options: options,
      data: data
  });
</script>


<script>
//ppainel de alerta ou
function openclose(nome, othename) {
    $("." + nome).css('display', 'block');
    $("." + nome).css('color', '#00B28D !important');

    $("." + othename).css('display', 'none');
    $("." + othename).css('color', '#000 !important');
}
</script>

</html>


    
</div>