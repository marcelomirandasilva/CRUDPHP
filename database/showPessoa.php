<?php
require __DIR__ . '/../database/connect.php';

if (isset($_GET['id'])) {
    $pessoaId = $_GET['id'];
    try {
        $sql = "SELECT * FROM pessoas WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $pessoaId, PDO::PARAM_INT);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data) {
            echo json_encode(['status' => 'success', 'data' => $data]);
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
