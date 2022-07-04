<?php if(!class_exists('Rain\Tpl')){exit;}?><!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../../res/_css/index.css">
    <link rel="stylesheet" href="../../res/_css/response.css">
    <link rel="stylesheet" href="../../res/_css/simple-grid.min.css">
    <title><?php echo htmlspecialchars( $tipo, ENT_COMPAT, 'UTF-8', FALSE ); ?></title>
</head>

<body>
    <div class="box-bg">
        <div class="input-box">
            <div class="input-box-header">
                <div class="input-box-title">
                    <div class="box-title">
                        <?php echo htmlspecialchars( $tipo, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                    </div>
                    <div class="box-sub-title">
                        Gremio-APP
                    </div>
                </div>
            </div>
            <div class="input-box-body">


                <?php if( $sucesso==1 ){ ?>
                <p class="message success">
                    <?php echo htmlspecialchars( $resposta, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </p>
                <?php }else{ ?>
                <p class="message error">
                    <?php echo htmlspecialchars( $resposta, ENT_COMPAT, 'UTF-8', FALSE ); ?>
                </p>
                <?php } ?>
                <div class="input-box-action">
                    <a href="#" class="back" onclick="history.go(-1)">Voltar</a>

                </div>
            </div>
            <div class="input-box-footer">

            </div>
        </div>
    </div>
</body>

</html>