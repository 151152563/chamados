<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="list-body">
        <div class="list-body-content">
            <div class="list-body-top">
                <div class="list-category-title">
                    <h3 class="list-title">Socios</h3>
                </div>
                <div class="list-category-sub-title">
                    <p class="list-sub-title">lista de socios</p>
                </div>
            </div>
            <div class="list-body-middle">
                <form action="">
                    <div class="list-search-top">
                        <div class="search-dropdown-body">
                            <div class="dropdown-box">
                                <select name="type" id="type">
                                    <?php if( $tipo=='partner_name' ){ ?>
                                    <option value="partner_name" selected>Nome</option>
                                    <?php }else{ ?>
                                    <option value="partner_name">Nome</option>
                                    <?php } ?>

                                    <?php if( $tipo=='partner_uniquetag' ){ ?>
                                    <option value="partner_uniquetag" selected>Identificador</option>
                                    <?php }else{ ?>
                                    <option value="partner_uniquetag">Identificador</option>
                                    <?php } ?>
                                    <?php if( $tipo=='partner_cpf' ){ ?>
                                    <option value="partner_cpf" selected>CPF</option>
                                    <?php }else{ ?>
                                    <option value="partner_cpf">CPF</option>
                                    <?php } ?>
                                </select>
                            </div>
                        </div>
                        <div class="search-field-body">
                            <div class="search-input-group">
                                <div class="input-text">
                                    <input type="text" class="search-text-input" placeholder="Termo da busca" id="term" name="term" value="<?php echo htmlspecialchars( $termo, ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                    <button class="search-btn"><span>Buscar</span><i class="fa fa-search"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="list-table-body">
                    <table>
                        <thead>
                            <th style="font-weight: bolder;">ID</th>
                            <th>Nome</th>
                            <th>Telefone</th>
                            <th>Ação</th>
                        </thead>
                        <tbody>
                            <?php $counter1=-1;  if( isset($socios) && ( is_array($socios) || $socios instanceof Traversable ) && sizeof($socios) ) foreach( $socios as $key1 => $value1 ){ $counter1++; ?>
                            <tr>
                                <td style="font-weight: bolder;"><?php echo htmlspecialchars( $value1["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td><?php echo htmlspecialchars( $value1["partner_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td class="phone-mask"><?php echo htmlspecialchars( $value1["partner_mobphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                <td>
                                    <a href="/admin/partner/profile<?php echo htmlspecialchars( $value1["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-action-btn">👁</a>
                                    <a href="/admin/partner/profile<?php echo htmlspecialchars( $value1["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="action-btn">Visualizar</a>
                                </td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
                <div class="new-element">
                    <a href="./partner/create" class="new-element-button">
                        <button>
                            Incluir novo
                        </button>
                    </a>
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