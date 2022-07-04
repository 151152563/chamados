<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="list-body">
        <div class="list-body-content">
            <div class="list-body-top">
                <div class="list-category-title">
                    <h3 class="list-title">Registros</h3>
                </div>
                <div class="list-category-sub-title">
                    <p class="list-sub-title">lista de registros</p>
                </div>
            </div>
            <div class="list-body-middle">
                <form action="">
                    <div class="list-search-top">
                        <div class="search-dropdown-body">
                            <div class="dropdown-box">
                                <select name="type" id="type">
                                    <?php if( $tipo=='user_name' ){ ?>
                                    <option value="user_name" selected>NOME DE USUARIO</option>
                                    <?php }else{ ?>
                                    <option value="user_name">NOME DE USUARIO</option>
                                    <?php } ?>
                                    <?php if( $tipo=='log_uniquetag' ){ ?>
                                    <option value="log_uniquetag" selected>IDENTIFICADOR</option>
                                    <?php }else{ ?>
                                    <option value="log_uniquetag">IDENTIFICADOR</option>
                                    <?php } ?>
                                    <?php if( $termo=='user' ){ ?>
                                    <option value="user" selected>USUARIOS</option>
                                    <?php }else{ ?>
                                    <option value="user" >USUARIOS</option>
                                    <?php } ?>
                                    <?php if( $termo=='conductor' ){ ?>
                                    <option value="conductor" selected>CONDUTORES</option>
                                    <?php }else{ ?>
                                    <option value="conductor">CONDUTORES</option>
                                    <?php } ?>
                                    <?php if( $termo=='dependent' ){ ?>
                                    <option value="dependent" selected>DEPENDENTES</option>
                                    <?php }else{ ?>
                                    <option value="dependent">DEPENDENTES</option>
                                    <?php } ?>

                                    <?php if( $termo=='animal' ){ ?>
                                    <option value="animal" selected>ANIMAIS</option>
                                    <?php }else{ ?>
                                    <option value="animal">ANIMAIS</option>
                                    <?php } ?>

                                    <?php if( $termo=='carriage' ){ ?>
                                    <option value="carriage" selected>CARRUAGENS</option>
                                    <?php }else{ ?>
                                    <option value="carriage">CARRUAGENS</option>
                                    <?php } ?>

                                    <?php if( $termo=='address' ){ ?>
                                    <option value="address" selected>ENDEREÇO</option>
                                    <?php }else{ ?>
                                    <option value="address">ENDEREÇO</option>
                                    <?php } ?>
                                    <?php if( $termo=='RG' ){ ?>
                                    <option value="RG" selected>CADASTRO</option>
                                    <?php }else{ ?>
                                    <option value="RG">CADASTRO</option>
                                    <?php } ?>
                                    <?php if( $termo=='AT' ){ ?>
                                    <option value="AT" selected>ATUALIZAÇÂO</option>
                                    <?php }else{ ?>
                                    <option value="AT">ATUALIZAÇÂO</option>
                                    <?php } ?>
                                    <?php if( $termo=='EX' ){ ?>
                                    <option value="EX" selected>EXCLUSÃO</option>
                                    <?php }else{ ?>
                                    <option value="EX">EXCLUSÃO</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="search-field-body">
                            <div class="search-input-group">
                                <div class="input-text">
                                    <input type="text" class="search-text-input" placeholder="Termo da busca" id="term" name="term" <?php if( $tipo =='user_name' ){ ?>value="<?php echo htmlspecialchars( $termo, ENT_COMPAT, 'UTF-8', FALSE ); ?>"<?php }elseif( $tipo=='log_uniquetag' ){ ?>value="<?php echo htmlspecialchars( $termo, ENT_COMPAT, 'UTF-8', FALSE ); ?>"<?php }else{ ?>value=""<?php } ?>">
                                    <button class="search-btn"><span>Buscar</span><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="list-table-body">
                    <table>
                        <thead>
                            <th style="font-weight: bold;">#</th>
                            <th>Nome</th>
                            <th>Tipo</th>
                            <th>Data</th>
                            <th>Ação</th>
                        </thead>
                        <tbody>
                            <?php $counter1=-1;  if( isset($logs) && ( is_array($logs) || $logs instanceof Traversable ) && sizeof($logs) ) foreach( $logs as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td><?php echo htmlspecialchars( $value1["log_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["user_name"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["log_operation"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["log_dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td>
                                    <a href="/admin/log/profile<?php echo htmlspecialchars( $value1["log_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-action-btn">👁</a>
                                    <a href="/admin/log/profile<?php echo htmlspecialchars( $value1["log_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="action-btn">Visualizar</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="list-body-bottom">
                <div class="paginator-body">
                    <div class="paginator-items">
                        <?php $counter1=-1;  if( isset($pages) && ( is_array($pages) || $pages instanceof Traversable ) && sizeof($pages) ) foreach( $pages as $key1 => $value1 ){ $counter1++; ?>
                        <div class="paginator-element">
                            <a href="<?php echo htmlspecialchars( $value1["link"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="paginator-target"><?php echo htmlspecialchars( $value1["text"], ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                        </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script src="_js/jquery-3.6.0.min.js"></script>
<script src="_js/index.js"></script>

</html>