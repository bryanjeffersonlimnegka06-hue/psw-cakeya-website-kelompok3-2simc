<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>Home</title>
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
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
    url("{{ asset('image/kardiganteng.jpg') }}");
    height: 400px;
    /* Adjust as needed */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    /* Optional: adds a parallax effect */
}

.card-grid {
    display: flex;
    flex-wrap: wrap;
    width: 100%;
}

.bg-hero-last-section {
    background:
        linear-gradient(rgba(38, 38, 38, 0.6), rgba(50, 50, 50, 0.6));
    height: 300px;
    /* Adjust as needed */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    /* Optional: adds a parallax effect */
}

#best-seller-card {
    border: none;
    border-radius: 15px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    gap: 20px;
}

.card-hover {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.card-hover:hover {
    transform: translateY(-10px);
    /* Lifts the card up slightly */
    box-shadow: 0 12px 24px rgba(0, 0, 0, 0.15);
    /* Adds a soft drop shadow */
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
</style>

<body>
    @include('partials.navbar')

    <div class="container-fluid bg-light">
        <div class="row gap-4 align-items-center">
            <div class="col-md-8 p-5">
                <h1 class="text-start mb-4 display-5">Welcome to <span class="text-danger">CakeYa!</span></h1>
                <p class="text-start">We are committed to delivering the best services to our clients. Our team of
                    experts is dedicated to ensuring your satisfaction. Iorem ipsum dolor sit amet, consectetur
                    adipiscing elit. Sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
            </div>
            <div class="col-md-4 p-5">
                <img src="image/BoluStimKetanCoklat_WAR0004.png" alt="Company Image" class="img-fluid">
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div class="bg-hero d-flex align-items-center justify-content-center text-center text-white shadow-1-strong">
            <div>
                <h1 class="display-5 fw-bold">We Provide High Quality Cake</h1>
                <p class="p-3 pl-5 pr-5">Welcome to my Website. This Website will make you feel enjoyed because of the
                    futuristic UI and make you more understand the concept of this website. Content Coming Soon...
                    Please wait until this website is release...</p>
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light">
        <div class="row p-5 align-items-center" id="best-seller">
            <div class="col-12 mb-4">
                <h1 class="display-5 text-danger">Best Seller</h1>
                <p>Discover our best-selling cakes that have delighted customers with their irresistible flavors and
                    exquisite designs...</p>
            </div>

            <div class="row g-4 card-grid p-3">
                @foreach($bestSellers->shuffle() as $cake)
                <div class="col-sm-12 col-md-4 mb-4" style="height: 100%;">
                    <div class="card h-100 rounded card-hover">
                        <div class="card-body">
                            <img src="{{ asset('product-image/' . $cake->pic) }}" alt="{{ $cake->cake_name }}"
                                class="img-fluid mb-3 rounded" style="object-fit: cover; height: 40%; width: 100%;">
                            <h4 class="card-title">{{ $cake->cake_name }}</h4>
                            <p class="card-text" style="font-size: 13px;">{{ $cake->description }}</p>
                        </div>
                    </div> 
                </div>
                @endforeach
            </div>
        </div>
    </div>

    <div class="container-fluid bg-light">
        <div class="row p-5 align-items-center">
            <div class="col-12 mb-4">
                <h1 class="display-5 text-danger">Our Product</h1>
                <p>Discover our best-selling cakes that have delighted customers with their irresistible flavors and
                    exquisite designs...</p>
            </div>
            <div class="row g-4 card-grid p-2">
                @foreach(\DB::table('cake')->inRandomOrder()->take(3)->get() as $cake)
                <div class="col-sm-12 col-md-4 mb-4">
                    <div class="card h-100 rounded card-hover">
                        <div class="card-body p-3" style="height: 300px;">
                            <!-- Displays the randomized product image -->
                            <img src="{{ asset('product-image/' . $cake->pic) }}" alt="{{ $cake->cake_name }}"
                                class="img-fluid mb-3 rounded" style="object-fit: cover; height: 70%; width: 100%; aspect-ratio: 16 / 9;">
                            <h4 class="card-title">{{ $cake->cake_name }}</h4>
                            <p class="card-text">Price: Rp {{ $cake->cost }},00</p>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="container-fluid align-items-center justify-content-center text-center text-white p-5">
                <a href="{{ route('product') }}">
                    <button type="button" class="btn btn-danger justify-content-center">View All Products</button>
                </a>
            </div>
        </div>
    </div>

    <div class="container-fluid p-0">
        <div
            class="bg-hero-last-section d-flex align-items-center justify-content-center text-center text-white shadow-1-strong">
            <div>
                <h1 class="display-5 fw-bold">Interesting About Us? Click for more <span class="text-danger">About
                        Us</span></h1>
                <div class="container-fluid align-items-center justify-content-center text-center text-white p-2">
                    <a href="{{ route('about') }}">
                        <button type="button" class="btn btn-danger justify-content-center text-white">About Us</button>
                    </a>
                </div>
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid p-3 bg-danger">
                <nav class="navbar navbar-expand-lg navbar-dark bg-danger">
                    <div class="container-fluid p-1 pl-5 pr-5">
                        <a href="{{ route('home') }}" class="navbar-brand">
                            <img src="{{ asset('image/CakeYa-logo.PNG') }}" alt="CakeYa Logo" class="img-fluid"
                                style="max-height: 70px;">
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                            data-bs-target="#footerNavbarNavHome">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse justify-content-end" id="footerNavbarNavHome">
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
                <p class="text-white align-items-center justify-content-center text-center p-4">Situswebp@2026.copyright
                </p>
            </div>
        </footer>

        <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
