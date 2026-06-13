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
    <title>Checkout - CakeYa</title>
</head>
<style>
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
        height: 250px; 
        background-size: cover;
        background-position: center;
        background-repeat: no-repeat;
        background-attachment: fixed;
    }

    .booking-form .form-label {
        font-weight: 500;
        margin-bottom: 8px;
        color: #333;
    }

    .custom-input {
        border: 1px solid #777; 
        border-radius: 12px;    
        padding: 10px 15px;
        transition: all 0.3s ease;
    }

    .custom-input:focus {
        border-color: #333;
        box-shadow: none;       
    }

    .btn-wa {
        background-color: #25D366;
        color: white;
        border-radius: 12px;
        padding: 12px 40px;
        font-size: 1.1rem;
        border: none;
        transition: background-color 0.3s ease;
        font-weight: bold;
    }

    .btn-wa:hover {
        background-color: #128C7E;
        color: white;
    }
    
    .btn-wa:disabled {
        background-color: #a5d6a7;
        cursor: not-allowed;
    }

    .order-summary {
        background-color: #f8f9fa;
        border-radius: 15px;
        border: 1px solid #ddd;
        padding: 20px;
    }

    @media (max-width: 576px) {
        .booking-form { padding: 0 10px; }
    }
</style>
<body>
    @include('partials.navbar')

    <div class="container-fluid p-0">
        <div class="bg-hero d-flex align-items-center justify-content-center text-center text-white shadow-1-strong">
            <div>
                <h1 class="display-5 fw-bold">CHECKOUT</h1>
            </div>
        </div>
    </div>

    <div class="container my-5">
        <div class="row">
            
            <div class="col-md-5 mb-4 mb-md-0">
                <div class="order-summary shadow-sm">
                    <h4 class="fw-bold mb-4 text-danger">Order Summary</h4>
                    
                    <div id="checkout-items-container">
                        </div>
                    
                    <div class="d-flex justify-content-between mt-4 border-top pt-3">
                        <span class="fs-5 fw-bold">Total Payment</span>
                        <span class="fs-4 fw-bold text-danger" id="cart-total">Rp 0</span>
                    </div>
                </div>
            </div>

            <div class="col-md-7 ps-md-4">
                <h3 class="fw-bold mb-4">Delivery Details</h3>
                
                <form id="whatsapp-checkout-form" class="booking-form">
                    
                    <div class="mb-3">
                        <label for="customer_name" class="form-label">Full Name</label>
                        <input type="text" class="form-control custom-input" id="customer_name" placeholder="John Doe" required>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="customer_phone" class="form-label">WhatsApp Number</label>
                            <input type="tel" class="form-control custom-input" id="customer_phone" placeholder="081234567890" required>
                        </div>
                        <div class="col-md-6 mt-3 mt-md-0">
                            <label for="payment_method" class="form-label">Payment Method</label>
                            <select class="form-control custom-input" id="payment_method" required>
                                <option value="Bank Transfer (BCA)">Bank Transfer (BCA)</option>
                                <option value="Cash on Delivery (COD)">Cash on Delivery (COD)</option>
                            </select>
                        </div>
                    </div>

                    <div class="mb-4">
                        <label for="delivery_address" class="form-label">Complete Delivery Address</label>
                        <textarea class="form-control custom-input" id="delivery_address" rows="4" placeholder="Street Name, Building, City" required></textarea>
                    </div>

                    <button type="submit" id="btn-submit-order" class="btn btn-wa w-100 d-flex align-items-center justify-content-center gap-2">
                        <svg width="24" height="24" fill="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51a12.8 12.8 0 0 0-.57-.01c-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 0 1-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 0 1-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 0 1 2.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0 0 12.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 0 0 5.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 0 0-3.48-8.413Z"/>
                        </svg>
                        Send Order to WhatsApp
                    </button>
                </form>

            </div>
        </div>
    </div>

    <footer class="footer">
        <div class="container-fluid p-3 bg-danger">
            <p class="text-white align-items-center justify-content-center text-center p-4">Situswebp@2026.copyright</p>
        </div>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // 1. Fetch cart from local storage
            let cart = JSON.parse(localStorage.getItem('cakeya_cart')) || [];
            
            const container = document.getElementById('checkout-items-container');
            const totalDisplay = document.getElementById('cart-total');
            const submitBtn = document.getElementById('btn-submit-order');
            
            let totalPrice = 0;
            let cartItemsTextForWA = ""; // This will hold the formatted string for the WA message

            // 2. Populate the Summary UI
            if (cart.length === 0) {
                container.innerHTML = '<p class="text-muted fst-italic">Your cart is currently empty.</p>';
                submitBtn.disabled = true; // Prevent checking out an empty cart
            } else {
                cart.forEach(item => {
                    let itemTotal = item.price * item.quantity;
                    totalPrice += itemTotal;
                    
                    let formattedPrice = new Intl.NumberFormat('id-ID').format(itemTotal);
                    
                    // Add to UI
                    container.innerHTML += `
                        <div class="d-flex justify-content-between mb-3 border-bottom pb-2">
                            <span>${item.name} <strong>(x${item.quantity})</strong></span>
                            <span class="fw-bold">Rp ${formattedPrice}</span>
                        </div>
                    `;

                    // Add to WhatsApp Text String
                    cartItemsTextForWA += `- ${item.name} (x${item.quantity}) : Rp ${formattedPrice}\n`;
                });
                
                totalDisplay.innerText = 'Rp ' + new Intl.NumberFormat('id-ID').format(totalPrice);
            }

            // 3. Handle Form Submission
            document.getElementById('whatsapp-checkout-form').addEventListener('submit', function(e) {
                e.preventDefault(); 

                const merchantWhatsApp = "628139662379"; 
                const name = document.getElementById('customer_name').value;
                const phone = document.getElementById('customer_phone').value;
                const address = document.getElementById('delivery_address').value;
                const paymentMethod = document.getElementById('payment_method').value;
                
                const totalAmountStr = totalDisplay.innerText;

                const messageTemplate = 
`Halo CakeYa! Saya ingin melakukan pemesanan. 🍰

*Detail Pemesan:*
👤 Nama: ${name}
📞 No. HP: ${phone}
📍 Alamat Pengiriman: 
${address}
💳 Metode Pembayaran: ${paymentMethod}

*Daftar Pesanan:*
${cartItemsTextForWA}
*Total Pembayaran: ${totalAmountStr}*

Mohon info ketersediaan pesanan saya. Terima kasih!`;

                const encodedMessage = encodeURIComponent(messageTemplate);
                const waLink = `https://wa.me/${merchantWhatsApp}?text=${encodedMessage}`;
                
                window.open(waLink, '_blank');
            });
        });
    </script>
</body>
</html>