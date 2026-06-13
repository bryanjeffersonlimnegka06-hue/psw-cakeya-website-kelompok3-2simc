<?php
header('Content-Type: application/json');
require_once(__DIR__ . '/../database connector/connect.php'); 

// Initial response structure
$response = ['success' => false, 'message' => 'Something went wrong.'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect data fields safely
    $cake_name   = isset($_POST['cake_name']) ? trim($_POST['cake_name']) : '';
    $cost        = isset($_POST['cost']) ? (float)$_POST['cost'] : 0;
    $description = isset($_POST['description']) ? trim($_POST['description']) : '';
    $penjualan   = 0; // Default new products to 0 sales
    $pic_name    = 'default_cake.jpg'; // Fallback name

    // Validate essential inputs
    if (empty($cake_name) || $cost <= 0) {
        $response['message'] = 'Cake name and valid cost are required fields.';
        echo json_encode($response);
        exit;
    }

    // Handle File Upload if an image was provided
    if (isset($_FILES['pic']) && $_FILES['pic']['error'] === UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['pic']['tmp_name'];
        $fileName    = $_FILES['pic']['name'];
        
        // Get file extension safely
        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'webp'];

        if (in_array($fileExtension, $allowedExtensions)) {
            // Generate a unique, clean filename to avoid file overwriting
            $newFileName = time() . '_' . preg_replace("/[^a-zA-Z0-9.]/", "_", $fileName);
            // Upload to public/product-image folder so it's accessible by both admin panel and website
            $uploadFileDir = __DIR__ . '/../../../../public/product-image/';
            
            // Create product-image directory if it doesn't exist yet
            if (!is_dir($uploadFileDir)) {
                mkdir($uploadFileDir, 0755, true);
            }

            $dest_path = $uploadFileDir . $newFileName;

            if (move_uploaded_file($fileTmpPath, $dest_path)) {
                $pic_name = $newFileName;
            } else {
                $response['message'] = 'Failed to move uploaded file to destination product-image directory.';
                echo json_encode($response);
                exit;
            }
        } else {
            $response['message'] = 'Upload failed. Allowed formats: JPG, JPEG, PNG, WEBP.';
            echo json_encode($response);
            exit;
        }
    }

    // Insert data into your MySQL table using prepared statements
    $sql = "INSERT INTO cake (cake_name, cost, description, pic, penjualan) VALUES (?, ?, ?, ?, ?)";
    $stmt = $connect->prepare($sql);

    if ($stmt) {
        $stmt->bind_param("sdssi", $cake_name, $cost, $description, $pic_name, $penjualan);
        
        if ($stmt->execute()) {
            $response['success'] = true;
            $response['message'] = 'New product successfully registered!';
        } else {
            $response['message'] = 'Database execute error: ' . $stmt->error;
        }
        $stmt->close();
    } else {
        $response['message'] = 'Database prepare error: ' . $connect->error;
    }
}

echo json_encode($response);
$connect->close();
?>
