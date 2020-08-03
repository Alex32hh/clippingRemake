<div class='main-login-Page'>
    <div class='top-item'>
        <div></div>

        <div>

            <div class='alerta-icon'>
                <a>
                    <img src='images/bell.png' />
                    <label class='link-hover-manifexto'>Alerta</label>
                </a>
            </div>

            <div class='perfil-icon'>
                <a>
                    <img src='images/user.png' />
                    <label class='link-hover-manifexto'>Perfil</label>
                </a>
            </div>

        </div>

    </div>

    <div class='center-intem'>

        <div>
            <img src=images/Logotipo_Manifexto2018@2x.png />
        </div>


        <div class='center-input-box'>

            <div></div>
            <form class='form-list' onSubmit={handleSubmit(onSubmit)}>
                <div><button type="submit"> <img src='images/search.png' /> </button></div>
                <div><input type="text" placeholder="Pesquisar..." name="p" ref={register({ required: true })} />
                </div>
            </form>
            <div></div>

        </div>


    </div>


</div>