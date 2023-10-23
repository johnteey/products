<?php

require 'vendor/autoload.php';

use Illuminate\Support\Collection;

// Load JSON data
$load_data = json_decode(file_get_contents('products.json'), true);
$products = new Collection($load_data);

// Task 2: Output the total sum of prices in pounds GBP
$totalPriceGBP = $products->sum(function ($product) {
    return $product['price_in_pence'] / 100; // Convert pence to pounds
});
echo "Total sum of prices in GBP: £{$totalPriceGBP}<br/>";

// Task 3: Output the total sum of prices in pounds GBP for phones and laptops
$phonesAndLaptopsPriceGBP = $products->filter(function ($product) {
    return in_array($product['category'], ['Phone', 'Laptop']);
})->sum(function ($product) {
    return $product['price_in_pence'] / 100; // Convert pence to pounds
});
echo "Total sum of prices for phones and laptops in GBP: £{$phonesAndLaptopsPriceGBP}<br/>";

// Task 4: Output the total count of graphics cards
$graphicsCardCount = $products->where('category', 'Graphics Card')->count();
echo "Total count of graphics cards: {$graphicsCardCount}<br/>";

// Task 5: Output a comma-separated list of the names of phones
$phoneNames = $products->where('category', 'Phone')->pluck('name')->implode(', ');
echo "Phone names: {$phoneNames}<br/>";
