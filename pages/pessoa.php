<div class="modal modal-xl fade" id="modalPessoa" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalPessoaLabel" >Adicionar Pessoa</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="formPessoa" method="post">
                    <div class="form-group row">
                        <input type="hidden" id="id" name="id"> 

                        <div class="form-group col-md-9 col-sm-9 col-xs-9">
                            <label for="no_pessoa" class="control-label">Nome</label>
                            <input type="text" id="no_pessoa" class="form-control" name="no_pessoa" minlength="4" maxlength="100" required>
                        </div>
                        <div class="form-group col-md-3 col-sm-3 col-xs-3">
                            <label for="nu_telefone" class="control-label">Telefone</label>
                            <input type="text" class="form-control" id="nu_telefone" name="nu_telefone" maxlength="15" required>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-2">
                            <label class="col-md-1 control-label" for="co_cep">CEP</label>
                            <input id="co_cep" name="co_cep" type="text" class="form-control" v-mask="'##.###-###'">
                        </div>
                        <div class="form-group col-md-1">
                            <label class="col-md-1 control-label" for="sg_uf">UF</label>
                            <input id="sg_uf" name="sg_uf" type="text" class="form-control" maxlength="2">
                        </div>
                        <div class="form-group col-md-5">
                            <label class="col-md-1 control-label" for="no_municipio">Município</label>
                            <input id="no_municipio" name="no_municipio" type="text" class="form-control" minlength="4" maxlength="30">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-md-1 control-label" for="no_bairro">Bairro</label>
                            <input id="no_bairro" name="no_bairro" type="text" class="form-control" minlength="4" maxlength="30">
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="form-group col-md-6">
                            <label class="col-md-1 control-label" for="no_logradouro">Logradouro</label>
                            <input id="no_logradouro" name="no_logradouro" type="text" class="form-control" minlength="4" maxlength="100">
                        </div>
                        <div class="form-group col-md-2">
                            <label class="col-md-1 control-label" for="nu_logradouro">Número</label>
                            <input id="nu_logradouro" name="nu_logradouro" type="text" class="form-control">
                        </div>
                        <div class="form-group col-md-4">
                            <label class="col-md-1 control-label" for="de_complemento">Complemento</label>
                            <input id="de_complemento" name="de_complemento" type="text" class="form-control" maxlength="100">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fechar</button>
                        <button id="btnSalvar" type="button" class="btn btn-primary">Salvar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    var maskBehavior = function (val) {
            return val.replace(/\D/g, '').length === 11 ? '(00) 00000-0000' : '(00) 0000-00009';
        },
        options = {onKeyPress: function(val, e, field, options) {
                field.mask(maskBehavior.apply({}, arguments), options);
            }
        };

    $('#co_cep').mask('00000-000');

    $('#nu_telefone').mask(maskBehavior, options);

  
    $(document).ready(function() {

    
        $('#co_cep').on('blur', function() {
            $.ajax({
                url: 'http://cdn.apicep.com/file/apicep/' + $('#co_cep').val() + '.json',
                dataType: 'json',
                success: function(data) {

                    $('#no_municipio').val(data.city);
                    $('#no_bairro').val(data.district);
                    $('#no_logradouro').val(data.address);
                    $('#sg_uf').val(data.state);

                },

                error: function(error) {

                    $('#no_municipio').val("");
                    $('#no_bairro').val("");
                    $('#no_logradouro').val("");
                    $('#sg_uf').val("");
                    alert("CEP não encontrado!");

                }
            });
        })

        $('#btnSalvar').click(function(e) {
            e.preventDefault(); 
            let formData = $('#formPessoa').serialize(); 

            $.ajax({
                type: 'POST',
                url: function() {
                    return $('#id').val() ? '/database/updatePessoa.php' : '/database/createPessoa.php';
                }(),
                data: formData,
                success: function(response) {
                    let result = JSON.parse(response);

                    if (result.status == 'success') {
                        location.reload();
                    } else {
                        alert(result.message);
                    }
                },
                error: function(error) {
                    alert(result.message);
                }
            });
        });


    });
</script>
