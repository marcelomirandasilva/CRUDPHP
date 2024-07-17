<?php
require __DIR__ . '/../database/connect.php';


if (isset($_POST['pessoa_id'], $_POST['no_pessoa'], $_POST['nu_telefone'])) {

	$pessoaId = $_POST['pessoa_id'];
	$no_pessoa = $_POST['no_pessoa'];
	$nu_telefone = $_POST['nu_telefone'];
	$co_cep = $_POST['co_cep'];
	$sg_uf = $_POST['sg_uf'];
	$no_municipio = $_POST['no_municipio'];
	$no_bairro = $_POST['no_bairro'];
	$no_logradouro = $_POST['no_logradouro'];
	$nu_logradouro = $_POST['nu_logradouro'];
	$de_complemento = $_POST['de_complemento'];

	try {
		$sql = "UPDATE pessoas SET no_pessoa = :no_pessoa, nu_telefone = :nu_telefone, co_cep = :co_cep, sg_uf = :sg_uf, no_municipio = :no_municipio, no_bairro = :no_bairro, no_logradouro = :no_logradouro, nu_logradouro = :nu_logradouro, de_complemento = :de_complemento WHERE id = :id";
		$stmt = $conn->prepare($sql);

		$stmt->bindParam(':no_pessoa', $no_pessoa);
		$stmt->bindParam(':nu_telefone', $nu_telefone);
		$stmt->bindParam(':co_cep', $co_cep);
		$stmt->bindParam(':sg_uf', $sg_uf);
		$stmt->bindParam(':no_municipio', $no_municipio);
		$stmt->bindParam(':no_bairro', $no_bairro);
		$stmt->bindParam(':no_logradouro', $no_logradouro);
		$stmt->bindParam(':nu_logradouro', $nu_logradouro);
		$stmt->bindParam(':de_complemento', $de_complemento);
		$stmt->bindParam(':id', $pessoaId, PDO::PARAM_INT);

		$stmt->execute();

		if ($stmt->rowCount() > 0) {
				echo json_encode(['status' => 'success', 'message' => 'Pessoa atualizada com sucesso!']);
		} else {
				echo json_encode(['status' => 'error', 'message' => 'Fez nada não sô.']);
		}
	} catch (Exception $e) {
		echo json_encode(['status' => 'error', 'message' => 'Erro: ' . $e->getMessage()]);
	}
} else {
	echo json_encode(['status' => 'error', 'message' => 'Nome e telefone são obrigatórios.']);
}

$conn = null;
?>
