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

class TypeJpeg extends TestCase
{
	/** @var \FastImageSize\FastImageSize */
	protected $imagesize;

	/** @var \FastImageSize\Type\TypeJpeg */
	protected $typeJpeg;

	/** @var string Path to fixtures */
	protected $path;

	protected function setUp(): void
	{
		parent::setUp();
		$this->imagesize = new \FastImageSize\FastImageSize();
		$this->typeJpeg = new \FastImageSize\Type\TypeJpeg($this->imagesize);
		$this->path = __DIR__ . '/fixture/';
	}

	public static function dataJpegTest()
	{
		return array(
			array(false, "\xFF\xD8somemorerandomdata1"),
			array(false, "\xFF\xD8somedata\xFF\xE0\xFF\xFF\xFF\xFF"),
			array(false,
				"\xFF\xD8somedata\xFF\xC0\xFF\xFF\xFF\xFF\xFF\xFF\xFF"
			),
		);
	}

	#[DataProvider('dataJpegTest')]
	public function testJpegLength($expected, $data)
	{
		@file_put_contents($this->path . 'test_file.jpg', $data);

		$this->imagesize->getImageSize($this->path . 'test_file.jpg');

		$this->assertEquals($expected, $this->imagesize->getImageSize($this->path . 'test_file.jpg'));

		@unlink($this->path . 'test_file.jpg');
	}
}
