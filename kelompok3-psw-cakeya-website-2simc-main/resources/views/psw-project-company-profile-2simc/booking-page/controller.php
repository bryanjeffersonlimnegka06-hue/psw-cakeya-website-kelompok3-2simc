<?php
// Database configuration
$host = "localhost";
$username = "root";
$password = "";
$database = "cake";

// Create connection
$conn = new mysqli($host, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Capture and sanitize input data
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $number = mysqli_real_escape_string($conn, $_POST['mobile']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    
    // User-selected date from the form picker
    $picked_date = mysqli_real_escape_string($conn, $_POST['date']); 
    
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    
    // Automatically set to today's date (2026-04-30)
    $today = date('Y-m-d'); 

    // Mapping based on your request:
    // 'Date' column = $picked_date (from the image picker)
    // 'BookingDate' column = $today (the date they clicked order)
    $sql = "INSERT INTO booking (Name, Number, Email, Date, Description, BookingDate) 
            VALUES ('$name', '$number', '$email', '$picked_date', '$description', '$today')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>
                alert('Booking successfully submitted!');
                window.location.href='book.php'; 
              </script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>