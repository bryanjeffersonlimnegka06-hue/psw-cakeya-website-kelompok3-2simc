
@php
    $cakes = collect($cakes ?? []);
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Google+Sans:ital,opsz,wght@0,17..18,400..700;1,17..18,400..700&family=Jost:ital,wght@0,100..900;1,100..900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css" rel="stylesheet">
    <title>Products - CakeYa</title>
</head>
<style>
    * { font-family: 'Google Sans', 'Jost', 'Poppins', sans-serif; }
    .nav-link { color: white; }
    .bg-hero {
        background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)), url('image/sectionbackground.png');
        height: 400px; background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;
    }
    .bg-hero-last-section {
        background: linear-gradient(rgba(38, 38, 38, 0.6), rgba(50, 50, 50, 0.6));
        height: 300px; background-size: cover; background-position: center; background-repeat: no-repeat; background-attachment: fixed;
    }
    
    .navbar .container-fluid {
        padding-left: 3rem !important;
        padding-right: 3rem !important;
    }

    .product-toolbar {
        display: grid;
        grid-template-columns: minmax(240px, 1fr) 220px;
        gap: 14px;
        max-width: 900px;
        margin: 0 auto 28px;
    }

    .product-toolbar .form-control,
    .product-toolbar .form-select {
        border-radius: 8px;
        min-height: 46px;
        box-shadow: none;
    }

    .product-list-container {
        display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); gap: 22px; padding: 20px;
    }
    .card-horizontal {
        display: flex; flex-direction: column; background: #fff; border: 1px solid #eee;
        border-radius: 10px; overflow: hidden; box-shadow: 0 4px 10px rgba(0,0,0,0.05);
        transition: transform 0.2s, box-shadow 0.2s; text-align: center; height: 100%; align-self: start;
        cursor: pointer;
    }
    .card-horizontal:hover { transform: translateY(-5px); box-shadow: 0 12px 24px rgba(0,0,0,0.1); }
    .card-horizontal img {
        width: 100%; aspect-ratio: 16 / 9; height: auto; object-fit: cover; order: -1;
    }
    .card-horizontal .content { padding: 16px; display: flex; flex-direction: column; justify-content: space-between; flex: 1; }
    .product-title { font-size: 1rem; margin-bottom: 8px; color: #333; font-weight: bold; min-height: 2.5rem; display: flex; align-items: center; justify-content: center; }
    .product-price { font-weight: bold; color: #dc3545; margin-bottom: 14px; font-size: 1.05rem; }
    .product-detail-img { width: 100%; aspect-ratio: 16 / 9; object-fit: cover; border-radius: 10px; }
    .product-detail-desc { color: #666; line-height: 1.6; white-space: pre-wrap; }

    /* Custom Input for Checkout Modal */
    .custom-input { border: 1px solid #777; border-radius: 12px; padding: 10px 15px; transition: all 0.3s ease; }
    .custom-input:focus { border-color: #333; box-shadow: none; }

    /* Carousel / Banner Styles */
    .banner-img { height: 550px; object-fit: cover; }
    .custom-ctrl { width: 10%; transition: background 0.3s ease; opacity: 0; }
    #cakeBanner:hover .custom-ctrl { opacity: 1; }
    .carousel-control-prev.custom-ctrl { background: linear-gradient(to right, rgba(0,0,0,0.3), transparent); }
    .carousel-control-next.custom-ctrl { background: linear-gradient(to left, rgba(0,0,0,0.3), transparent); }

    @media (max-width: 768px) {
        .banner-img { height: 250px !important; }
        .navbar .container-fluid {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        .product-toolbar { grid-template-columns: 1fr; }
        .product-list-container { grid-template-columns: repeat(2, minmax(0, 1fr)); gap: 14px; padding: 8px 0; }
        .container-fluid.bg-light { padding: 2rem 1rem !important; }
        .card-horizontal .content { padding: 12px; }
        .product-title { font-size: 0.95rem; min-height: 2.4rem; }
        .product-price { font-size: 0.95rem; }
    }

       .bg-hero-last-section {
    background: linear-gradient(rgba(0, 0, 0, 0.6), rgba(0, 0, 0, 0.6)),
    url("/image/kardiganteng2.jpg");
    height: 400px;
    /* Adjust as needed */
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    background-attachment: fixed;
    /* Optional: adds a parallax effect */
}

    @media (max-width: 420px) {
        .product-list-container { grid-template-columns: 1fr; }
    }
</style>
<body>
    @include('partials.navbar')
    
    <!-- Cart Icon for Mobile -->
    <style>
        @media (max-width: 768px) {
            #cartMobileIcon {
                position: fixed;
                bottom: 20px;
                right: 20px;
                z-index: 1000;
            }
        }
    </style>
    <div id="cartMobileIcon" class="d-lg-none">
        <a href="#" class="btn btn-danger rounded-circle position-relative" style="width: 50px; height: 50px; display: flex; align-items: center; justify-content: center;" data-bs-toggle="offcanvas" data-bs-target="#cartOffcanvas">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="white" viewBox="0 0 16 16">
                <path d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .491.592l-1.5 8A.5.5 0 0 1 13 12H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5zM3.102 4l1.313 7h8.17l1.313-7H3.102zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4zm-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2zm7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/>
            </svg>
            <span id="cart-badge-mobile" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-danger" style="display: none; font-size: 0.75rem;">0</span>
        </a>
    </div>

    <div id="cakeBanner" class="carousel slide carousel-fade container-fluid p-0 justify-content-center dark-bg" data-bs-ride="carousel">
        <h1 class="text-white text-center" style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 500; margin: 0; text-shadow: 2px 2px 4px rgba(0,0,0,0.5);">
            Our Products
        </h1>
        <div class="carousel-indicators">
            @if ($cakes->isNotEmpty())
                @foreach ($cakes as $index => $row)
                    <button type="button" data-bs-target="#cakeBanner" data-bs-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}"></button>
                @endforeach
            @endif
        </div>

        <div class="carousel-inner" style="filter: brightness(60%);">
            @forelse ($cakes as $row)
                @php
                    $imageName = $row->pic ?: 'default_cake.jpg';
                    $imageUrl = asset('product-image/' . $imageName);
                @endphp
                    <div class="carousel-item {{ $loop->first ? 'active' : '' }}" data-bs-interval="4000">
                        <img src="{{ $imageUrl }}" class="d-block w-100 banner-img" alt="{{ $row->cake_name }}">
                    </div>
            @empty
                <div class="carousel-item active" data-bs-interval="4000">
                    <img src="/image/sectionbackground.png" class="d-block w-100 banner-img" alt="CakeYa Products">
                </div>
            @endforelse
        </div>
        
        <button class="carousel-control-prev custom-ctrl" type="button" data-bs-target="#cakeBanner" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next custom-ctrl" type="button" data-bs-target="#cakeBanner" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <div class="container-fluid bg-light p-5">
        <div class="text-center mb-5">
            <h2 class="font-weight-bold">PRODUCT LIST</h2>
        </div>

        <div class="product-toolbar">
            <input type="search" id="productSearch" class="form-control" placeholder="Search products">
            <select id="productFilter" class="form-select">
                <option value="default">Default</option>
                <option value="name-asc">Name A-Z</option>
                <option value="name-desc">Name Z-A</option>
                <option value="price-asc">Price Low to High</option>
                <option value="price-desc">Price High to Low</option>
            </select>
        </div>

        <div class="product-list-container">
            @forelse ($cakes as $row)
                @php
                    $imageName = $row->pic ?: 'default_cake.jpg';
                    $imageUrl = asset('product-image/' . $imageName);
                    $price = (float) $row->cost;
                @endphp
                    <div class="card-horizontal js-product-card"
                        role="button"
                        tabindex="0"
                        data-name="{{ $row->cake_name }}"
                        data-price="{{ $price }}"
                        data-price-label="Rp {{ number_format($price, 0, ',', '.') }}"
                        data-description="{{ $row->description ?: 'No description available.' }}"
                        data-image="{{ $imageUrl }}">
                        <div class="content">
                            <div>
                                <h4 class="product-title">{{ $row->cake_name }}</h4>
                                <div class="product-price">Rp {{ number_format($price, 0, ',', '.') }}</div>
                            </div>

                            <button type="button"
                                class="btn btn-danger w-100 mt-2 fw-bold align-self-center js-add-to-cart"
                                data-name="{{ $row->cake_name }}"
                                data-price="{{ $price }}"
                                data-image="{{ $imageUrl }}">
                                Add to Cart
                            </button>
                        </div>
                        <img src="{{ $imageUrl }}" alt="{{ $row->cake_name }}">
                    </div>
            @empty
                <p class="text-center w-100 col-span-2">No cakes found in the database.</p>
            @endforelse
        </div>
        <p id="noProductsMessage" class="text-center text-muted mt-4" style="display: none;">No products match your search.</p>
    </div>

    <div class="container-fluid p-0">
        <div class="bg-hero-last-section d-flex align-items-center justify-content-center text-center text-white">
            <div>
                <h1 class="display-5 fw-bold">Want to Make a Custom Order? <span class="text-danger">Book Us!</span></h1>
                <div class="p-2 mt-3">
                    <a href="{{ route('book') }}" class="btn btn-danger text-white px-5 py-2 fw-bold">Book Custom Cake</a>
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
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
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
    
    <div class="offcanvas offcanvas-end shadow" tabindex="-1" id="cartOffcanvas">
        <div class="offcanvas-header bg-danger text-white">
            <h5 class="offcanvas-title fw-bold">🛒 Your Shopping Cart</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <div id="cart-items-container" class="flex-grow-1 overflow-auto">
                </div>
            <div class="border-top pt-3 mt-3">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <span class="fs-5 fw-bold">Total:</span>
                    <span class="fs-4 fw-bold text-danger" id="cart-total-price">Rp 0</span>
                </div>
                <button type="button" class="btn btn-danger w-100 py-3 fw-bold rounded-3" data-bs-toggle="modal" data-bs-target="#checkoutModal" onclick="prepareModalCheckout()">
                    Proceed to Checkout
                </button>
            </div>
        </div>
    </div>

    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0" style="border-radius: 15px;">
                <div class="modal-header bg-danger text-white" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="modal-title fw-bold" id="detail-product-name">Product Detail</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body p-4">
                    <div class="row g-4 align-items-start">
                        <div class="col-md-6">
                            <img id="detail-product-image" src="" alt="" class="product-detail-img">
                        </div>
                        <div class="col-md-6">
                            <h3 class="fw-bold mb-2" id="detail-product-title"></h3>
                            <div class="fs-4 fw-bold text-danger mb-3" id="detail-product-price"></div>
                            <p class="product-detail-desc mb-4" id="detail-product-description"></p>
                            <button type="button" class="btn btn-danger w-100 py-3 fw-bold js-detail-add-to-cart">
                                Add to Cart
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="checkoutModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content border-0" style="border-radius: 15px;">
                <div class="modal-header bg-danger text-white" style="border-top-left-radius: 15px; border-top-right-radius: 15px;">
                    <h5 class="modal-title fw-bold">📦 Delivery Details</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
                </div>
                
                <div class="modal-body p-4">
                    <div class="bg-light p-3 rounded-3 mb-4 border d-flex justify-content-between align-items-center">
                        <span class="fw-bold text-secondary">Total Payment:</span>
                        <span class="fs-4 fw-bold text-danger" id="modal-total-display">Rp 0</span>
                    </div>

                    <form id="whatsapp-modal-form" class="booking-form">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control custom-input" id="modal_customer_name" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label class="form-label">WhatsApp Number</label>
                                <input type="tel" class="form-control custom-input" id="modal_customer_phone" required>
                            </div>
                            <div class="col-md-6 mt-3 mt-md-0">
                                <label class="form-label">Payment Method</label>
                                <select class="form-control custom-input" id="modal_payment_method" required>
                                    <option value="Bank Transfer">Bank Transfer (BCA)</option>
                                    <option value="Cash on Delivery (COD)">Cash on Delivery (COD)</option>
                                </select>
                            </div>
                        </div>
                        <div class="mb-4">
                            <label class="form-label">Complete Delivery Address</label>
                            <textarea class="form-control custom-input" id="modal_delivery_address" rows="3" required></textarea>
                        </div>
                        <button type="submit" id="btn-modal-submit" class="btn w-100 py-3 text-white fw-bold d-flex justify-content-center align-items-center gap-2" style="background-color: #25D366; border-radius: 12px;">
                            <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/></svg>
                            Order via WhatsApp
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let cart = JSON.parse(localStorage.getItem('cakeya_cart')) || [];

        function addToCart(name, price, image) {
            let existingItem = cart.find(item => item.name === name);
            if (existingItem) {
                existingItem.quantity += 1;
            } else {
                cart.push({ name: name, price: price, image: image, quantity: 1 });
            }
            saveCart();
            updateCartUI();
            
            // Auto open side panel
            var offcanvasElement = document.getElementById('cartOffcanvas');
            var cartOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement) || new bootstrap.Offcanvas(offcanvasElement);
            cartOffcanvas.show();
        }

        function openProductDetail(card) {
            const modalElement = document.getElementById('productDetailModal');
            const addButton = modalElement.querySelector('.js-detail-add-to-cart');

            document.getElementById('detail-product-name').innerText = card.dataset.name;
            document.getElementById('detail-product-title').innerText = card.dataset.name;
            document.getElementById('detail-product-price').innerText = card.dataset.priceLabel;
            document.getElementById('detail-product-description').innerText = card.dataset.description;
            document.getElementById('detail-product-image').src = card.dataset.image;
            document.getElementById('detail-product-image').alt = card.dataset.name;

            addButton.dataset.name = card.dataset.name;
            addButton.dataset.price = card.dataset.price;
            addButton.dataset.image = card.dataset.image;

            const productModal = bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
            productModal.show();
        }

        function applyProductFilters() {
            const grid = document.querySelector('.product-list-container');
            const cards = Array.from(document.querySelectorAll('.js-product-card'));
            const searchTerm = document.getElementById('productSearch').value.trim().toLowerCase();
            const sortValue = document.getElementById('productFilter').value;
            const noProductsMessage = document.getElementById('noProductsMessage');

            cards.sort((a, b) => {
                const nameA = a.dataset.name.toLowerCase();
                const nameB = b.dataset.name.toLowerCase();
                const priceA = Number(a.dataset.price);
                const priceB = Number(b.dataset.price);

                if (sortValue === 'name-asc') return nameA.localeCompare(nameB);
                if (sortValue === 'name-desc') return nameB.localeCompare(nameA);
                if (sortValue === 'price-asc') return priceA - priceB;
                if (sortValue === 'price-desc') return priceB - priceA;
                return 0;
            });

            let visibleCount = 0;
            cards.forEach((card) => {
                const isVisible = card.dataset.name.toLowerCase().includes(searchTerm);
                card.style.display = isVisible ? '' : 'none';
                if (isVisible) visibleCount += 1;
                grid.appendChild(card);
            });

            noProductsMessage.style.display = visibleCount === 0 ? 'block' : 'none';
        }

        function removeFromCart(index) {
            cart.splice(index, 1);
            saveCart();
            updateCartUI();
        }

        function saveCart() {
            localStorage.setItem('cakeya_cart', JSON.stringify(cart));
        }

        function updateCartUI() {
            const container = document.getElementById('cart-items-container');
            const badges = [
                document.getElementById('cart-badge'),
                document.getElementById('cart-badge-mobile')
            ].filter(Boolean);
            const totalDisplay = document.getElementById('cart-total-price');
            
            let totalItems = 0;
            let totalPrice = 0;
            container.innerHTML = ''; 
            
            if (cart.length === 0) {
                container.innerHTML = '<p class="text-center text-muted mt-5">Your cart is currently empty.</p>';
                badges.forEach((badge) => {
                    badge.style.display = 'none';
                });
                totalDisplay.innerText = 'Rp 0';
                return;
            }

            cart.forEach((item, index) => {
                totalItems += item.quantity;
                totalPrice += (item.price * item.quantity);
                let formattedPrice = new Intl.NumberFormat('id-ID').format(item.price * item.quantity);
                
                container.innerHTML += `
                    <div class="d-flex align-items-center mb-3 pb-3 border-bottom">
                        <img src="${item.image}" class="rounded border" style="width: 60px; height: 60px; object-fit: cover;">
                        <div class="ms-3 flex-grow-1">
                            <h6 class="mb-0 fw-bold">${item.name}</h6>
                            <small class="text-muted">Rp ${new Intl.NumberFormat('id-ID').format(item.price)} x ${item.quantity}</small>
                            <div class="fw-bold text-danger mt-1">Rp ${formattedPrice}</div>
                        </div>
                        <button class="btn btn-sm btn-outline-danger border-0" onclick="removeFromCart(${index})">X</button>
                    </div>
                `;
            });
            
            badges.forEach((badge) => {
                badge.innerText = totalItems;
                badge.style.display = 'block';
            });
            totalDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
        }

        function prepareModalCheckout() {
            // Close side panel
            var offcanvasElement = document.getElementById('cartOffcanvas');
            var cartOffcanvas = bootstrap.Offcanvas.getInstance(offcanvasElement);
            if(cartOffcanvas) cartOffcanvas.hide();

            // Calculate Total for Modal
            let modalTotal = 0;
            cart.forEach(item => { modalTotal += (item.price * item.quantity); });
            document.getElementById('modal-total-display').innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(modalTotal);
            
            if(cart.length === 0) {
                document.getElementById('btn-modal-submit').disabled = true;
                document.getElementById('btn-modal-submit').innerText = "Cart is Empty";
            } else {
                document.getElementById('btn-modal-submit').disabled = false;
            }
        }

        // Handle WhatsApp Submission
        document.getElementById('whatsapp-modal-form').addEventListener('submit', function(e) {
            e.preventDefault(); 
            if(cart.length === 0) return;

            const merchantWhatsApp = "628116666837"; 
            const name = document.getElementById('modal_customer_name').value;
            const phone = document.getElementById('modal_customer_phone').value;
            const address = document.getElementById('modal_delivery_address').value;
            const paymentMethod = document.getElementById('modal_payment_method').value;
            const totalAmountStr = document.getElementById('modal-total-display').innerText;

            let cartItemsText = "";
            cart.forEach(item => {
                let formattedPrice = new Intl.NumberFormat('id-ID').format(item.price * item.quantity);
                cartItemsText += `- ${item.name} (x${item.quantity}) : Rp ${formattedPrice}\n`;
            });

            const messageTemplate = 
`Halo CakeYa! Saya ingin melakukan pemesanan.\n
*Detail Pemesan:*
Nama: ${name}
No. HP: ${phone}
Alamat Pengiriman: ${address}
Metode Pembayaran: ${paymentMethod}\n
*Daftar Pesanan:*
${cartItemsText}
*Total Pembayaran: ${totalAmountStr}*\n
Mohon info ketersediaan pesanan saya. Terima kasih!`;

            // Clear Cart & Redirect
            localStorage.removeItem('cakeya_cart');
            window.open(`https://wa.me/${merchantWhatsApp}?text=${encodeURIComponent(messageTemplate)}`, '_blank');
            window.location.reload(); 
        });

        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.js-product-card').forEach((card) => {
                card.addEventListener('click', function(event) {
                    if (event.target.closest('.js-add-to-cart')) {
                        return;
                    }

                    openProductDetail(this);
                });

                card.addEventListener('keydown', function(event) {
                    if (event.key === 'Enter' || event.key === ' ') {
                        event.preventDefault();
                        openProductDetail(this);
                    }
                });
            });

            document.querySelectorAll('.js-add-to-cart').forEach((button) => {
                button.addEventListener('click', function() {
                    addToCart(
                        this.dataset.name,
                        Number(this.dataset.price),
                        this.dataset.image
                    );
                });
            });

            document.querySelector('.js-detail-add-to-cart').addEventListener('click', function() {
                addToCart(
                    this.dataset.name,
                    Number(this.dataset.price),
                    this.dataset.image
                );

                const productModal = bootstrap.Modal.getInstance(document.getElementById('productDetailModal'));
                if (productModal) productModal.hide();
            });

            document.getElementById('productSearch').addEventListener('input', applyProductFilters);
            document.getElementById('productFilter').addEventListener('change', applyProductFilters);

            updateCartUI();
        });
    </script>
</body>
</html>
