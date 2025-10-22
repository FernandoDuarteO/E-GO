<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>E-GO - Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --white: #FFFFFF;
            --light-purple: #EDDFFD;
            --light-purple-rgb: 224, 223, 253;
            --primary-purple: #7766C6;
            --accent-yellow: #FFC212;
            --light-bg: #EBEBEB;
        }
        
        body {
            background-color: var(--light-bg);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        
        .navbar {
            background: linear-gradient(135deg, var(--primary-purple) 0%, #5a4ba3 100%);
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand {
            font-weight: bold;
            font-size: 1.8rem;
            color: white !important;
        }
        
        .logo-text {
            background: linear-gradient(45deg, var(--accent-yellow), #ffd700);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            font-weight: 800;
        }
        
        .product-card {
            transition: transform 0.3s;
            margin-bottom: 20px;
            border: none;
            border-radius: 15px;
            overflow: hidden;
            background-color: var(--white);
            box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        }
        
        .product-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 12px 20px rgba(0,0,0,0.15);
        }
        
        .product-image {
            height: 200px;
            background-color: var(--light-purple);
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }
        
        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }
        
        .product-image .placeholder {
            color: var(--primary-purple);
            font-size: 3rem;
        }
        
        .rating {
            color: var(--accent-yellow);
        }
        
        .cart-notification {
            position: fixed;
            top: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--primary-purple), #8a7ad0);
            color: white;
            padding: 15px 25px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(119, 102, 198, 0.3);
            z-index: 1050;
            display: none;
            animation: fadeInOut 3s ease-in-out;
            border-left: 4px solid var(--accent-yellow);
        }
        
        @keyframes fadeInOut {
            0% { opacity: 0; transform: translateY(-20px); }
            20% { opacity: 1; transform: translateY(0); }
            80% { opacity: 1; transform: translateY(0); }
            100% { opacity: 0; transform: translateY(-20px); }
        }
        
        .cart-icon {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background: linear-gradient(135deg, var(--primary-purple), #8a7ad0);
            color: white;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 24px;
            cursor: pointer;
            box-shadow: 0 4px 15px rgba(119, 102, 198, 0.4);
            z-index: 1040;
            transition: transform 0.3s;
        }
        
        .cart-icon:hover {
            transform: scale(1.1);
        }
        
        .cart-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: var(--accent-yellow);
            color: #333;
            border-radius: 50%;
            width: 25px;
            height: 25px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }
        
        .hero-section {
            background: linear-gradient(135deg, var(--primary-purple) 0%, #5a4ba3 100%);
            color: white;
            padding: 60px 0;
            margin-bottom: 40px;
            border-radius: 0 0 30px 30px;
        }
        
        .price-tag {
            font-size: 1.25rem;
            font-weight: bold;
            color: var(--primary-purple);
        }
        
        .entrepreneur {
            font-size: 0.9rem;
            color: var(--primary-purple);
            font-weight: 500;
        }
        
        .btn-primary {
            background: linear-gradient(135deg, var(--primary-purple), #8a7ad0);
            border: none;
            border-radius: 8px;
            font-weight: 600;
            padding: 10px 20px;
            transition: all 0.3s;
        }
        
        .btn-primary:hover {
            background: linear-gradient(135deg, #6655b5, #7766C6);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(119, 102, 198, 0.4);
        }
        
        .btn-outline-light:hover {
            background-color: rgba(255, 255, 255, 0.2);
        }
        
        .nav-link {
            color: rgba(255, 255, 255, 0.9) !important;
            font-weight: 500;
            transition: color 0.3s;
        }
        
        .nav-link:hover {
            color: var(--accent-yellow) !important;
        }
        
        .navbar-toggler {
            border: 1px solid rgba(255, 255, 255, 0.3);
        }
        
        .navbar-toggler-icon {
            background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 30 30'%3e%3cpath stroke='rgba%28255, 255, 255, 0.8%29' stroke-linecap='round' stroke-miterlimit='10' stroke-width='2' d='M4 7h22M4 15h22M4 23h22'/%3e%3c/svg%3e");
        }
        
        footer {
            background: linear-gradient(135deg, #2c2c2c, #1a1a1a);
            color: white;
        }
        
        .modal-header {
            background: linear-gradient(135deg, var(--primary-purple) 0%, #5a4ba3 100%);
            color: white;
        }
        
        .btn-success {
            background: linear-gradient(135deg, var(--accent-yellow), #e6ac00);
            border: none;
            color: #333;
            font-weight: 600;
        }
        
        .btn-success:hover {
            background: linear-gradient(135deg, #e6ac00, #cc9900);
            color: #333;
        }
        
        .btn-outline-danger {
            color: #dc3545;
            border-color: #dc3545;
        }
        
        .btn-outline-danger:hover {
            background-color: #dc3545;
            color: white;
        }
        
        .form-control:focus {
            border-color: var(--primary-purple);
            box-shadow: 0 0 0 0.25rem rgba(119, 102, 198, 0.25);
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark sticky-top">
        <div class="container">
            <a class="navbar-brand" href="#">
                <img src="assets/images/E-GO_LOGO2.gif" alt="E-GO Logo" style="height: 50px; width: auto; object-fit: contain; margin-right: 8px;">             
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="#">Productos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Categorías</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Ofertas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Contacto</a>
                    </li>
                </ul>
                <form class="d-flex me-3">
                    <input class="form-control me-2" type="search" placeholder="Buscar productos...">
                    <button class="btn btn-outline-light" type="submit">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
                <div class="navbar-nav">
                    <a class="nav-link" href="#">
                        <i class="fas fa-user me-1"></i> Mim
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container text-center">
            <h1 class="display-4 fw-bold">Bienvenido a E-GO</h1>
            <p class="lead">Descubre productos exclusivos con emprendedores destacados</p>
        </div>
    </div>

    <!-- Productos -->
    <div class="container my-5">
        <div class="row">
            <!-- Producto 1 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card product-card h-100">
                    <div class="product-image">
                        <img src="assets/images/Galletaas.jpg" alt="Galletas" alt="Contrato veneno">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Galletas</h5>
                        <p class="price-tag">CS 100.00</p>
                        <div class="rating mb-2">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="entrepreneur mt-auto">2. Emprendedor destacado Alma</p>
                        <button class="btn btn-primary add-to-cart mt-2" data-product="Galletas" data-price="100.00">
                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Producto 2 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card product-card h-100">
                    <div class="product-image">
                        <img src="assets/images/Piñata.jpg" alt="Poderes">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Piñatas</h5>
                        <p class="price-tag">CS 150.00</p>
                        <div class="rating mb-2">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="entrepreneur mt-auto">2. Emprendedor destacado Brenda</p>
                        <button class="btn btn-primary add-to-cart mt-2" data-product="Piñatas" data-price="150.00">
                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Producto 3 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card product-card h-100">
                    <div class="product-image">
                        <img src="assets/images/Gorra.png" alt="Vendas relámpago">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Gorras urbanas</h5>
                        <p class="price-tag">CS 500.00</p>
                        <div class="rating mb-2">
                            <span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="entrepreneur mt-auto">Emprendedor Marcos</p>
                        <button class="btn btn-primary add-to-cart mt-2" data-product="Gorras Urbanas" data-price="500.00">
                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Producto 4 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card product-card h-100">
                    <div class="product-image">
                        <img src="assets/images/Silla.jpg" alt="Vendedores destacados">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Sillas Tejidas</h5>
                        <p class="price-tag">CS 5,480.00</p>
                        <div class="rating mb-2">
                            <span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="entrepreneur mt-auto">Emprendedor Esperanza</p>
                        <button class="btn btn-primary add-to-cart mt-2" data-product="Sillas Tejidas" data-price="5480.00">
                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Producto 5 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card product-card h-100">
                    <div class="product-image">
                        <img src="assets/images/Camisas.jpg" alt="Reyes de segunda">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Camisas Bordadas</h5>
                        <p class="price-tag">CS 550.00</p>
                        <div class="rating mb-2">
                            <span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="entrepreneur mt-auto">Emprendedor Fernando</p>
                        <button class="btn btn-primary add-to-cart mt-2" data-product="Camisas Bordadas" data-price="550.00">
                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Producto 6 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card product-card h-100">
                    <div class="product-image">
                        <img src="assets/images/Plancha.jpg" alt="Plancha">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Plancha</h5>
                        <p class="price-tag">CS 800.00</p>
                        <div class="rating mb-2">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="entrepreneur mt-auto">2. Emprendedor destacado Maria</p>
                        <button class="btn btn-primary add-to-cart mt-2" data-product="Plancha" data-price="800.00">
                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Producto 7 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card product-card h-100">
                    <div class="product-image">
                        <img src="https://images.unsplash.com/photo-1563636619-e9143da7973b?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8NHx8bGVjaGV8ZW58MHx8MHx8fDA%3D&auto=format&fit=crop&w=500&q=60" alt="Capitas de leche">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Copitas de leche</h5>
                        <p class="price-tag">CS 5.00</p>
                        <div class="rating mb-2">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="entrepreneur mt-auto">2. Emprendedor destacado Martha</p>
                        <button class="btn btn-primary add-to-cart mt-2" data-product="Capitas de leche" data-price="5.00">
                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Producto 8 -->
            <div class="col-md-6 col-lg-4 col-xl-3">
                <div class="card product-card h-100">
                    <div class="product-image">
                        <img src="assets/images/Peluche.jpg" alt="Motor">
                    </div>
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">Peluches Kawaii</h5>
                        <p class="price-tag">CS 250.00</p>
                        <div class="rating mb-2">
                            <span>★</span><span>★</span><span>★</span><span>★</span><span>★</span>
                        </div>
                        <p class="entrepreneur mt-auto">2. Emprendedor destacado Marcos</p>
                        <button class="btn btn-primary add-to-cart mt-2" data-product="Peluches Kawaii" data-price="250.00">
                            <i class="fas fa-cart-plus me-2"></i>Agregar al carrito
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Footer -->
    <footer class="py-4 mt-5">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5><span class="logo-text">E-GO</span></h5>
                    <p>Tu destino para productos de calidad con emprendedores destacados.</p>
                </div>
                <div class="col-md-4">
                    <h5>Enlaces rápidos</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white">Inicio</a></li>
                        <li><a href="#" class="text-white">Productos</a></li>
                        <li><a href="#" class="text-white">Contacto</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contacto</h5>
                    <p><i class="fas fa-envelope me-2"></i> info@e-go.com</p>
                    <p><i class="fas fa-phone me-2"></i> +123 456 7890</p>
                </div>
            </div>
            <hr class="my-4">
            <div class="text-center">
                <p>&copy; 2023 E-GO. Todos los derechos reservados.</p>
            </div>
        </div>
    </footer>
    
    <!-- Notificación flotante -->
    <div id="cart-notification" class="cart-notification">
        <i class="fas fa-check-circle me-2"></i> Producto agregado al carrito
    </div>
    
    <!-- Icono del carrito -->
    <div class="cart-icon" id="cart-icon">
        <i class="fas fa-shopping-cart"></i>
        <span class="cart-badge" id="cart-count">0</span>
    </div>
    
    <!-- Modal del carrito -->
    <div class="modal fade" id="cartModal" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tu Carrito de Compras</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>
                <div class="modal-body">
                    <div id="cart-items">
                        <!-- Los productos del carrito se mostrarán aquí -->
                        <p class="text-center" id="empty-cart-message">Tu carrito está vacío</p>
                    </div>
                    <div class="d-flex justify-content-between mt-3">
                        <strong>Total: CS <span id="cart-total">0.00</span></strong>
                        <button class="btn btn-success" id="checkout-btn">Finalizar Compra</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            let cartCount = 0;
            let cartTotal = 0;
            let cartItems = [];
            const cartNotification = document.getElementById('cart-notification');
            const cartCountElement = document.getElementById('cart-count');
            const cartIcon = document.getElementById('cart-icon');
            const cartModal = new bootstrap.Modal(document.getElementById('cartModal'));
            const cartItemsContainer = document.getElementById('cart-items');
            const cartTotalElement = document.getElementById('cart-total');
            const emptyCartMessage = document.getElementById('empty-cart-message');
            
            // Agregar evento a todos los botones de "Agregar al carrito"
            document.querySelectorAll('.add-to-cart').forEach(button => {
                button.addEventListener('click', function() {
                    const productName = this.getAttribute('data-product');
                    const productPrice = parseFloat(this.getAttribute('data-price'));
                    
                    // Incrementar contador del carrito
                    cartCount++;
                    cartCountElement.textContent = cartCount;
                    
                    // Agregar producto al carrito
                    cartTotal += productPrice;
                    cartItems.push({
                        name: productName,
                        price: productPrice
                    });
                    
                    // Actualizar el carrito
                    updateCartDisplay();
                    
                    // Mostrar notificación
                    cartNotification.style.display = 'block';
                    
                    // Ocultar notificación después de 3 segundos
                    setTimeout(() => {
                        cartNotification.style.display = 'none';
                    }, 3000);
                    
                    console.log(`Producto agregado: ${productName} - CS ${productPrice}`);
                });
            });
            
            // Evento para el icono del carrito
            cartIcon.addEventListener('click', function() {
                cartModal.show();
            });
            
            // Función para actualizar la visualización del carrito
            function updateCartDisplay() {
                cartTotalElement.textContent = cartTotal.toFixed(2);
                
                if (cartItems.length === 0) {
                    emptyCartMessage.style.display = 'block';
                    cartItemsContainer.innerHTML = '';
                } else {
                    emptyCartMessage.style.display = 'none';
                    
                    let itemsHTML = '';
                    cartItems.forEach((item, index) => {
                        itemsHTML += `
                            <div class="d-flex justify-content-between align-items-center border-bottom pb-2 mb-2">
                                <div>
                                    <h6 class="mb-0">${item.name}</h6>
                                    <small class="text-muted">CS ${item.price.toFixed(2)}</small>
                                </div>
                                <button class="btn btn-sm btn-outline-danger remove-item" data-index="${index}">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </div>
                        `;
                    });
                    
                    cartItemsContainer.innerHTML = itemsHTML;
                    
                    // Agregar eventos a los botones de eliminar
                    document.querySelectorAll('.remove-item').forEach(button => {
                        button.addEventListener('click', function() {
                            const index = parseInt(this.getAttribute('data-index'));
                            removeFromCart(index);
                        });
                    });
                }
            }
            
            // Función para eliminar producto del carrito
            function removeFromCart(index) {
                if (index >= 0 && index < cartItems.length) {
                    cartTotal -= cartItems[index].price;
                    cartItems.splice(index, 1);
                    cartCount--;
                    cartCountElement.textContent = cartCount;
                    updateCartDisplay();
                }
            }
            
            // Evento para el botón de finalizar compra
            document.getElementById('checkout-btn').addEventListener('click', function() {
                if (cartItems.length > 0) {
                    alert('¡Gracias por tu compra! Total: CS ' + cartTotal.toFixed(2));
                    // Reiniciar carrito
                    cartCount = 0;
                    cartTotal = 0;
                    cartItems = [];
                    cartCountElement.textContent = '0';
                    updateCartDisplay();
                    cartModal.hide();
                } else {
                    alert('Tu carrito está vacío');
                }
            });
        });
    </script>
</body>
</html>