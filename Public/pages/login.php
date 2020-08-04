<form method="POST">
    <div class="login-main-page">
        <div class="login-content-page">
            <div>
                <img src="../images/mobileIc.png" class="App-logo" />
            </div>
            <div>Entre na sua conta Manifexto Clipping</div>
            <div><input type="text" name="email" placeholder="Email" class="inputBox-email" /></div>
            <div><input type="password" name="password" placeholder="Senha" class="inputBox-senha" /></div>
            <div>

                <button type="submit">
                    Entrar
                </button>

            </div>
            <div>
                <label style="float:left;  font-size:14px; padding:12px;">Esqueceu a senha?</label>
                <label style="float:right; font-size:14px; padding:12px;">Voltar</label>
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
</form> <?php include "src/server.php"; ?>