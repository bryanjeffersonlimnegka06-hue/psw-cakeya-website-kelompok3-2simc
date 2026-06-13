<?php
// edit-user.php
header('Content-Type: application/json');
require_once(__DIR__ . '/../database connector/connect.php');

function ensureAdminUserColumns(mysqli $connect): void
{
    $plainPasswordColumn = $connect->query("SHOW COLUMNS FROM users LIKE 'plain_password'");
    if ($plainPasswordColumn && $plainPasswordColumn->num_rows === 0) {
        $connect->query("ALTER TABLE users ADD COLUMN plain_password VARCHAR(255) NULL AFTER password");
    }

    $adminColumn = $connect->query("SHOW COLUMNS FROM users LIKE 'is_admin'");
    if ($adminColumn && $adminColumn->num_rows === 0) {
        $connect->query("ALTER TABLE users ADD COLUMN is_admin TINYINT(1) NOT NULL DEFAULT 1 AFTER password");
    }
}

ensureAdminUserColumns($connect);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Ambil data dari FormData
    $user_id  = isset($_POST['user_id']) ? (int)$_POST['user_id'] : 0;
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email    = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validasi basic
    if ($user_id === 0 || empty($username) || empty($email)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Data tidak lengkap atau ID tidak valid.'
        ]);
        exit;
    }

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo json_encode([
            'success' => false,
            'message' => 'Format email tidak valid.'
        ]);
        exit;
    }

    if (!empty($password)) {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $connect->prepare("UPDATE users SET name = ?, email = ?, password = ?, plain_password = ?, is_admin = 1, updated_at = NOW() WHERE id = ?");
        if (!$stmt) {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menyiapkan query database: ' . $connect->error
            ]);
            exit;
        }
        $stmt->bind_param("ssssi", $username, $email, $hashedPassword, $password, $user_id);
    } else {
        $stmt = $connect->prepare("UPDATE users SET name = ?, email = ?, is_admin = 1, updated_at = NOW() WHERE id = ?");
        if (!$stmt) {
            echo json_encode([
                'success' => false,
                'message' => 'Gagal menyiapkan query database: ' . $connect->error
            ]);
            exit;
        }
        $stmt->bind_param("ssi", $username, $email, $user_id);
    }

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'Data user berhasil diperbarui.'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Gagal memperbarui data: ' . $stmt->error
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
