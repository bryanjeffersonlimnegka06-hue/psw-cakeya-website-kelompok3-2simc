<!DOCTYPE html>
<html lang="en">
<head>
    
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>Home</title>
</head>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<style>
    * {
        font-family: 'Google Sans', 'Jost', 'Poppins', sans-serif;
    }
    .nav-link {
        color: white;
    }
    .bg-hero {
        /* 0.6 represents 60% darkness. Adjust both values to change opacity */
        background: 
            linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
            url('image/sectionbackground.png');
        height: 400px; /* Adjust as needed */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed; /* Optional: adds a parallax effect */
    }
    .card-grid{
        display: flex;
        flex-wrap: wrap;
        width: 100%;
    }

    .bg-hero-last-section{
        background: 
            linear-gradient(rgba(38, 38, 38, 0.6), rgba(50, 50, 50, 0.6));
        height: 300px; /* Adjust as needed */
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed; /* Optional: adds a parallax effect */
    }

    #best-seller-card{
        border: none;
        border-radius: 15px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        gap:20px;
    }

    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-10px); /* Lifts the card up slightly */
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15); /* Adds a soft drop shadow */
    }
    * {
        font-family: 'Google Sans', 'Jost', 'Poppins', sans-serif;
    }
    .nav-link {
        color: white;
    }
    .bg-hero {
        background: 
            linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), 
            url('image/sectionbackground.png');
        height: 400px;
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    /* Custom Form Styling */
.booking-form .form-label {
    font-weight: 500;
    margin-bottom: 8px;
    color: #333;
}

.custom-input {
    border: 1px solid #777; /* Subtle border color like the image */
    border-radius: 12px;    /* Rounded corners */
    padding: 10px 15px;
    transition: all 0.3s ease;
}

.custom-input:focus {
    border-color: #333;
    box-shadow: none;       /* Removes the default Bootstrap blue glow */
}

.btn-book {
    border-radius: 12px;
    padding: 10px 40px;
    font-size: 1.1rem;
    border: 1px solid #777;
    color: #333;
}

.btn-book:hover {
    background-color: #333;
    color: #fff;
    border-color: #333;
}

/* Ensure textarea doesn't look squashed on mobile */
@media (max-width: 576px) {
    .booking-form {
        padding: 0 10px;
    }
}

</style>
<body>
    @include('partials.navbar')
<!-- Content Section -->
    <div class="container-fluid p-0">
        <div class="bg-hero d-flex align-items-center justify-content-center text-center text-white shadow-1-strong">
            <div>
                <h1 class="display-5 fw-bold">CUSTOM ORDER</h1>
            </div>
        </div>
    </div>
    <div class="container my-5">
    <div class="row justify-content-center">
        <div class="col-md-8 col-lg-6">
            <form action="controller.php" method="POST" class="booking-form">
                
                <!-- Company / Personal Name -->
                <div class="mb-3">
                    <label for="name" class="form-label">Company / Personal Name</label>
                    <input type="text" class="form-control custom-input" id="name" name="name">
                </div>

                <!-- Mobile Number and Email (Side by Side) -->
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="mobile" class="form-label">Mobile Number</label>
                        <input type="tel" class="form-control custom-input" id="mobile" name="mobile">
                    </div>
                    <div class="col-md-6 mt-3 mt-md-0">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control custom-input" id="email" name="email">
                    </div>
                </div>

                <!-- Booking Date -->
                <div class="mb-3">
                    <label for="date" class="form-label">Booking Date</label>
                    <input type="date" class="form-control custom-input" id="date" name="date">
                </div>

                <!-- Description -->
                <div class="mb-4">
                    <label for="description" class="form-label">Description</label>
                    <textarea class="form-control custom-input" id="description" name="description" rows="5"></textarea>
                </div>

                <!-- Submit Button -->
                <div class="text-center">
                    <button type="submit" class="btn btn-outline-dark btn-book">Book Order Now</button>
                </div>

            </form>
        </div>
    </div>
</div>
    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid p-3 bg-danger">
            <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
                <div class="container-fluid p-1 pl-5 pr-5">
                    <a href="home.php" class="navbar-brand">
                        <img src="image/CakeYa-logo.PNG" alt="CakeYa Logo" class="img-fluid" style="max-height: 70px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#footerNavbarNavBook">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="footerNavbarNavBook">
                        <ul class="navbar-nav ms-auto"> 
                            <li class="nav-item">
                                <a href="{{ route('home') }}" class="nav-link">Home</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('about') }}" class="nav-link">About Us</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('product') }}" class="nav-link">Product</a>
                            </li>
                            <li class="nav-item">
                                <a href="{{ route('contact') }}" class="nav-link">Contact Us</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <hr class="border-white border-3 opacity-75">
            <p class="text-white align-items-center justify-content-center text-center p-4">Situswebp@2026.copyright</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
