<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">

    <div class="cards-body">
        <div class="card-body">
            <div class="card-bg"></div>
            <div class="card-content">
                <div class="card-ico"><span><i class="fas fa-users"></i></span></div>
                <div class="card-title">
                    <h3>Socios</h3>
                </div>
                <div class="card-middle">
                    <p>Gerenciar Socios</p>
                </div>
                <div class="card-bottom"><a class="card-buttom" href="admin/partners">Gerenciar</a></div>
            </div>
        </div>
        <div class="card-body">
            <div class="card-bg"></div>
            <div class="card-content">
                <div class="card-ico"><span><i class="fas fa-user"></i></span></div>
                <div class="card-title">
                    <h3>Meu perfil</h3>
                </div>
                <div class="card-middle">
                    <p>Gerenciar perfil</p>
                </div>
                <div class="card-bottom"><a class="card-buttom" href="admin/user/profile<?php echo htmlspecialchars( $id, ENT_COMPAT, 'UTF-8', FALSE ); ?>">Gerenciar</a></div>
            </div>
        </div>
        <?php if( $administrador==1 ){ ?>
        <div class="card-body">
            <div class="card-bg"></div>
            <div class="card-content">
                <div class="card-ico"><span><i class="fas fa-users-gear"></i></span></div>
                <div class="card-title">
                    <h3>Usuarios</h3>
                </div>
                <div class="card-middle">
                    <p>Gerenciar usuarios</p>
                </div>
                <div class="card-bottom"><a class="card-buttom" href="admin/users">Gerenciar</a></div>
            </div>
        </div>
        <?php } ?> <?php if( $administrador==1 ){ ?>
        <div class="card-body class last">
            <div class="card-bg"></div>
            <div class="card-content">
                <div class="card-ico"><span><i class="fas fa-clock"></i></span></div>
                <div class="card-title">
                    <h3>Registros</h3>
                </div>
                <div class="card-middle">
                    <p>Gerenciar registros</p>
                </div>
                <div class="card-bottom"><a class="card-buttom" href="admin/logs">Gerenciar</a></div>
            </div>
        </div>
        <?php } ?>


    </div>

</div>