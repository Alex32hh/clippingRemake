<?php
  
  //label da semana

  if (date('D') == 'Sun') {
    $lsTimestamp = time();
  } else {
    $lsTimestamp = strtotime('last Sunday');
  }
  
  $dates = [date('Y-m-d', $lsTimestamp)];
  for ($i = 1; $i <= 6; $i++) {
    $dates[] = date('Y-m-d', strtotime('+' . $i . ' day', $lsTimestamp));
  }
  

  $diasData = array();
  $dias_M_Data = array();
  $result = $db->query("SELECT * FROM trakingNews  WHERE idusuario='" . $_SESSION['email'] . "' and idpesquisa ='" . $_GET['cp'] . "' ");
  //divide calculas as labels do charts
  if ($result->num_rows > 0) {while ($row = $result->fetch_assoc()) {
      $dat = explode(' ',$row['data']);
      array_push($diasData,$dat[0]);
      
      if(explode('-',$dat[0])[1] == date('m'))
      $data_Day = explode('-',$dat[0])[2];

      array_push($dias_M_Data,$data_Day);
    }
  }




  $semanaPt = array('Sun' => 'Domingo', 'Mon' => 'Segunda-Feira', 'Tue' => 'Terca-Feira', 'Wed' => 'Quarta-Feira', 'Thu' => 'Quinta-Feira', 'Fri' => 'Sexta-Feira', 'Sat' => 'Sábado');

  $meses = array('Jan' => 'Janeiro','Feb'=>'Fevereiro','Mar'=>'Março','Apr'=>'Abril','May'=>'Maio','Jun'=>'Junho','Jul'=>'Julho','Aug'=>'Agosto','Sep'=>'Setembro','Oct'=>'Outubro','Nov'=>'Novembro','Dec'=>'Dezembro');

  $days_mont = array();
  $days_mont_data = array();
  
  for($a=1;$a < date('t')+1;$a++){
   array_push($days_mont,$meses["".date('M').""][0].$meses["".date('M').""][1].$meses["".date('M').""][2].'-'.str_pad($a, 2, '0', STR_PAD_LEFT));
   
   $id = str_pad($a, 2, '0', STR_PAD_LEFT);

   array_push($days_mont_data,count_array_values($dias_M_Data,$id));
   //  count_array_values

  }
  


  $cleanDoble = array();
  $diasNum = array();
  foreach ($dates as $a) {
    // $semanaPt["$nameOfDay"]
    $nameOfDay = date('D', strtotime($a));
    array_push($cleanDoble, $semanaPt["$nameOfDay"]);

    array_push($diasNum,count_array_values($diasData,$a));
  }
  
  function count_array_values($my_array, $match) { 
    $count = 0; 
    foreach ($my_array as $key => $value) 
    { 
        if ($value == $match){$count++;} 
    } 
    
    return $count; 
  } 

 
  
  //dados mensais
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



<div class='container'>
     <div href="#" class='content-title'><a href="/clipping/" class="normalLink">Clipping > <?php echo explode('/',$request)[2];?></a></div>

     <div class="list-alerts">
        <div>
            <b>Período</b>
        </div>

        <div class="btn-list">
          
        <a onclick="mesesgGET()" class="icon-alert-list" style="cursor: pointer;">
        <div class="ic-bck" style="background: url('https://image.flaticon.com/icons/svg/1584/1584813.svg');"></div>
            <div>Mes</div>
        </a>

        <a onclick="diaGET()" class="icon-alert-list" style="cursor: pointer;">
        <div class="ic-bck" style="background: url('https://image.flaticon.com/icons/svg/942/942810.svg');"></div>
            <div>Semana</div>
        </a>

        <a onclick="semanagGET()"  class="icon-alert-list" style="cursor: pointer;">
        <div class="ic-bck" style="background: url('https://image.flaticon.com/icons/svg/747/747310.svg');"></div>
            <div>Dia</div>
        </a>
        </div>
     </div>
     
     <div class="chart-container">
      
     <canvas id="startCharts"></canvas>
     <canvas id="charts-Week" style="display: none;"></canvas>
     <canvas id="charts-day"  style="display: none;"></canvas>

     <br>
     <strong style="padding-left: 10px;">Distrbuição</strong>
     <p style="text-align: justify; visibility:hidden;">Em relação à análise dos valores absolutos, o suporte que atingiu mais visibilidade, foi <strong style="color:rgb(134,208,143);"><?php echo array_key_max_value($countArray); ?></strong>.A publicação que atingiu um maior número de Posts foi o
    <strong style="color:rgb(134,208,143);"><?php echo array_key_max_value($countArray); ?> </strong> com   <?php
            echo  $countArray[array_key_max_value($countArray)];
            ?></strong> postagens.</p>
      
      <canvas id="pieChart"></canvas>

     </div>

</div>


<script>
  //Labes 
  var MeseArray = (<?php  echo json_encode($meses);?>);
  var SemanaArray = (<?php  echo json_encode($dias_da_semana);?>);

  var diasLabelArray = (<?php  echo json_encode($cleanDoble);?>);

  //datas
  var diasTotal = (<?php  echo json_encode($diasNum);?>);
  

  var current_Day = (<?php  echo json_encode([count_array_values($dias_M_Data,date('d'))]);?>);
  var current_Day_name = (<?php  echo json_encode([$semanaPt["".date('D').""]]);?>);


  var MesesTotal = (<?php  echo json_encode($days_mont);?>);
  var MesesData = (<?php  echo json_encode($days_mont_data);?>);
  
  //outro charts
  var datapie = <?php echo count($dataArray) > 0 ? json_encode($dataArray) : ['0','0']; ?>;
  var labelPie =<?php echo count($labelArray) > 0 ? json_encode($labelArray) : ['indesponivel','indesponivel']; ?>;
  
  var Bgcolor = ['rgb(134, 208, 142)','rgb(188, 39, 14)','rgb(255, 206, 86)','rgb(65, 119,203)','rgb(131, 171, 197)','rgb(255, 159, 64)','rgb(200, 0, 142)','rgb(288, 100, 100)','rgb(20, 106, 86)','rgb(65, 219,203)','rgb(222, 271, 197)','rgb(155, 159, 64)','rgb(134, 108, 142)','rgb(288, 38, 94)','rgb(155, 60, 86)','rgb(100, 116,203)','rgb(121, 171, 97)','rgb(255, 159, 64)','rgb(100, 60, 142)','rgb(288,0, 200)','rgb(80, 226, 106)','rgb(65, 19,103)','rgb(000,71, 197)','rgb(5, 39, 44)','rgb(80, 126, 106)','rgb(10, 226, 206)','rgb(180, 206,6)'];
  
  var bg = 'rgb(134, 208, 142)';
  var border = ['rgb(131, 171, 197)'];

  var bg1 = 'rgb(255, 206, 86)';
  var border1 = 'rgb(65, 119,203)';

  var bg2 = 'rgb(288, 100, 100)';
  var border2 = 'rgb(20, 106, 86)';
  


  function mesesgGET () {
     $("#startCharts").show();
     $("#charts-Week").hide();
     $("#charts-day").hide();
  }

  function semanagGET () {
     $("#startCharts").hide();
     $("#charts-Week").hide();
     $("#charts-day").show();
  }

  function diaGET () {
     $("#startCharts").hide();
     $("#charts-Week").show();
     $("#charts-day").hide();
  }


</script>
