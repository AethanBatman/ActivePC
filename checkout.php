<?php

require __DIR__ . "/vendor/autoload.php";

$stripe_secret_key = "sk_test_51PITziF8Dy2AxNXCJ86mCKHCpbOU1rV1ChrywLWIfFsSuYfmHtm7nJJJuVxYenb46qv6IvvnIyWcirrrvSSSpk3900Ut1Ttssg";
\Stripe\Stripe::setApiKey($stripe_secret_key);

$cart_items = json_decode($_POST['cart-items'], true);
if (!$cart_items) {
    http_response_code(400);
    echo "Invalid cart data.";
    exit();
}

$line_items = [];
foreach ($cart_items as $item) {
    if ($item['product'] === 'Laptop') {
        $price_data = [
            "currency" => "usd",
            "unit_amount" => 100000,
            "product_data" => [
                "name" => "Laptop"
            ]
        ];
    } elseif ($item['product'] === 'Keyboard') {
        $price_data = [
            "currency" => "usd",
            "unit_amount" => 10000,
            "product_data" => [
                "name" => "Keyboard"
            ]
        ];
    } elseif ($item['product'] === 'Mouse') {
        $price_data = [
            "currency" => "usd",
            "unit_amount" => 5000,
            "product_data" => [
                "name" => "Mouse"
            ]
        ];
    } else {
        http_response_code(400);
        echo "Invalid product.";
        exit();
    }

    $line_items[] = [
        "quantity" => $item['quantity'],
        "price_data" => $price_data
    ];
}

$checkout_session = \Stripe\Checkout\Session::create([
    "mode" => "payment",
    "success_url" => "http://localhost/ActivePC/success.php",
    "cancel_url" => "http://localhost/ActivePC/index.php",
    "line_items" => $line_items
]);

http_response_code(303);
header("Location: " . $checkout_session->url);

?>
