<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="profile-body">
        <div class="entity-profile-card">
            <div class="entity-profile-card-top card-category">

                <div class="entity-img">
                    <img src="<?php echo htmlspecialchars( $socio["partner_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="" srcset="">
                </div>

                <div class="entity-title">
                    <div class="entity-name">
                        <h3><?php echo htmlspecialchars( $socio["partner_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                    </div>
                    <div class="entity-sub-info">
                        <p><?php echo htmlspecialchars( $socio["partner_assoctype"], ENT_COMPAT, 'UTF-8', FALSE ); ?></p>
                    </div>
                </div>

            </div>

            <div class="entity-profile-card-middle card-category">
                <div class="entity-info sub-card-category">
                    <div class="card-category-title">
                        <h3>socio</h3>
                    </div>
                    <div class="info-items">

                        <div class="info-box">
                            <h3 class="info-title">Nome</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Tag</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_uniquetag"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Identidade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_identity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">CPF</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Idade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_age"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Celular</h3>
                            <h3 class="info-value phone-mask"><?php echo htmlspecialchars( $socio["partner_mobphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Residencial</h3>
                            <h3 class="info-value phone-mask"><?php echo htmlspecialchars( $socio["partner_resphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Tipo associação</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_assoctype"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Dia de pagamento</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_paymentday"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Valor mensalidade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_monthlypayment"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Status</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_status"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Data de registro</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $socio["partner_dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                    </div>
                </div>

                <div class="sub-card-category">
                    <div class="row card-category-title">
                        <h3>Imagens</h3>
                    </div>
                    <div class="image-info-box">
                        <div class="img-box">
                            <?php if( $socio["partner_profilepicture"] ){ ?>
                            <img src="<?php echo htmlspecialchars( $socio["partner_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" alt="">
                            <div class="img-box-caption">
                                <p>Foto perfil</p>
                                <a href="<?php echo htmlspecialchars( $socio["partner_profilepicture"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" target="blank">Visualizar</a>
                            </div>
                            <?php }else{ ?>
                            <div class="img-not-found-box">
                                <p>Nenhuma imagem encontrada</p>
                            </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>

                <div class="entity-address sub-card-category">
                    <div class="card-category-title">
                        <h3>Endereço</h3>
                    </div>
                    <?php if( $endereco != false ){ ?>
                    <div class="info-items">

                        <div class="info-box">
                            <h3 class="info-title">Rua</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_road"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Numero</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_number"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Complemento</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_complement"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Bairro</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_district"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">CEP</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_cep"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Cidade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_city"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>

                        <div class="info-box">
                            <h3 class="info-title">Estado</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $endereco["address_state"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                    </div>
                    <br>
                    <div class="info-items">
                        <div class="new-element-action">
                            <a href="/admin/address/update<?php echo htmlspecialchars( $endereco["address_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="edit">Editar</button>
                            </a>
                        </div>
                        <div class="new-element-action">
                            <a href="/admin/address/delete<?php echo htmlspecialchars( $endereco["address_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente excluir este registro?')">
                                <button class="delete">Excluir</button>
                            </a>
                        </div>
                    </div>
                    <?php }else{ ?>
                    <h3 style="padding-left: 30px; padding-bottom: 30px;">Nenhum endereço encontrado</h3>
                    <div class="new-element">
                        <a href="/admin/address/create<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="new-element-button">
                            <button>
                                Incluir novo
                            </button>
                        </a>
                    </div>
                    <?php } ?>
                </div>

                <div class="entity-profile-bottom-depends sub-card-category">
                    <div class="card-category-title">
                        <h3>Dependentes</h3>
                    </div>
                    <?php if( $dependentes != false ){ ?>
                    <div>
                        <table>
                            <thead>
                                <tr>
                                    <th style="font-weight: bolder;">ID</th>
                                    <th>Nome</th>
                                    <th>Grau</th>
                                    <th>Ação</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $counter1=-1;  if( isset($dependentes) && ( is_array($dependentes) || $dependentes instanceof Traversable ) && sizeof($dependentes) ) foreach( $dependentes as $key1 => $value1 ){ $counter1++; ?>
                                <tr>
                                    <td style="font-weight: bolder;"><?php echo htmlspecialchars( $value1["dependent_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["dependent_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td><?php echo htmlspecialchars( $value1["dependent_familiarity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></td>
                                    <td>
                                        <a href="/admin/dependent/profile<?php echo htmlspecialchars( $value1["dependent_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="small-action-btn">👁</a>
                                        <a href="/admin/dependent/profile<?php echo htmlspecialchars( $value1["dependent_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="action-btn">Visualizar</a>
                                    </td>
                                </tr>
                                <?php } ?>
                            </tbody>
                        </table>
                    </div>
                    <?php }else{ ?>
                    <h3 style="padding-left: 30px; padding-bottom: 30px;">Nenhum familiar encontrado</h3>
                    <?php } ?>
                    <div class="new-element">
                        <a href="/admin/dependent/create<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="new-element-button">
                            <button>
                                Incluir novo
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            <div class="entity-profile-card-bottom card-category">
                <div class="entity-profile-bottom-actions sub-card-category">
                    <div class="card-category-title">
                        <h3>
                            Ações
                        </h3>
                    </div>
                    <div class="info-items">
                        <div class="new-element-action">
                            <a href="">
                                <button class="print">Visualizar</button>
                            </a>
                        </div>
                        <div class="new-element-action">
                            <a href="/admin/partner/update<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="edit">Editar</button>
                            </a>
                        </div>
                        <div class="new-element-action">
                            <a href="/admin/partner/delete<?php echo htmlspecialchars( $socio["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente excluir este registro? Todos seus dependetes, endereço e animais serão excluidos')">
                                <button class="delete">Excluir</button>
                            </a>
                        </div>
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