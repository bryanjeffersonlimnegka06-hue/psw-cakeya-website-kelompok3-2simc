<?php
header('Content-Type: application/json');
require_once(__DIR__ . '/../database connector/connect.php'); 

$response = ['success' => false, 'message' => 'Something went wrong.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cake_id     = isset($_POST['edit_cake_id']) ? (int)$_POST['edit_cake_id'] : 0;
    $cake_name   = isset($_POST['edit_cake_name']) ? trim($_POST['edit_cake_name']) : '';
    $cost        = isset($_POST['edit_cost']) ? (float)$_POST['edit_cost'] : 0;
    $description = isset($_POST['edit_description']) ? trim($_POST['edit_description']) : '';

    if ($cake_id <= 0 || empty($cake_name) || $cost <= 0) {
        $response['message'] = 'Missing required valid update fields.';
        echo json_encode($response);
        exit;
    }

    // Check if a new file upload is present
    $fileUpdated = false;
    $pic_name = '';

    if (isset($_FILES['edit_pic']) && $_FILES['edit_pic']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['edit_pic']['tmp_name'];
        $fileName    = $_FILES['edit_pic']['name'];
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($fileExtension, $allowedExtensions)) {
            $newFileName = time() . '_edited_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);
            // Upload to public/product-image folder so it's accessible by both admin panel and website
            $uploadFileDir = __DIR__ . '/../../../../public/product-image/';
            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $pic_name = $newFileName;
                $fileUpdated = true;

                // Delete the old file from product-image folder if it exists
                $oldImgQuery = "SELECT pic FROM cake WHERE cake_id = ?";
                $oldImgStmt = $connect->prepare($oldImgQuery);
                if ($oldImgStmt) {
                    $oldImgStmt->bind_param("i", $cake_id);
                    $oldImgStmt->execute();
                    $oldImgStmt->bind_result($oldPicFilename);
                    if ($oldImgStmt->fetch() && $oldPicFilename !== 'default_cake.jpg') {
                        @unlink($uploadFileDir . $oldPicFilename);
                    }
                    $oldImgStmt->close();
                }
            }
        } else {
            $response['message'] = 'Invalid file type format.';
            echo json_encode($response);
            exit;
        }
    }

    // Prepare dynamic SQL based on whether the image changed
    if ($fileUpdated) {
        $sql = "UPDATE cake SET cake_name = ?, cost = ?, description = ?, pic = ? WHERE cake_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sdssi", $cake_name, $cost, $description, $pic_name, $cake_id);
    } else {
        $sql = "UPDATE cake SET cake_name = ?, cost = ?, description = ? WHERE cake_id = ?";
        $stmt = $connect->prepare($sql);
        $stmt->bind_param("sdsi", $cake_name, $cost, $description, $cake_id);
    }

    if ($stmt) {
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'Product configurations updated successfully!';
        } else {
            $response['message'] = 'Database update execution failed: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['message'] = 'Database system statement build failure.';
    }
}

echo json_encode($response);
$connect->close();
?>
