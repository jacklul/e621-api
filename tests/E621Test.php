<?php
/**
 * This file is part of the e621 API package.
 *
 * (c) Jack'lul <jacklulcat@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jacklul\E621API\Tests;

use jacklul\E621API\E621;
use PHPUnit\Framework\TestCase;
use InvalidArgumentException;

/**
 * @TODO test every public API method
 *
 * @package jacklul\E621API\Tests
 */
final class E621Test extends TestCase
{
    /**
     * @var E621
     */
    private $api;

    protected function setUp()
    {
        $this->api = new E621('PHPUnit @ ' . php_uname());
    }

    protected function tearDown()
    {
        $this->api = null;
    }

    public function testConstructWithoutUserAgent()
    {
        $this->expectException(\ArgumentCountError::class);
        new E621();
    }

    public function testConstructWithInvalidCustomOptions()
    {
        $this->expectException(\TypeError::class);
        new E621('test', '');
    }

    public function debugLogHandler($text)
    {
    }

    public function testSetDebugLogHandler()
    {
        $this->api->setDebugLogHandler([$this, 'debugLogHandler']);

        $this->expectException(InvalidArgumentException::class);
        $this->api->setDebugLogHandler(['InvalidClass', 'debugLogHandler']);
    }

    public function requestProgressHandler()
    {
    }

    public function testSetRequestProgressHandler()
    {
        $this->api->setRequestProgressHandler([$this, 'requestProgressHandler']);

        $this->expectException(InvalidArgumentException::class);
        $this->api->setRequestProgressHandler(['InvalidClass', 'requestProgressHandler']);
    }
}
