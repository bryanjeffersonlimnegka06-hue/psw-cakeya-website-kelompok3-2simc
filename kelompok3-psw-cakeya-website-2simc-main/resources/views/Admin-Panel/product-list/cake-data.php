<?php
header('Content-Type: application/json');
require_once(__DIR__ . '/../database connector/connect.php'); 

// 1. Fetch ALL Cakes and map them by their ID
$cakeMap = [];
$cakeSql = "SELECT cake_id AS id, cake_name, pic, penjualan, cost, description FROM cake";
$cakeResult = $connect->query($cakeSql);

if ($cakeResult) {
    while ($row = $cakeResult->fetch_assoc()) {
        // Fallback for image if it's empty
        $pic = !empty($row['pic']) ? $row['pic'] : 'default_cake.jpg';
        
        $cakeMap[$row['id']] = [
            'id'          => $row['id'],
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
