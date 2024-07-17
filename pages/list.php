<?php include '../database/connect.php'; ?>

<div class="mt-4">
    <p class="h3 text-center">Pessoas</p>
    
    <div class="container">
        <table id="tb_pessoas" class="table table-hover table-striped compact responsive display nowrap cellspacing=0 width=100%">
			<thead>
				<tr>
					<th>Nome</th>
					<th>Telefone</th>
					<th>Município</th>
					<th>Ações</th>
				</tr>						
			</thead>

			<tbody>
                <?php
                    $stmt = $conn->query("SELECT * FROM pessoas");
                    while ($row = $stmt->fetch()) {
                        echo "<tr>
                                <td>{$row['no_pessoa']}</td>
                                <td>{$row['nu_telefone']}</td>
                                <td>{$row['no_municipio']}</td>
                                <td>
                                    <button id=btnShow data-pessoa={$row['id']} class='btn btn-primary btn-sm'>Visualiza</button>
                                    <button id=btnEdit data-pessoa={$row['id']}' class='btn btn-warning btn-sm'>Edita</button>
                                    <button id=btnDelete data-pessoa={$row['id']} class='btn btn-danger btn-sm'>Apaga</button>

                                </td>
                            </tr>";
                    }
                ?>
			</tbody>
        </table>
    </div>

</div>

<script>
    $(document).ready(function() {
        $('#tb_pessoas').DataTable({
            language: {
                url: 'https://cdn.datatables.net/plug-ins/2.0.8/i18n/pt-BR.json',
            }, responsive: true, stateSave: true,
        });

        $('#btnAdd').click(function() {
            $('#modalPessoa input').val('');
            $('#modalPessoa').modal('show');
            $('#btnSalvar').show();
            $('#modalPessoa input').prop('disabled', false);
            $('#modalPessoaLabel').text('Adicionar Pessoa');
        });
        

        $('#btnSeed').click(function() {
            if (!confirm('Deseja executar o conteúdo do seeder?')) {
                return;
            }

            $.ajax({
                url: '/database/seeder.php',
                success: function() {
                    alert('Conteúdo do seeder.php executado com sucesso!');
                },
                error: function() {
                    alert('Erro ao executar o conteúdo do seeder.php.');
                }
            });
        });

       
        $("table#tb_pessoas").on("click", "#btnShow", function(e) {
            e.preventDefault();

            let pessoaId = $(this).data('pessoa');

            $.ajax({
                type: 'GET',
                url: '/database/showPessoa.php',
                data: { id: pessoaId },
                success: function(response) {
                    let pessoa = JSON.parse(response);

                    if (pessoa.status === 'error') {
                        alert(pessoa.message);
                    } else {
                        $('#modalPessoa').modal('show');

                        $('#modalPessoa #no_pessoa').val(pessoa.data.no_pessoa);
                        $('#modalPessoa #nu_telefone').val(pessoa.data.nu_telefone);
                        $('#modalPessoa #co_cep').val(pessoa.data.co_cep);
                        $('#modalPessoa #sg_uf').val(pessoa.data.sg_uf);
                        $('#modalPessoa #no_municipio').val(pessoa.data.no_municipio);
                        $('#modalPessoa #no_bairro').val(pessoa.data.no_bairro);
                        $('#modalPessoa #no_logradouro').val(pessoa.data.no_logradouro);
                        $('#modalPessoa #nu_logradouro').val(pessoa.data.nu_logradouro);
                        $('#modalPessoa #de_complemento').val(pessoa.data.de_complemento);
                        $('#modalPessoa #pessoa_id').val(pessoa.data.id);

                        $('#modalPessoa input').prop('disabled', true);
                        $('#btnSalvar').hide();

                        $('#modalPessoaLabel').text('Visualizar Pessoa');
                    }
                },
                error: function(error) {
                    alert(error);
                    
                }
            });
        });

        $("table#tb_pessoas").on("click", "#btnDelete",function(e){
            e.preventDefault();

            let pessoaId = $(this).data('pessoa');

            if (confirm('Tem certeza de que deseja excluir esta pessoa?')) {
                $.ajax({
                    type: 'POST',
                    url: '/database/deletePessoa.php',
                    data: { id: pessoaId }, 
                    success: function(response) {
                        let result = JSON.parse(response);

                        if (result.status === 'success') {
                            $('button[data-pessoa="' + pessoaId + '"]').closest('tr').remove();
                            alert(result.message);
                        } else {
                            alert(result.message);
                        }
                    },
                    error: function(error) {
                        alert('Erro ao excluir a Pessoa.');
                    }
                });
            }
        });

   
        $("table#tb_pessoas").on("click", "#btnEdit", function(e) {
            e.preventDefault();

            let pessoaId = $(this).data('pessoa');

            $.ajax({
                type: 'GET',
                url: '/database/showPessoa.php',
                data: { id: pessoaId },
                success: function(response) {
                    let jres = JSON.parse(response);
                    if (jres.status === 'success') {
                        $('#no_pessoa').val(jres.data.no_pessoa);
                        $('#nu_telefone').val(jres.data.nu_telefone);
                        $('#co_cep').val(jres.data.co_cep);
                        $('#sg_uf').val(jres.data.sg_uf);
                        $('#no_municipio').val(jres.data.no_municipio);
                        $('#no_bairro').val(jres.data.no_bairro);
                        $('#no_logradouro').val(jres.data.no_logradouro);
                        $('#nu_logradouro').val(jres.data.nu_logradouro);
                        $('#de_complemento').val(jres.data.de_complemento);
                        $('#id').val(jres.data.id);

                        $('#modalPessoa').modal('show');
                        $('#modalPessoaLabel').text('Editar Pessoa');
                        $('#modalPessoa input').prop('disabled', false);
                        $('#btnSalvar').show();

                        $('#btnSalvar').text('Salvar').off('click').on('click', function() {
                            let formData = $('#formPessoa').serialize();

                            $.ajax({
                                type: 'POST',
                                url: '/database/updatePessoa.php',
                                data: formData,
                                success: function(response) {
                                    let result = JSON.parse(response);
                                    if (result.status === 'success') {
                                        alert(result.message);
                                        
                                    } else {
                                        alert(result.message);
                                    }
                                    location.reload();
                                },
                                error: function(error) {
                                    alert('Erro ao atualizar a Pessoa.');
                                }
                            });
                        });
                    } else {
                        alert(jres.message);
                    }
                },
                error: function(error) {
                    alert('Erro ao obter os dados da Pessoa.');
                }
            });
        });


    });

</script>