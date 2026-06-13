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
/* Styling for the Contact Section */
.contact-info h4 {
    margin-bottom: 5px;
    font-size: 1.25rem;
}

.contact-info p {
    color: #555;
    line-height: 1.6;
}

/* Mobile specific tweaks for Contact Section */
@media (max-width: 768px) {
    .contact-info {
        text-align: center; /* Center text on phones */
    }
    
    iframe {
        height: 300px; /* Shorter map on phones */
    }
}
</style>
<body>
    @include('partials.navbar')

    <!-- Contact Us Section -->
<div class="container-fluid bg-white p-5">
    <div class="text-center mb-5">
        <h2 class="fw-bold">CONTACT US</h2>
    </div>

    <div class="row align-items-center justify-content-center">
        <!-- Left Side: Google Maps Embed -->
        <div class="col-md-6 mb-4 mb-md-0">
            <div class="ratio ratio-4x3 shadow-sm rounded overflow-hidden">
                <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d498.63135440163376!2d104.0967286!3d1.1238362!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x31d989c56c102ba7%3A0x69342b0539b26c5a!2sCake%20Ya!5e0!3m2!1sen!2sid!4v1777534336796!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>

        <!-- Right Side: Contact Details -->
        <div class="col-md-4 ps-md-5">
            <div class="contact-info">
                <div class="mb-4">
                    <h4 class="fw-bold text-danger">No :</h4>
                    <p class="fs-5">+62 8139662379</p>
                </div>

                <div class="mb-4">
                    <h4 class="fw-bold text-danger">Location :</h4>
                    <p class="fs-5">Ruko Marbella, Blok A2 No.3, Belian, Kec. Batam Kota, Kota Batam, Kepulauan Riau 29432</p>
                </div>
                
                <div class="mt-4">
                    <a href="https://maps.app.goo.gl/38dyqoVM4yvFnspm8" target="_blank" class="btn btn-outline-danger">
                        Open in Google Maps
                    </a>
                </div>
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
                        <img src="/image/CakeYa-logo.PNG" alt="CakeYa Logo" class="img-fluid" style="max-height: 70px;">
                    </a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#footerNavbarNavContact">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="footerNavbarNavContact">
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
