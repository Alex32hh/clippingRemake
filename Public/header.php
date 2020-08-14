<form action="/clipping/result/">
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
                <a href="https://ow.ly/aPZ130oH6mx">
                    <item><img src='../images/whatsapp.png' /></item>
                </a>
                <a href="https://youtube.com/c/Manifexto">
                    <item><img src='../images/youtube.png' /></item>
                </a>
                <a href="https://facebook.com/manifexto">
                    <item><img src='../images/facebook.png' /></item>
                </a>
                <a href="https://twitter.com/manifexto">
                    <item><img src='../images/instagram.png' /></item>
                </a>
            </div>

        </div>

    </div>

    <nav>
        <div class='divide' onclick="goto('/clipping/')">
            <div class='image-logo' >
             <a href="/clipping/" style="width: 90%; float:left; height:50px;"></a>
            </div>
        </div>

        <div class='divide'>

            <div class='center-box'>

                <div class='center-top'>
                    <div></div>

                    <div><button type="submit"></button></div>
                    <div>
                        <input required type='text' name="p" placeholder="Pesquisar..."  value="<?php 
                        if(isset($_GET['req']))
                        echo 'Redirecionando...';
                        else
                          echo $_GET['p'];
                        ?>" />
                    </div>

                    <div class="icon-center">
                        <a onclick="toggle('mainPop')">
                            <div class="icon-ic" style="background-image: url('../images/plus.png');"></div>
                            <div class="icon-let">
                            criar alerta
                            </div>
                        </a>
                    </div>
                    
                    <div class="icon-center">
                    <a onclick="openClose('ShareAlert')">
                            <div class="icon-ic" style="background-image: url('../images/share.png');"></div>
                            <div class="icon-let">
                            Partilhar
                            </div>
                    </a>
                    </div>

                    <div class="icon-center">
                        <a onclick="printContent('container')" style="border-radius:0px 4px 4px 0px;">
                            <div class="icon-ic" style="background-image: url('../images/print.png');"></div>
                            <div class="icon-let">
                            Imprimir
                            </div>
                        </a>
                    </div>
                    
                    
                </div>

            

            </div>

        </div>

        <div class='divide'>
            <div class='images-items'>


                <div class='btn-alertas'>
                    <a href='/clipping/alertas/'>
                        <img src='../images/bell.png' />
                        <label>Alertas</label>
                    </a>
                </div>


                <div class='btn-conta'>
                    <a href='/clipping/perfil/'>
                        <img src='../images/user.png' />
                        <label style="padding-left: 0px;"> Perfil</label>
                    </a>
                </div>


            </div>
        </div>
    </nav>
</header>
    </form>

