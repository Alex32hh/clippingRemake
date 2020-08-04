<form action="/clippinRemake/result/">
<header>
    <div class='topBar'>
        <div class="barcontent">

            <div class='leftside'>
                <a class="link-hover-manifexto" href="https://manifexto.com/about-us">
                    <item>Sobre nós</item>
                </a>
                <a class="link-hover-manifexto" href="https://manifexto.com/editors">
                    <item>Jornalistas</item>
                </a>
                <a class="link-hover-manifexto" href="https://manifexto.com/advertising">
                    <item>Publicidade</item>
                </a>
            </div>

            <div class='rightside'>
                <a href="1">
                    <item><img src='../images/whatsapp.png' /></item>
                </a>
                <a href="2">
                    <item><img src='../images/youtube.png' /></item>
                </a>
                <a href="3">
                    <item><img src='../images/facebook.png' /></item>
                </a>
                <a href="4">
                    <item><img src='../images/instagram.png' /></item>
                </a>
            </div>

        </div>

    </div>

    <nav>
        <div class='divide'>
            <div class='image-logo'></div>
        </div>

        <div class='divide'>

            <div class='center-box'>

                <div class='center-top'>

                    <div></div>

                    <div>
                        <button type="submit">
                           
                        </button>
                    </div>

                    <div>
                        <input type='text' name="p" placeholder="Pesquisar..."  value="<?php echo $_GET['p'];?>" />
                    </div>

                    <div></div>
                </div>

                <div class='center-bottom'>
                    <div></div>

                    <div class='catego-items'>
                        <a>
                            <div class='link-hover-manifexto'><img style="position: relative; top:3px;"
                                    src='../images/plus.png' /> Criar Alerta</div>
                        </a>
                        <a>
                            <div class='link-hover-manifexto'><img style="position: relative; top:3px;"
                                    src='../images/plus.png' /> Opções</div>
                        </a>
                        <a>
                            <div class='link-hover-manifexto'><img style="position: relative; top:3px;"
                                    src='../images/plus.png' /> Partilhar</div>
                        </a>
                        <a>
                            <div class='link-hover-manifexto'><img style="position: relative; top:3px;"
                                    src='../images/plus.png' /> Imprimir</div>
                        </a>
                    </div>

                    <div></div>
                </div>

            </div>

        </div>

        <div class='divide'>
            <div class='images-items'>


                <div class='btn-alertas'>
                    <a to='/alertas'>
                        <img src='../images/bell.png' />
                        <label>Alertas</label>
                    </a>
                </div>


                <div class='btn-conta'>
                    <a to='/perfil'>
                        <img src='../images/user.png' />
                        <label style="padding-left: 3px;"> Perfil</label>
                    </a>
                </div>


            </div>
        </div>
    </nav>
</header>
    </form>