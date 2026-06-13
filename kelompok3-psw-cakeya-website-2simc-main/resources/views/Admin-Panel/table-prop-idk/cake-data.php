<?php
header('Content-Type: application/json');
require_once('../database connector/connect.php'); 

// 1. Fetch ALL Cakes and map them by their ID
$cakeMap = [];
// FIXED: Changed 'id_cake' to 'cake_id' inside the SELECT statement
$cakeSql = "SELECT cake_id, cake_name, pic, penjualan, cost, description FROM cake";
$cakeResult = $connect->query($cakeSql);

if ($cakeResult) {
    while ($row = $cakeResult->fetch_assoc()) {
        // Fallback for image if it's empty
        $pic = !empty($row['pic']) ? $row['pic'] : 'default_cake.jpg';
        
        // FIXED: Updated array array keys to read from $row['cake_id'] instead of 'id_cake'
        $cakeMap[$row['cake_id']] = [
            'id'          => $row['cake_id'],
            'name'        => $row['cake_name'],
            'pic'         => $pic,
            'penjualan'   => (int)$row['penjualan'],
            'cost'        => (float)$row['cost'],
            'description' => $row['description']
        ];
    }
}

// 2. Return the data as a clean JSON response
echo json_encode([
    'success' => true, 
    'cakes'   => array_values($cakeMap)
]);

$connect->close();
?>