<div class='container'>
     <div href="#" class='content-title'><a href="/clipping/" class="normalLink">Clipping > <?php echo explode('/',$request)[2];?></a></div>

<?php
    $sql = "SELECT * FROM alertas WHERE idusuario ='" . $_SESSION['email'] . "' ";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
    ?>
     <div class="list-alerts">
        <div>
            <b><?php echo $row['alerta'];?></b>
        </div>

        <div class="btn-list">
          <?php
                  $sqlite = "SELECT * FROM trakingNews WHERE idusuario ='" . $_SESSION['email'] . "' and idpesquisa ='" . $row['alerta'] . "' ";
                  $dt = $db->query($sqlite);
                  if ($dt->num_rows > 1) {
                      echo ' <a href="/clipping/dashboard/?cp='.$row["alerta"].'" class="icon-alert-list">
                      <div class="ic-bck" style="background: url(\'https://image.flaticon.com/icons/svg/886/886170.svg\');"></div>
                          <div>Dashboard</div>
                      </a>';
                  }else{
                    echo ' <a class="icon-alert-list">
                    <div class="ic-bck" style="background: url(\'https://image.flaticon.com/icons/svg/886/886170.svg\'); opacity:.5;"></div>
                        <div>Dashboard</div>
                    </a>';
                  }
          ?>
       
        <a href="/clipping/alertas/?delite=<?php echo $row['id'];?>" class="icon-alert-list">
        <div class="ic-bck" style="background: url('https://image.flaticon.com/icons/svg/1214/1214428.svg');"></div>
            <div>Remover</div>
        </a>

        <a href="/clipping/editar/?ident=<?php echo $row['id'];?>" class="icon-alert-list">
        <div class="ic-bck" style="background: url('https://image.flaticon.com/icons/svg/860/860814.svg');"></div>
            <div>Editar</div>
        </a>

       

        </div>
     </div>

<?php
          }
        } else {
            echo "<em>Sem alertas Criados</em>";
        }
    
        $db->close();

      
?>
     
    
</div>

<script>
    function myFunction() {
    alert('sfdf');
  var x = document.getElementById("#more");
  if (x.style.display === "none") {
    x.style.display = "block";
  } else {
    x.style.display = "none";
  }
}
    </script>