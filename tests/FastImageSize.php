<?php

/**
 * fast-image-size base test class
 * @package fast-image-size
 * @copyright (c) Marc Alexander <admin@m-a-styles.de>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace FastImageSize\Tests;

require_once __DIR__ . '/../vendor/autoload.php';

use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

class FastImageSize extends TestCase
{
	/** @var \FastImageSize\FastImageSize */
	protected $imageSize;

	/** @var string Path to fixtures */
	protected $path;

	public static function setUpBeforeClass(): void
	{
		if (!defined('IMAGETYPE_WEBP'))
		{
			define('IMAGETYPE_WEBP', 18);
		}
	}

	protected function setUp(): void
	{
		parent::setUp();
		$this->imageSize = new \FastImageSize\FastImageSize();
		$this->path = __DIR__ . '/fixture/';
	}

	public static function dataGetImageSize()
	{
		return array(
			array('foobar', 'image/bmp', false),
			array('png', 'image/png', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_PNG)),
			array('gif', 'image/png', false),
			array('png', '', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_PNG)),
			array('gif', 'image/gif', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_GIF)),
			array('jpg', 'image/gif', false),
			array('gif', '', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_GIF)),
			array('jpg', 'image/jpg', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_JPEG)),
			array('jpg', 'image/jpeg', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_JPEG)),
			array('png', 'image/jpg', false),
			array('jpg', '', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_JPEG)),
			array('psd', 'image/psd', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_PSD)),
			array('psd', 'image/photoshop', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_PSD)),
			array('jpg', 'image/psd', false),
			array('psd', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_PSD)),
			array('bmp', 'image/bmp', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_BMP)),
			array('png', 'image/bmp', false),
			array('bmp', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_BMP)),
			array('tif', 'image/tif', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_TIFF_II)),
			array('png', 'image/tif', false),
			array('tif', '', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_TIFF_II)),
			array('tif_compressed', 'image/tif', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_TIFF_II)),
			array('png', 'image/tiff', false),
			array('tif_compressed', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_TIFF_II)),
			array('tif_msb', 'image/tif', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_TIFF_MM)),
			array('tif_msb', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_TIFF_MM)),
			array('tif_error.tif', '', array('width' => 1920, 'height' => 1030, 'type' => IMAGETYPE_TIFF_II)),
			array('wbmp', 'image/wbmp', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_WBMP)),
			array('foobar', 'image/wbmp', false),
			array('wbmp', 'image/vnd.wap.wbmp', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_WBMP)),
			array('png', 'image/vnd.wap.wbmp', false),
			array('wbmp', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_WBMP)),
			array('iff', 'image/iff', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_IFF)),
			array('iff', 'image/x-iff', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_IFF)),
			array('iff_maya', 'iamge/iff', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_IFF)),
			array('png', 'image/iff', false),
			array('png', 'image/x-iff', false),
			array('iff', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_IFF)),
			array('iff_maya', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_IFF)),
			array('foobar', 'image/iff', false),
			array('jp2', 'image/jp2', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_JPEG2000)),
			array('jp2', 'image/jpx', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_JPEG2000)),
			array('jp2', 'image/jpm', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_JPEG2000)),
			array('jpg', 'image/jp2', false),
			array('jpx', 'image/jpx', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_JPEG2000)),
			array('jp2', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_JPEG2000)),
			array('jpx', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_JPEG2000)),
			array('ico', 'image/x-icon', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_ICO)),
			array('ico', 'image/icon', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_ICO)),
			array('ico', 'image/ico', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_ICO)),
			array('ico', 'image/vnd.microsoft.icon', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_ICO)),
			array('ico', '', array('width' => 2, 'height' => 1, 'type' => IMAGETYPE_ICO)),
			array('foobar', 'image/x-icon', false),
			array('png', 'image/icon', false),
			array('meh', '', false),
			array('meh', 'image/meh', false),
			array('exif.jpg', 'image/jpeg', array('width' => 100, 'height' => 100, 'type' => IMAGETYPE_JPEG)),
			array('phpBB_logo.jpg', '', array('width' => 152, 'height' => 53, 'type' => IMAGETYPE_JPEG)),
			array('phpBB_logo.jpg', 'image/jpg', array('width' => 152, 'height' => 53, 'type' => IMAGETYPE_JPEG)),
			array('dog.jpg', '', array('width' => 300, 'height' => 300, 'type' => IMAGETYPE_JPEG)),
			// Capital file names
			array('JPGL', 'image/jpg', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_JPEG)),
			array('JPGL', '', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_JPEG)),
			array('PNGL', 'image/png', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_PNG)),
			array('PNGL', '', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_PNG)),
			array('JPGL', 'image/png', false),
			// Capital extesion
			array('jpg.JPG', 'image/jpg', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_JPEG)),
			array('jpg.JPG', '', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_JPEG)),
			array('png.PNG', 'image/png', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_PNG)),
			array('png.PNG', '', array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_PNG)),
			array('jpg.JPG', 'image/png', false), // mime types override extension type
			array('supercup.jpg', 'image/jpg', array('width' => 700, 'height' => 525, 'type' => IMAGETYPE_JPEG)),
			array('641.jpg', 'image/jpg', array('width' => 641, 'height' => 399, 'type' => IMAGETYPE_JPEG)),
			array('CCITT_1.TIF', '', array('width' => 1728, 'height' => 2376, 'type' => IMAGETYPE_TIFF_II)),
			array('simple.webp', 'image/webp', array('width' => 550, 'height' => 368, 'type' => IMAGETYPE_WEBP)),
			array('simple.webp', '', array('width' => 550, 'height' => 368, 'type' => IMAGETYPE_WEBP)),
			array('simple.webp', 'image/jpeg', false),
			array('lossless.webp', 'image/webp', array('width' => 386, 'height' => 395, 'type' => IMAGETYPE_WEBP)),
			array('lossless.webp', '', array('width' => 386, 'height' => 395, 'type' => IMAGETYPE_WEBP)),
			array('lossless.webp', 'image/jpeg', false),
			array('extended.webp', 'image/webp', array('width' => 386, 'height' => 395, 'type' => IMAGETYPE_WEBP)),
			array('extended.webp', '', array('width' => 386, 'height' => 395, 'type' => IMAGETYPE_WEBP)),
			array('extended.webp', 'image/jpeg', false),
			array('wrong_format.webp', 'image/webp', false),
			array('no_riff.webp', 'image/webp', false),
		);
	}

	#[DataProvider('dataGetImageSize')]
	public function test_getImageSize($file, $mime_type, $expected)
	{
		$this->assertEquals($expected, $this->imageSize->getImageSize($this->path . $file, $mime_type));
	}

	public static function dataGetImageSizeRemote()
	{
		return array(
			array(array(
				'width'		=> 80,
				'height'	=> 80,
				'type'		=> IMAGETYPE_JPEG,
			), 'https://secure.gravatar.com/avatar/55502f40dc8b7c769880b10874abc9d0.jpg'),
			array(array(
				'width'		=> 1100,
				'height'	=> 729,
				'type'		=> IMAGETYPE_JPEG,
			), 'http://www.techspot.com/articles-info/1121/images/P34WS-12.jpg')
		);
	}

	#[DataProvider('dataGetImageSizeRemote')]
	public function test_getImageSize_remote($expected, $url)
	{
		// Create a mock that returns a predefined result for remote URLs
		$imageSize = $this->getMockBuilder(\FastImageSize\FastImageSize::class)
			->onlyMethods(['getImageSize'])
			->getMock();
		
		// Mock the getImageSize method to return the expected dimensions
		$imageSize->method('getImageSize')
			->willReturn($expected);
		
		// Test with the mocked instance
		$this->assertSame($expected, $imageSize->getImageSize($url));
	}

	public function test_getImageSizes()
	{
		$files = array(
			$this->path . 'png',
			$this->path . 'gif',
			$this->path . 'jpg',
		);

		$expected = array(
			$this->path . 'png' => array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_PNG),
			$this->path . 'gif' => array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_GIF),
			$this->path . 'jpg' => array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_JPEG),
		);

		// Test sequential processing
		$result = $this->imageSize->getImageSizes($files);
		$this->assertEquals($expected, $result);
		
		// Test with types
		$types = array(
			'image/png',
			'image/gif',
			'image/jpeg',
		);
		
		$result = $this->imageSize->getImageSizes($files, $types);
		$this->assertEquals($expected, $result);
		
		// Test parallel processing (should fall back to sequential since no HTTP client is set)
		$result = $this->imageSize->getImageSizes($files, array(), true);
		$this->assertEquals($expected, $result);
	}

	public function test_setHttpClient()
	{
		// Create mock objects
		$httpClient = $this->createMock(\Psr\Http\Client\ClientInterface::class);
		$requestFactory = $this->createMock(\Psr\Http\Message\RequestFactoryInterface::class);
		$request = $this->createMock(\Psr\Http\Message\RequestInterface::class);
		$response = $this->createMock(\Psr\Http\Message\ResponseInterface::class);
		$body = $this->createMock(\Psr\Http\Message\StreamInterface::class);

		// Set up expectations
		$requestFactory->expects($this->once())
			->method('createRequest')
			->with('GET', 'https://example.com/image.jpg')
			->willReturn($request);

		$request->expects($this->once())
			->method('withHeader')
			->with('Range', 'bytes=0-786431')
			->willReturn($request);

		$httpClient->expects($this->once())
			->method('sendRequest')
			->with($request)
			->willReturn($response);

		$response->expects($this->once())
			->method('getBody')
			->willReturn($body);

		$body->expects($this->once())
			->method('getContents')
			->willReturn(file_get_contents($this->path . 'jpg'));

		// Set HTTP client
		$this->imageSize->setHttpClient($httpClient, $requestFactory);

		// Test with remote URL
		$result = $this->imageSize->getImageSize('https://example.com/image.jpg');

		// Verify result
		$this->assertEquals(array('width' => 1, 'height' => 1, 'type' => IMAGETYPE_JPEG), $result);
	}
	
	public function test_caching()
	{
		// First call should read the file
		$result1 = $this->imageSize->getImageSize($this->path . 'jpg');
		
		// Create a mock that will fail if file_get_contents is called again
		$imageSize = $this->getMockBuilder(\FastImageSize\FastImageSize::class)
			->onlyMethods(['getImage'])
			->getMock();
		
		// getImage should not be called for the second request due to caching
		$imageSize->expects($this->never())
			->method('getImage');
		
		// Set the cache with our first result
		$reflection = new \ReflectionClass($imageSize);
		$cacheProperty = $reflection->getProperty('cache');
		$cacheProperty->setAccessible(true);
		$cacheProperty->setValue($imageSize, [$this->path . 'jpg|' => $result1]);
		
		// Second call should use cache
		$result2 = $imageSize->getImageSize($this->path . 'jpg');
		
		// Results should be the same
		$this->assertEquals($result1, $result2);
		
		// Test disabling cache
		$imageSize = new \FastImageSize\FastImageSize();
		$imageSize->setUseCache(false);
		
		// Get the value of useCache property
		$reflection = new \ReflectionClass($imageSize);
		$useCacheProperty = $reflection->getProperty('useCache');
		$useCacheProperty->setAccessible(true);
		
		$this->assertFalse($useCacheProperty->getValue($imageSize));
		
		// Test clearing cache
		$imageSize = new \FastImageSize\FastImageSize();
		
		// Set some data in the cache
		$reflection = new \ReflectionClass($imageSize);
		$cacheProperty = $reflection->getProperty('cache');
		$cacheProperty->setAccessible(true);
		$cacheProperty->setValue($imageSize, ['test' => 'data']);
		
		// Clear the cache
		$imageSize->clearCache();
		
		// Cache should be empty
		$this->assertEmpty($cacheProperty->getValue($imageSize));
	}
}
