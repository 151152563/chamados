# HorseAPP
Controlador de Veiculos de Tração animal

        {if="$endereco != false"}
                    <div class="row">
                        <div class="col-4">
                            <div class="info-box">
                                <h3 class="info-title">Rua</h3>
                                <h3 class="info-value">{$endereco.address_road}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="info-box">
                                <h3 class="info-title">Numero</h3>
                                <h3 class="info-value">{$endereco.address_number}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="info-box">
                                <h3 class="info-title">Complemento</h3>
                                <h3 class="info-value">{$endereco.address_complement}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="info-box">
                                <h3 class="info-title">Bairro</h3>
                                <h3 class="info-value">{$endereco.address_district}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="info-box">
                                <h3 class="info-title">CEP</h3>
                                <h3 class="info-value">{$endereco.address_cep}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="info-box">
                                <h3 class="info-title">Cidade</h3>
                                <h3 class="info-value">{$endereco.address_city}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="info-box">
                                <h3 class="info-title">Estado</h3>
                                <h3 class="info-value">{$endereco.address_state}</h3>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="info-box">
                                <h3 class="info-title">Data de Registro</h3>
                                <h3 class="info-value">{$endereco.address_dtregister}</h3>
                            </div>
                        </div>
                    </div>
                    <table>
                        <tbody class="actions">
                            <tr>
                                <td>
                                    <a class="view" href="#">Visualizar</a>
                                </td>
                                <td>
                                    <a class="edit" href="/admin/address/update{$endereco.address_id}">Editar</a>
                                </td>
                                <td>
                                    <a class="delete" href="/admin/address/delete{$endereco.address_id}">Deletar</a>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    {else}
                    <div class="row" style="margin-top: -60px; margin-bottom: 40px; padding-left: 30px;">
                        <br>
                        <a class="new-element-button btn-lg" href="/admin/address/create{$condutor.conductor_id}">Adicionar endereço</a>
                    </div>
                    {/if}