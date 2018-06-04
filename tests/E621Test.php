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
        if ((float)phpversion() >= 7.1) {
            if (method_exists($this, 'setExpectedException')) {
                $this->setExpectedException(\ArgumentCountError::class);
            } elseif (method_exists($this, 'expectException')) {
                $this->expectException(\ArgumentCountError::class);
            }

            new E621();
        }
    }

    public function testConstructWithInvalidCustomOptions()
    {
        if ((float)phpversion() >= 7.0) {
            if (method_exists($this, 'setExpectedException')) {
                $this->setExpectedException(\TypeError::class);
            } elseif (method_exists($this, 'expectException')) {
                $this->expectException(\TypeError::class);
            }

            new E621('test', '');
        }
    }

    public function debugLogHandler($text)
    {
    }

    public function testSetDebugLogHandlerValid()
    {
        $this->api->setDebugLogHandler([$this, 'debugLogHandler']);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetDebugLogHandlerInvalid()
    {
        $this->api->setDebugLogHandler(['InvalidClass', 'debugLogHandler']);
    }

    public function progressHandler()
    {
    }

    public function testSetProgressHandlerValid()
    {
        $this->api->setProgressHandler([$this, 'progressHandler']);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testSetProgressHandlerInvalid()
    {
        $this->api->setProgressHandler(['InvalidClass', 'progressHandler']);
    }
}
