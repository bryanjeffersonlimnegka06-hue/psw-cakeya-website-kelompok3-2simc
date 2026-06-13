<?php
// delete-user.php
header('Content-Type: application/json');
require_once(__DIR__ . '/../database connector/connect.php');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Membaca raw JSON input dari JavaScript fetch body
    $jsonInput = file_get_contents('php://input');
    $data = json_decode($jsonInput, true);

    $user_id = isset($data['user_id']) ? (int)$data['user_id'] : 0;

    if ($user_id === 0) {
        echo json_encode([
            'success' => false, 
            'message' => 'ID user tidak valid atau tidak ditemukan.'
        ]);
        exit;
    }

    // Eksekusi query delete menggunakan Prepared Statement
    $stmt = $connect->prepare("DELETE FROM users WHERE id = ?");
    if (!$stmt) {
        echo json_encode([
            'success' => false,
            'message' => 'Gagal menyiapkan query database: ' . $connect->error
        ]);
        exit;
    }

    $stmt->bind_param("i", $user_id);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'User berhasil dihapus.'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Gagal menghapus user: ' . $stmt->error
        ]);
    }

    $stmt->close();
} else {
    echo json_encode([
        'success' => false, 
        'message' => 'Metode request tidak valid.'
    ]);
}

$connect->close();
?>
