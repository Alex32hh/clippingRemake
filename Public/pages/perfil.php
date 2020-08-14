

     <form method="POST">
    <div class="login-main-page">
        <div class="login-content-page">
            <div>
                <img src="https://manifexto.com/clipping/images/mobileIc.png" class="App-logo" />
            </div>
            <div>Detalhes da sua Conta</div>

            <?php
                  $sql = "SELECT * FROM assinantes WHERE Email ='" . $_SESSION['email'] . "' ";
                  $result = $db->query($sql);

                  if ($result->num_rows > 0) {
                    // output data of each row
                    while ($row = $result->fetch_assoc()) {
                    echo '
                    <div><input type="text" name="email" value="'.$row["Pnome"].' '.$row["Unome"].'" class="inputBox-email" disabled  style="border:none;background:none; border-bottom:1px solid #444;" /></div>';
                    }
                }
                        ?>
          
            <div><input disabled type="text" value="<?php echo $_SESSION['email'];?>" name="password" placeholder="Senha" class="inputBox-senha" style="border:none;background:none; border-bottom:1px solid #444;" /></div>
            <div>

                <button type="submit" name="sair">
                    Sair
                </button>

            </div>
            <div>
                <label style="float:left;  font-size:14px; padding:12px;"><a href="https://manifexto.com/" style="text-decoration: none; color:#444;">Notícias</a></label>
                <label style="float:right;  font-size:14px; padding:12px;"><a href="/clipping/" style="text-decoration: none; color:#444;">Voltar</a></label>
            </div>

        </div>
        <br>
        <label class="login-danger"></label>
        <br>
        <br>
        <label><a class="link-hover-manifexto" href=" https://simpluz.com/" style="text-decoration:none;">©
                Simpluz
                Tecnologias.</a></label>
    </div>
</form>

<?PHP


if(isset($_POST['sair'])){

    session_destroy();
    echo "
    <script>
        window.location.href = '/clipping/';
    </script>
    ";
}

?>


