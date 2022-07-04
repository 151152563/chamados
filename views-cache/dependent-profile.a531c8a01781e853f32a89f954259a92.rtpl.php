<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="profile-body">
        <div class="entity-profile-card">
            <div class="entity-profile-card-middle card-category">
                <div class="entity-info sub-card-category">
                    <div class="row card-category-title">
                        <h3>Dependente</h3>
                    </div>
                    <div class="info-items">
                        <div class="info-box">
                            <h3 class="info-title">Responsável</h3>
                            <a href="/admin/conductor/profile<?php echo htmlspecialchars( $dependente["partner_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" class="profile-action-bt"><?php echo htmlspecialchars( $socio, ENT_COMPAT, 'UTF-8', FALSE ); ?></a>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Nome completo</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $dependente["dependent_fullname"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Identidade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $dependente["dependent_identity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">CPF</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $dependente["dependent_cpf"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Idade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $dependente["dependent_age"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Data nascimento</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $dependente["dependent_dtnasc"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Telefone celular</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $dependente["dependent_mobphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Telefone residencial</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $dependente["dependent_resphone"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Familiaridade</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $dependente["dependent_familiarity"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
                        <div class="info-box">
                            <h3 class="info-title">Data de registro</h3>
                            <h3 class="info-value"><?php echo htmlspecialchars( $dependente["dependent_dtregister"], ENT_COMPAT, 'UTF-8', FALSE ); ?></h3>
                        </div>
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
                            <a href="/admin/dependent/update<?php echo htmlspecialchars( $dependente["dependent_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>">
                                <button class="edit">Editar</button>
                            </a>
                        </div>
                        <div class="new-element-action">
                            <a href="/admin/dependent/delete<?php echo htmlspecialchars( $dependente["dependent_id"], ENT_COMPAT, 'UTF-8', FALSE ); ?>" onclick="return confirm('Deseja realmente excluir este registro?')">
                                <button class="delete">Excluir</button>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>