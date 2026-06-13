<?php
// add-user.php
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
    // Ambil data input dari FormData di HTML
    $username = isset($_POST['username']) ? trim($_POST['username']) : '';
    $email = isset($_POST['email']) ? trim($_POST['email']) : '';
    $password = isset($_POST['password']) ? trim($_POST['password']) : '';

    // Validasi input tidak boleh kosong
    if (empty($username) || empty($email) || empty($password)) {
        echo json_encode([
            'success' => false, 
            'message' => 'Username, email, dan password wajib diisi!'
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

    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $connect->prepare("INSERT INTO users (name, email, password, plain_password, is_admin, created_at, updated_at) VALUES (?, ?, ?, ?, 1, NOW(), NOW())");
    if (!$stmt) {
        echo json_encode([
            'success' => false,
            'message' => 'Gagal menyiapkan query database: ' . $connect->error
        ]);
        exit;
    }

    $stmt->bind_param("ssss", $username, $email, $hashedPassword, $password);

    if ($stmt->execute()) {
        echo json_encode([
            'success' => true, 
            'message' => 'User baru berhasil ditambahkan.'
        ]);
    } else {
        echo json_encode([
            'success' => false, 
            'message' => 'Gagal menyimpan user baru ke database: ' . $stmt->error
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
