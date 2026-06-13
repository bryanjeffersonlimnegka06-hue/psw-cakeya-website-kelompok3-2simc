<?php
header('Content-Type: application/json');
require_once(__DIR__ . '/../database connector/connect.php'); 

$response = ['success' => false, 'message' => 'Something went wrong.'];

// Read the incoming JSON raw payload data string
$inputData = json_decode(file_get_contents('php://input'), true);

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($inputData['cake_id'])) {
    $cake_id = (int)$inputData['cake_id'];

    // Optional: Fetch the old image filename if you want to delete it from disk
    $imgQuery = "SELECT pic FROM cake WHERE cake_id = ?";
    $imgStmt = $connect->prepare($imgQuery);
    if ($imgStmt) {
        $imgStmt->bind_param("i", $cake_id);
        $imgStmt->execute();
        $imgStmt->bind_result($oldPic);
        if ($imgStmt->fetch() && $oldPic !== 'default_cake.jpg') {
            // Delete from public/product-image folder
            $uploadFileDir = __DIR__ . '/../../../../public/product-image/';
            @unlink($uploadFileDir . $oldPic); // Safely remove file if it exists
        }
        $imgStmt->close();
    }

    // Execute deletion sequence
    $sql = "DELETE FROM cake WHERE cake_id = ?";
    $stmt = $connect->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("i", $cake_id);
        
        if ($stmt->execute()) {
            if ($stmt->affected_rows > 0) {
                $response['success'] = true;
                $response['message'] = 'Product successfully removed from database.';
            } else {
                $response['message'] = 'Product not found or already deleted.';
            }
        } else {
            $response['message'] = 'Database execute error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['message'] = 'Database prepare error: ' . $connect->error;
    }
} else {
    $response['message'] = 'Invalid request parameters.';
}

echo json_encode($response);
$connect->close();
?>
