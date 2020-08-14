<div class='main-login-Page'>
    <div class='top-item'>
        <div></div>

        <div>

            <div class='alerta-icon'>
               <a href="/clipping/alertas/" style="width:30px; text-decoration:none;">
                    <img src='images/bell.png' />
                    <label class='link-hover-manifexto'>Alertas</label>
                </a>
            </div>

            <div class='perfil-icon'>
                <a href="/clipping/perfil/" style="width:30px; text-decoration:none;">
                    <img src='images/user.png' />
                    <label class='link-hover-manifexto'>Perfil</label>
                </a>
            </div>

        </div>

    </div>

    <div class='center-intem'>

        <div>
            <img src='cron-jobs/img/manilogo.png' />
        </div>


        <div class='center-input-box'>

            <div></div>
            <form class='form-list' action="/clipping/result/">
                <div><button type="submit"> <img src='images/search.png' /> </button></div>
                <div><input required type="text" placeholder="Pesquisar..." name="p" ref={register({ required: true })} />
                </div>
            </form>
            <div></div>

        </div>


    </div>


</div>