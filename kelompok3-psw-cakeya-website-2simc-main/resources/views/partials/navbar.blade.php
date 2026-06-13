<style>
    .cakeya-main-navbar {
        min-height: 50px;
        padding: 0px 0;
    }

    .cakeya-main-navbar .container-fluid {
        padding-left: 4rem !important;
        padding-right: 4rem !important;
    }

    .cakeya-main-navbar .navbar-brand img {
        max-height: 70px;
    }

    .cakeya-main-navbar .navbar-nav {
        align-items: center;
        gap: 2px;
    }

    .cakeya-main-navbar .nav-link {
        color: rgba(255, 255, 255, 0.86) !important;
        font-size: 1rem;
        font-weight: 500;
        background: transparent;
        border: 0;
        padding-left: 0.55rem !important;
        padding-right: 0.55rem !important;
        transition: color 0.2s ease, text-shadow 0.2s ease;
    }

    .cakeya-main-navbar .nav-link:hover,
    .cakeya-main-navbar .nav-link:focus,
    .cakeya-main-navbar .nav-link.active {
        color: #ffffff !important;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.35);
    }

    .cakeya-main-navbar .nav-link.active {
        font-weight: 800;
    }

    .cakeya-main-navbar .dropdown-menu .dropdown-item {
        color: #0f172a !important;
    }

    .cakeya-main-navbar .nav-item.dropdown {
        position: relative;
    }

    .cakeya-main-navbar .dropdown-menu {
        left: auto !important;
        right: 0 !important;
        min-width: 220px;
        margin-top: 0.75rem;
        border: 0;
        border-radius: 8px;
        box-shadow: 0 12px 28px rgba(15, 23, 42, 0.18);
    }

    .cakeya-main-navbar .dropdown-menu::before {
        content: "";
        position: absolute;
        top: -7px;
        right: 18px;
        width: 14px;
        height: 14px;
        background: #ffffff;
        transform: rotate(45deg);
        border-left: 1px solid rgba(0, 0, 0, 0.08);
        border-top: 1px solid rgba(0, 0, 0, 0.08);
    }

    .cakeya-main-navbar .dropdown-menu .dropdown-item {
        position: relative;
        z-index: 1;
        padding: 0.8rem 1rem;
        white-space: nowrap;
    }

    .cakeya-main-navbar .dropdown-divider {
        margin: 0;
    }

    .cakeya-scroll-up {
        position: fixed;
        left: 24px;
        bottom: 24px;
        z-index: 1050;
        width: 48px;
        height: 48px;
        border: 0;
        border-radius: 50%;
        background: #dc3545;
        color: #ffffff;
        display: flex;
        align-items: center;
        justify-content: center;
        box-shadow: 0 10px 24px rgba(0, 0, 0, 0.24);
        cursor: pointer;
        opacity: 0;
        visibility: hidden;
        transform: translateY(12px);
        transition: opacity 0.2s ease, transform 0.2s ease, visibility 0.2s ease, background 0.2s ease;
    }

    .cakeya-scroll-up:hover,
    .cakeya-scroll-up:focus {
        background: #bb2d3b;
        outline: none;
    }

    .cakeya-scroll-up.is-visible {
        opacity: 1;
        visibility: visible;
        transform: translateY(0);
    }

    .cakeya-scroll-up i {
        font-size: 1.25rem;
        line-height: 1;
    }

    @media (max-width: 991.98px) {
        .cakeya-main-navbar {
            min-height: auto;
            padding: 14px 0;
        }

        .cakeya-main-navbar .container-fluid {
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }

        .cakeya-main-navbar .navbar-nav {
            align-items: flex-start;
            gap: 0;
            padding-top: 12px;
        }

        .cakeya-main-navbar .nav-link {
            padding-left: 0 !important;
            padding-right: 0 !important;
        }

        .cakeya-main-navbar .dropdown-menu {
            position: static !important;
            right: auto !important;
            left: auto !important;
            width: 100%;
            min-width: 0;
            margin-top: 0.5rem;
            box-shadow: none;
        }

        .cakeya-main-navbar .dropdown-menu::before {
            display: none;
        }

        .cakeya-scroll-up {
            left: 18px;
            bottom: 18px;
            width: 44px;
            height: 44px;
        }
    }
</style>

