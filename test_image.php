<?php

require_once __DIR__ . '/vendor/autoload.php';

// Check if required HTTP client libraries are installed
if (!class_exists('\\GuzzleHttp\\Client')) {
    echo "Guzzle HTTP client is not installed. Please run: composer require guzzlehttp/guzzle\n";
    exit(1);
}

if (!interface_exists('\\Psr\\Http\\Message\\RequestFactoryInterface')) {
    echo "PSR-17 HTTP factory interfaces are not installed. Please run: composer require psr/http-factory\n";
    exit(1);
}

if (!interface_exists('\\Psr\\Http\\Client\\ClientInterface')) {
    echo "PSR-18 HTTP client interface is not installed. Please run: composer require psr/http-client\n";
    exit(1);
}

// Create HTTP client and request factory
$httpClient = new \GuzzleHttp\Client();
$requestFactory = new \GuzzleHttp\Psr7\HttpFactory();

// Create FastImageSize instance and set HTTP client
$imageSize = new \FastImageSize\FastImageSize();
$imageSize->setHttpClient($httpClient, $requestFactory);

// Try to get image size from remote URL
$url = 'https://www.canicus-trainingszentrum.de/media/cache/content/media/uploads/65df858538e1b52ec473c57221d4a07dbe971d29.png';
$result = $imageSize->getImageSize($url);

echo "Trying to get image size from: $url\n";
if ($result === false) {
    echo "Failed to get image size. Possible reasons:\n";
    echo "- The URL might be inaccessible\n";
    echo "- The image might not exist\n";
    echo "- The image format might not be supported\n";
    echo "- There might be network issues\n";
} else {
    echo "Image dimensions: {$result['width']} x {$result['height']}, type: {$result['type']}\n";
}

var_dump($result);
