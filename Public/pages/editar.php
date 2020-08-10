<div class='container'>
     <div href="#" class='content-title'><a href="/clipping/" class="normalLink">Clipping > <?php echo explode('/',$request)[2];?></a></div>
     
  <form class="form-input-style">

<?php
    $sql = "SELECT * FROM alertas WHERE idusuario ='" . $_SESSION['email'] . "' and id='".$_GET['ident']."' ";
    $result = $db->query($sql);

    if ($result->num_rows > 0) {
      // output data of each row
      while ($row = $result->fetch_assoc()) {
    ?>

  <div class="input-data-field">
     <input name="emaiil" style="border: 1px solid red !important;" data-role="tagsinput" value="<?php echo $row['alerta'];?>" />
     <div class="prefix-button">
        <i class="fas fa-bell"></i>
     </div>
  </div>
  
  <div class="input-data-field">
     <input name="emaiil" style="border: 1px solid red !important;" data-role="tagsinput" value="<?php echo $row['senderId'].','.$row['idusuario'];?>" />
     <div class="prefix-button">
        <i class="fas fa-at"></i>
     </div>
  </div>
  
<?php
          }
        } 
        $db->close();

?>   
  </form>

  <div class="button-action">
  <a></a>
    <a href="#">
      <div class="iten-button"> <i class="fas fa-save"></i> </div>
      <div class="iten-button">Guardar</div>
    </a>

    <a href="#">
      <div class="iten-button"> <i class="fas fa-trash"></i> </div>
      <div class="iten-button">Apagar alerta</div>
    </a>

    <a href="#">
      <div class="iten-button"> <i class="fas fa-cog"></i> </div>
      <div class="iten-button">Mais opções</div>
    </a>
    <a style="background: #fff;  transform: scale(1,1) !important;"></a>
    
</form>