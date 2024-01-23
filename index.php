<?php
include("simple_html_dom.php");

$url = "https://www.jimms.fi/fi/Product/List/000-00P/komponentit--naytonohjaimet";

$html = @file_get_html($url);

if (!$html) {
    die("Failed to retrieve or parse the HTML.");
}

echo $html->find('title', 0)->plaintext;
echo "<br>";

$productList = $html->find('div[class="product-list-wrapper"]', 0);

if ($productList) {
    foreach ($productList->find('div[class="row"]') as $product) {
        $title = $product->find('h5[class="product-box-name"]', 0)->plaintext;
        $price = $product->find('span[class="price__amount"]', 0)->plaintext;

        echo "Title: $title <br> Price: $price<br>";
        echo "<br>";
    }
} else {
    echo "Product list not found";
}

$html->clear();
