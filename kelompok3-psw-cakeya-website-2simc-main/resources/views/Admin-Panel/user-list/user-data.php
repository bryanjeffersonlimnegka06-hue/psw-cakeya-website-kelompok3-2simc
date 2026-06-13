<?php
// user-data.php
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

// All users managed from this admin list should be admin accounts.
$connect->query("UPDATE users SET is_admin = 1 WHERE is_admin = 0 OR is_admin IS NULL");

// 1. Fetch ALL Laravel users and map them to the legacy admin panel shape
$userMap = [];
$userSql = "SELECT id, name, email, password, plain_password FROM users ORDER BY id DESC";
$userResult = $connect->query($userSql);

if ($userResult) {
    while ($row = $userResult->fetch_assoc()) {
        $storedPassword = (string) $row['password'];
        $displayPassword = $row['plain_password'] ?: '';

        if ($displayPassword === '' && !preg_match('/^\$2[ayb]\$/', $storedPassword)) {
            $displayPassword = $storedPassword;
        }

        $userMap[$row['id']] = [
            'user_id'  => (int)$row['id'],
            'username' => $row['name'],
            'email'    => $row['email'],
            'password' => $displayPassword
        ];
    }
}

// 2. Return the data as a clean JSON response
echo json_encode([
    'success' => true, 
    'users'   => array_values($userMap)
]);

$connect->close();
?>
