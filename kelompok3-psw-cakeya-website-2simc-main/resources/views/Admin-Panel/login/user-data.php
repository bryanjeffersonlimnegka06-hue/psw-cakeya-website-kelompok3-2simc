<?php
// user-data.php
header('Content-Type: application/json');
require_once('../database connector/connect.php'); 

// 1. Fetch ALL Users and map them by their ID
$userMap = [];
$userSql = "SELECT user_id, username, password FROM user";
$userResult = $connect->query($userSql);

if ($userResult) {
    while ($row = $userResult->fetch_assoc()) {
        $userMap[$row['user_id']] = [
            'user_id'  => (int)$row['user_id'],
            'username' => $row['username'],
            'password' => $row['password'] // Berisi string MD5 dari database
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