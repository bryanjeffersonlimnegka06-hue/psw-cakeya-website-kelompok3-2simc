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
    <title>About us</title>
</head>
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
    .bg-hero-last-section {
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
    url("{{ asset('image/kardiganteng2.jpg') }}");
    height: 400px;
    /* Adjust as needed */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    /* Optional: adds a parallax effect */
}

    .card-hover {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .card-hover:hover {
        transform: translateY(-10px); /* Lifts the card up slightly */
        box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15); /* Adds a soft drop shadow */
    }
</style>
<body>
    @include('partials.navbar')

    <!-- Content Section -->
    <div class="container-fluid p-0">
        <div class="bg-hero d-flex align-items-center justify-content-center text-center text-white shadow-1-strong">
            <div>
                <h1 class="display-5 fw-bold">About Us</h1>
                <p class="p-3 pl-5 pr-5">Welcome to my Website. This Website will make you feel enjoyed because of the futuristic UI and make you more understand the concept of this website. Content Coming Soon... Please wait until this website is release...</p>
            </div>
        </div>
    </div>

    <!-- Hero Section -->
    <div class="container-fluid bg-light p-4">
        <div class="row gap-4 align-items-center">
            <div class="col-md-8 p-5">
                <h1 class="text-start mb-4 display-5">We Provide a <br><span class="text-danger">HIGH QUALITY</span> Product</h1>
                <p class="text-start">We are committed to delivering the best services to our clients. Our team of experts is dedicated to ensuring your satisfaction. Iorem ipsum dolor sit amet, consectetur adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-md-4 p-5">
                <img src="image/stroberryhd.png" alt="Company Image" class="img-fluid">
            </div>
        </div>
    </div>

    <!-- Container Benefits -->
    <div class="container-fluid bg-light">
        <div class="row p-5 align-items-center" id="best-seller">
            <div class="col-12 mb-4">
                <h1 class="display-5 text-danger">Benefits</h1>
                <p>Discover the numerous benefits of choosing our products...</p>
            </div> 
            <div class="row g-4 card-grid p-3">
                <div class="col-sm-12 col-md-4 mb-4">
                    <div class="card h-150 rounded card-hover" style="height: 100%;">
                        <div class="card-body">
                            <img src="image/nastar48k.png" alt="Best Seller" srcset="" class="img-fluid mb-3 rounded">
                            <h4 class="card-title">Premium Ingredients</h4>
                            <p class="card-text">We use only the finest butter, real fruit jams, and premium cheeses to ensure every bite is absolute perfection.</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-4">
                    <div class="card h-150 rounded card-hover" style="height: 100%;">
                        <div class="card-body">
                            <img src="image/stroberryhd.png" alt="Best Seller" srcset="" class="img-fluid mb-3 rounded">
                            <h4 class="card-title">Rich & Savory Bites</h4>
                            <p class="card-text">Craving something savory? Our premium cheese pastries offer a satisfying, golden crunch loaded with real cheddar.</p> 
                        </div>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4 mb-4">
                    <div class="card h-150 rounded card-hover" style="height: 100%;">
                        <div class="card-body">
                            <img src="image/kastengel45k.png" alt="Best Seller" srcset="" class="img-fluid mb-3 rounded">
                            <h4 class="card-title">Perfect for Any Occasion</h4>
                            <p class="card-text">Elegantly packaged and ready to share, making them ideal gift for holidays, family gatherings, or a personal treat.</p>
                        </div>
                    </div>
                </div>
            </div> 
        </div>
    </div>

    <!-- High Services Sections -->
    <div class="container-fluid bg-light p-0">
        <div class="card border-0 rounded-0 overflow-hidden bg-light" style="isolation: isolate;">
            <div class="row g-0">          
                <div class="col-md-5 col-lg-8 p-5 p-md-5 position-relative z-1">
                    <h1 class="fw-bold mb-4 display-5 text-danger p-4">High Quality Services</h1>
                    <ol class="ps-4 mb-0 text-muted">
                        <li class="mb-3 text-dark">Custom Orders: Tailer-made cakes, cookies, and pastries for your special events.</li>
                        <li class="mb-3 text-dark">Daily Fresh Batches: Signature goods baked fresh from scratch every single morning.</li>
                        <li class="mb-3 text-dark">Local Delivery: Fast and Secure packaging delivered right to your doorstep.</li>
                    </ol>
                </div>

                <div class="col-md-7 col-lg-4 position-relative image-container" style="min-height: 500px;">
                    <div class="position-absolute top-50 translate-middle-y end-0" style="height: 150%; width: 150%; aspect-ratio: 1/1;">
                        <img src="image/BoluStimCoklatKeju_WAR0025.png" alt="Cake Model" class="w-100 h-100 rounded-circle bg-light" style="object-fit: cover;">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Section To More Products -->
    <div class="container-fluid p-0">
        <div class="bg-hero-last-section d-flex align-items-center justify-content-center text-center text-white shadow-1-strong">
            <div>
                <h1 class="display-5 fw-bold">Interesting with our Cakes? <span class="text-danger">Click Here</span></h1>
                <div class="container-fluid align-items-center justify-content-center text-center text-white p-2">
                    <a href="{{ route('product') }}">
                        <button type="button" class="btn btn-danger justify-content-center text-white">Products</button>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container-fluid p-3 bg-danger">
            <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
                <div class="container-fluid p-1 pl-5 pr-5">
                    <a href="{{ route('home') }}" class="navbar-brand">
                        <img src="image/CakeYa-logo.PNG" alt="CakeYa Logo" class="img-fluid" style="max-height: 70px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#footerNavbarNavAbout">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="footerNavbarNavAbout">
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
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