<nav class="navbar navbar-expand-lg navbar-dark bg-danger cakeya-main-navbar">
    <div class="container-fluid p-1">
        <a href="{{ route('home') }}" class="navbar-brand">
            <img src="{{ asset('image/CakeYa-logo.PNG') }}" alt="CakeYa Logo" class="img-fluid">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link @if(Route::currentRouteName() === 'home') active @endif">Home</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('about') }}" class="nav-link @if(Route::currentRouteName() === 'about') active @endif">About Us</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('product') }}" class="nav-link @if(Route::currentRouteName() === 'product') active @endif">Product</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('contact') }}" class="nav-link @if(Route::currentRouteName() === 'contact') active @endif">Contact Us</a>
                </li>

                <li class="nav-item">
                    <a href="{{ route('product') }}" id="navbarCartLink" class="nav-link position-relative" aria-label="Shopping cart">
                        <i class="bi bi-cart3"></i>
                        <span id="cart-badge" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-light text-danger" style="display: none; font-size: 0.7rem;">0</span>
                    </a>
                </li>
                
                {{-- Login/User Menu --}}
                <li class="nav-item dropdown">
                    @auth
                        <button type="button" class="nav-link dropdown-toggle" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="bi bi-person-circle"></i> {{ Auth::user()->name }}
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-right" aria-labelledby="userDropdown">
                            <li>
                                <a class="dropdown-item" href="{{ route('admin.dashboard') }}">
                                    <i class="bi bi-speedometer2"></i> Admin Dashboard
                                </a>
                            </li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form method="POST" action="{{ route('admin.logout') }}" style="display: inline;">
                                    @csrf
                                    <button type="submit" class="dropdown-item" onclick="return confirm('Are you sure you want to logout?');">
                                        <i class="bi bi-box-arrow-right"></i> Logout
                                    </button>
                                </form>
                            </li>
                        </ul>
                    @else
                        <a href="{{ route('admin.login') }}" class="nav-link">
                            <i class="bi bi-box-arrow-in-right"></i> Login
                        </a>
                    @endauth
                </li>
            </ul>
        </div>
    </div>
</nav>

<button type="button" id="cakeyaScrollUp" class="cakeya-scroll-up" aria-label="Scroll to first section">
    <i class="bi bi-arrow-up"></i>
</button>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const cartLink = document.getElementById('navbarCartLink');
        const cartBadge = document.getElementById('cart-badge');
        const storedCart = JSON.parse(localStorage.getItem('cakeya_cart')) || [];
        const cartCount = storedCart.reduce((total, item) => total + Number(item.quantity || 0), 0);
        const scrollUpButton = document.getElementById('cakeyaScrollUp');

        if (cartBadge && cartCount > 0) {
            cartBadge.innerText = cartCount;
            cartBadge.style.display = 'block';
        }

        if (cartLink) {
            cartLink.addEventListener('click', function(event) {
                const cartOffcanvasElement = document.getElementById('cartOffcanvas');

                if (cartOffcanvasElement && window.bootstrap) {
                    event.preventDefault();
                    const cartOffcanvas = bootstrap.Offcanvas.getInstance(cartOffcanvasElement) || new bootstrap.Offcanvas(cartOffcanvasElement);
                    cartOffcanvas.show();
                }
            });
        }

        if (scrollUpButton) {
            const getFirstContentSection = function() {
                const nav = document.querySelector('.cakeya-main-navbar');
                let section = nav ? nav.nextElementSibling : document.body.firstElementChild;

                while (section && (
                    section.id === 'cakeyaScrollUp' ||
                    section.id === 'cartMobileIcon' ||
                    section.tagName === 'SCRIPT' ||
                    section.tagName === 'STYLE'
                )) {
                    section = section.nextElementSibling;
                }

                return section || document.body;
            };

            const toggleScrollButton = function() {
                scrollUpButton.classList.toggle('is-visible', window.scrollY > 260);
            };

            scrollUpButton.addEventListener('click', function() {
                const firstSection = getFirstContentSection();
                const navHeight = document.querySelector('.cakeya-main-navbar')?.offsetHeight || 0;
                const top = firstSection === document.body
                    ? 0
                    : Math.max(firstSection.getBoundingClientRect().top + window.pageYOffset - navHeight, 0);

                window.scrollTo({ top: top, behavior: 'smooth' });
            });

            toggleScrollButton();
            window.addEventListener('scroll', toggleScrollButton, { passive: true });
        }
    });
</script>
