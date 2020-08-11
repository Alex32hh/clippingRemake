<script>

var itens = document.querySelectorAll("#more");
var soma = 0;

for (i =soma ; i < lastCont; i++)
   itens[i].toggle();

function myFunction() {
  $('#moreb').toggle();
 }


 </script>

<div class='container'>
     <div href="#" class='content-title'><a href="/clipping/" class="normalLink">Clipping > <?php echo explode('/',$request)[2];?></a></div>
  

     <?php
     
     
     
if (isset($_POST['save'])) {

  $sql = "UPDATE alertas SET senderId='".$_POST['userid']."',alerta ='".$_POST['alerta']."',frequancia ='".($_POST['tempo']== null?$_POST['f']:$_POST['tempo'])."',quantidade='".$_POST['n']."' WHERE id='".$_GET['ident']."' and idusuario = '" . $_SESSION['email'] . "'";
  if ($db->query($sql) === TRUE){
    echo '<div class="popup">
    <form class="form-input-style" method="POST">
  
        <div class="input-data-field" style="background:#fff;">
         Alerta Atualizado!
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
    echo "Error updating record: " . $db->error;
  }

  $db->close();
}


     
     ?>
  
</div>