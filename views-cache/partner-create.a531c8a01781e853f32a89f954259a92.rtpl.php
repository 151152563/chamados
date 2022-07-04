<?php if(!class_exists('Rain\Tpl')){exit;}?><div class="content-body">
    <div class="register-box">
        <div class="title-box">
            <h3>Registrar Socio</h3>
        </div>
        <div class="content-box">
            <form method="post" action="/admin/partner/create" class="form-group" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="partner_fullname" class="label-input">Nome completo <span class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="partner_fullname" name="partner_fullname">
                </div>
                <div class="input-group">
                    <label for="partner_cpf" class="label-input">CPF</label>
                    <input type="text" class="text-input cpf" id="partner_cpf" name="partner_cpf">
                </div>
                <div class="input-group">
                    <label for="partner_identity" class="label-input">Identidade</label>
                    <input type="text" class="text-input" id="partner_identity" name="partner_identity">
                </div>
                <div class="input-group">
                    <label for="partner_dtnasc" class="label-input">Data de nascimento</label>
                    <input type="date" class="text-input" id="partner_dtnasc" name="partner_dtnasc">
                </div>
                <div class="input-group">
                    <label for="partner_resphone" class="label-input">Telefone Residencial</label>
                    <input type="text" class="text-input residencial" id="partner_resphone" name="partner_resphone">
                </div>
                <div class="input-group">
                    <label for="partner_mobphone" class="label-input">Telefone Celular</label>
                    <input type="text" class="text-input telefone" id="partner_mobphone" name="partner_mobphone">
                </div>
                <div class="input-group">
                    <label for="partner_age" class="label-input">Idade <span class="mandatory">*</span></label>
                    <input type="text" class="text-input" id="partner_age" name="partner_age">
                </div>
                <div class="input-group">
                    <label for="partner_email" class="label-input">Email <span class="mandatory">*</span></label>
                    <input type="email" class="text-input" id="partner_email" name="partner_email">
                </div>
                <div class="input-group">
                    <label for="partner_milorganization" class="label-input">Organização Militar <span class="mandatory">*</span></label>
                    <input type="milorganization" class="text-input" id="partner_milorganization" name="partner_milorganization">
                </div>
                <div class="input-group">
                    <label for="partner_assoctype" class="label-input">Tipo de associação</label>
                    <input list="type-list" type="text" class="text-input" id="partner_assoctype" name="partner_assoctype">
                    <datalist id="type-list">
                        <option value="Remido">
                        <option value="Militar com desconto em folha">
                        <option value="Militar sem desconto em folha">
                        <option value="Civil">
                        <option value="Professor (APEMU)">
                    </datalist>
                </div>
                <div class="input-group">
                    <label for="partner_paymentday" class="label-input">Data de pgamento</label>
                    <input type="date" class="text-input" id="partner_paymentday" name="partner_paymentday">
                </div>
                <div class="input-group">
                    <label for="partner_monthlypayment" class="label-input">Valor mensalidade</label>
                    <input type="text" class="text-input renda" id="partner_monthlypayment" name="partner_monthlypayment">
                </div>


                <div class="form-mandatory">
                    <p><span class="mandatory">*</span> Campos obrigatorios</p>
                </div>
                <div class="form-action">
                    <button class="action-reset" type="reset">Cancelar</button>
                    <button class="action-submit" type="submit">Salvar</button>
                </div>
            </form>
        </div>
    </div>
</div>