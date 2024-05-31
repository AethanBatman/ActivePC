<!DOCTYPE html>
<html>
<head>
    <title>ActivePC</title>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            padding: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            height: 100vh;
        }
        .header {
            display: flex;
            align-items: center;
            justify-content: flex-start; 
            width: 100%; 
            padding: 20px; 
        }
        .header img {
            height: 50px;
            margin-right: 20px;
        }
        h1 {
            margin: 0;
            color: #343a40;
        }
        .products {
            display: flex;
            justify-content: center;
            gap: 20px; 
            margin-bottom: 20px;
        }
        .product-form {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            min-width: 200px; 
        }
        .product-form p {
            margin: 10px 0;
        }
        .product-form img {
            max-width: 30%; 
            height: auto;
            border-radius: 8px;
            margin-bottom: 10px;
        }
        .product-form button {
            background-color: #007bff;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .product-form button:hover {
            background-color: #0056b3;
        }
        .cart {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            text-align: center;
            min-width: 200px; 
            margin-top: 20px;
        }
        .cart p {
            margin: 10px 0;
        }
        .cart button {
            background-color: #28a745;
            color: #ffffff;
            border: none;
            padding: 10px 20px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .cart button:hover {
            background-color: #218838;
        }
        .cart-item-controls {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
        }
        .cart-item-controls button {
            background-color: #dc3545;
            color: #ffffff;
            border: none;
            padding: 5px 10px;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        .cart-item-controls button:hover {
            background-color: #c82333;
        }
        .cart-item-controls span {
            font-size: 16px;
            margin: 0 10px;
        }
    </style>
</head>
<body>

    <div class="header">
        <img src="images/logo.png" alt="ActivePC"> 
        <h1>ActivePC</h1>
    </div>

    <div class="products">
        <div class="product-form">
            <form onsubmit="addToCart(event, 'Laptop', 1000)">
                <img src="images/laptop.png" alt="Laptop">
                <p><strong>Laptop</strong></p>
                <p>US$1,000.00</p>
                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <div class="product-form">
            <form onsubmit="addToCart(event, 'Keyboard', 100)">
                <img src="images/keyboard.png" alt="Keyboard">
                <p><strong>Keyboard</strong></p>
                <p>US$100.00</p>
                <button type="submit">Add to Cart</button>
            </form>
        </div>

        <div class="product-form">
            <form onsubmit="addToCart(event, 'Mouse', 50)">
                <img src="images/mouse.png" alt="Mouse">
                <p><strong>Mouse</strong></p>
                <p>US$50.00</p>
                <button type="submit">Add to Cart</button>
            </form>
        </div>
    </div>

    <div class="cart">
        <h2>Cart</h2>
        <div id="cart-items"></div>
        <p><strong>Total: </strong><span id="total-price">US$0.00</span></p>
        <form id="checkout-form" method="post" action="checkout.php">
            <input type="hidden" name="cart-items" id="cart-items-input">
            <button type="submit">Buy Now</button>
        </form>
    </div>

    <script>
        let cart = [];
        let totalPrice = 0;

        function addToCart(event, product, price) {
            event.preventDefault();
            const existingProduct = cart.find(item => item.product === product);
            if (existingProduct) {
                existingProduct.quantity += 1;
                existingProduct.price += price;
            } else {
                cart.push({ product, price, quantity: 1 });
            }
            totalPrice += price;
            updateCart();
        }

        function removeFromCart(product) {
            const existingProduct = cart.find(item => item.product === product);
            if (existingProduct && existingProduct.quantity > 0) {
                const unitPrice = existingProduct.price / existingProduct.quantity;
                existingProduct.quantity -= 1;
                existingProduct.price -= unitPrice;
                totalPrice -= unitPrice;

                if (existingProduct.quantity === 0) {
                    cart = cart.filter(item => item.product !== product);
                }
            }
            updateCart();
        }

        function updateCart() {
            const cartItems = document.getElementById('cart-items');
            const totalPriceElement = document.getElementById('total-price');
            const cartItemsInput = document.getElementById('cart-items-input');
            
            cartItems.innerHTML = '';
            cart.forEach(item => {
                const div = document.createElement('div');
                div.classList.add('cart-item');
                div.innerHTML = `
                    <p>${item.product}: US$${(item.price).toFixed(2)}</p>
                    <div class="cart-item-controls">
                        <button onclick="removeFromCart('${item.product}')">-</button>
                        <span>${item.quantity}</span>
                        <button onclick="addToCart(event, '${item.product}', ${item.price / item.quantity})">+</button>
                    </div>
                `;
                cartItems.appendChild(div);
            });
            totalPriceElement.textContent = `US$${totalPrice.toFixed(2)}`;

            cartItemsInput.value = JSON.stringify(cart);
        }
    </script>

</body>
</html>
