<?php
require __DIR__ . '/../database/connect.php';

if (isset($_POST['id'])) {
    $pessoaId = $_POST['id'];

    try {
        $sql = "DELETE FROM pessoas WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $pessoaId, PDO::PARAM_INT);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            echo json_encode(['status' => 'success', 'message' => 'Pessoa excluída com sucesso!']);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Pessoa não encontrada.']);
        }
    } catch (Exception $e) {
        echo json_encode(['status' => 'error', 'message' => 'Erro: ' . $e->getMessage()]);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Falta id.']);
}

$conn = null;
?>
