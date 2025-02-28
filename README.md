# fast-image-size library

### About

fast-image-size is a PHP library that does almost everything PHP's getimagesize() does but without the large overhead of downloading the complete file.

It currently supports the following image types:

* BMP
* GIF
* ICO
* IFF
* JPEG 2000
* JPEG
* PNG
* PSD
* TIF/TIFF
* WBMP
* WebP

### Requirements

PHP 5.3.0 or newer is required for this library to work.

### Installation

It is recommend to install the library using composer.
Just add the following snippet to your composer.json:
```
  "require": {
    "marc1706/fast-image-size": "1.*"
  },
```

### Usage

Using the fast-image-size library is rather straightforward. Just create a new instance of the main class:
```php
$FastImageSize = new \FastImageSize\FastImageSize();
```

Afterwards, you can check images using the getImageSize() method:
```php
$imageSize = $FastImageSize->getImageSize('https://example.com/some_random_image.jpg');
```

You can pass any local or remote image to this library as long as it's readable.

If the library is able to determine the image size, it will return an array with the following structure (values and type might of course differ depending on your image):
```php
$imageSize = array(
	'width' => 16,
	'height' => 16,
	'type' => IMAGETYPE_PNG,
);
```

#### Processing Multiple Images

You can also process multiple images at once using the getImageSizes() method:
```php
$files = array(
    'https://example.com/image1.jpg',
    'https://example.com/image2.png',
    '/path/to/local/image.gif'
);

$imageSizes = $FastImageSize->getImageSizes($files);

// Result will be an array with file paths as keys and size information as values
// For example:
// $imageSizes = array(
//     'https://example.com/image1.jpg' => array('width' => 800, 'height' => 600, 'type' => IMAGETYPE_JPEG),
//     'https://example.com/image2.png' => array('width' => 1024, 'height' => 768, 'type' => IMAGETYPE_PNG),
//     '/path/to/local/image.gif' => array('width' => 100, 'height' => 100, 'type' => IMAGETYPE_GIF),
// );
```

You can also provide an array of MIME types corresponding to the files:
```php
$files = array(
    'https://example.com/image1.jpg',
    'https://example.com/image2.png'
);

$types = array(
    'image/jpeg',
    'image/png'
);

$imageSizes = $FastImageSize->getImageSizes($files, $types);
```

### Performance Optimizations

The library includes several performance optimizations:

#### Caching

You can enable or disable caching of image sizes to improve performance for repeated requests:

```php
$FastImageSize = new \FastImageSize\FastImageSize();

// Enable caching (enabled by default)
$FastImageSize->setUseCache(true);

// Disable caching
$FastImageSize->setUseCache(false);

// Clear the cache
$FastImageSize->clearCache();
```

#### Memory Optimization

The library optimizes memory usage by releasing image data as soon as it's no longer needed.

#### Parallel Processing

When processing multiple remote images, you can enable parallel processing for better performance:

```php
$files = array(
    'https://example.com/image1.jpg',
    'https://example.com/image2.png',
    '/path/to/local/image.gif'
);

// Process images in parallel (requires HTTP client)
$imageSizes = $FastImageSize->getImageSizes($files, array(), true);
```

The parallel processing feature has optimized implementations for:

- **Symfony HTTP Client**: Uses Symfony's native concurrent request capabilities for maximum performance
- **Guzzle HTTP Client**: Uses Guzzle's promise-based async requests for parallel processing
- **Other PSR-18 Clients**: Falls back to sequential processing for other PSR-18 compliant clients

For best performance with multiple remote images, use either Symfony HTTP Client or Guzzle.

### Using PSR-18 HTTP Client for Remote Images

By default, the library uses `file_get_contents()` to fetch remote images. However, you can use a PSR-18 HTTP client for better performance and more control over the HTTP requests. Using an HTTP client also enables parallel processing of remote images.

#### Using Symfony HTTP Client

```php
// Require Symfony HTTP Client and PSR-7 implementation
// composer require symfony/http-client nyholm/psr7

use FastImageSize\FastImageSize;
use Nyholm\Psr7\Factory\Psr17Factory;
use Symfony\Component\HttpClient\Psr18Client;

// Create PSR-17 factory
$psr17Factory = new Psr17Factory();

// Create PSR-18 client
$httpClient = new Psr18Client();

// Create FastImageSize instance with HTTP client
$FastImageSize = new FastImageSize();
$FastImageSize->setHttpClient($httpClient, $psr17Factory);

// Now you can get the size of remote images using the HTTP client
$imageSize = $FastImageSize->getImageSize('https://example.com/some_random_image.jpg');

// You can also process multiple images at once
$files = array(
    'https://example.com/image1.jpg',
    'https://example.com/image2.png',
    '/path/to/local/image.gif'
);
$imageSizes = $FastImageSize->getImageSizes($files);
```

#### Using Guzzle HTTP Client

```php
// Require Guzzle and PSR-7 implementation
// composer require guzzlehttp/guzzle

use FastImageSize\FastImageSize;
use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;

// Create PSR-18 client and PSR-17 factory
$httpClient = new Client();
$requestFactory = new HttpFactory();

// Create FastImageSize instance with HTTP client
$FastImageSize = new FastImageSize();
$FastImageSize->setHttpClient($httpClient, $requestFactory);

// Now you can get the size of remote images using the HTTP client
$imageSize = $FastImageSize->getImageSize('https://example.com/some_random_image.jpg');

// You can also process multiple images at once
$files = array(
    'https://example.com/image1.jpg',
    'https://example.com/image2.png',
    '/path/to/local/image.gif'
);
$imageSizes = $FastImageSize->getImageSizes($files);
```

### Automated Tests

The library is being tested using unit tests to prevent possible issues.

[![Build Status](https://travis-ci.org/marc1706/fast-image-size.svg?branch=master)](https://travis-ci.org/marc1706/fast-image-size)
[![Code Coverage](https://scrutinizer-ci.com/g/marc1706/fast-image-size/badges/coverage.png?b=master)](https://scrutinizer-ci.com/g/marc1706/fast-image-size/?branch=master)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/marc1706/fast-image-size/badges/quality-score.png?b=master)](https://scrutinizer-ci.com/g/marc1706/fast-image-size/?branch=master)

### Docker Support

The library includes Docker support for development and testing. To use Docker:

```bash
# Build and start the development container
docker-compose up app

# Run tests
docker-compose up test
```

The Docker setup includes:
- PHP 8.3 CLI
- Composer
- Xdebug for debugging and code coverage
- All required extensions (mbstring, curl, etc.)

### License

[The MIT License (MIT)](http://opensource.org/licenses/MIT)

### Credits
Sample files of WebP format by Google: [WebP Image Galleries](https://developers.google.com/speed/webp/gallery)
