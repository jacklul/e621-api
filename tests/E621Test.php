<?php

namespace jacklul\E621API\Tests;

use jacklul\E621API\E621;
use PHPUnit\Framework\TestCase;

final class E621Test extends TestCase
{
    /**
     * @var E621
     */
    private $api;

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testConstructWithInvalidUserAgent()
    {
        new E621([]);
    }

    /**
     * @expectedException \TypeError
     */
    public function testConstructWithInvalidCustomOptions()
    {
        new E621('-', '');
    }

    public function testDebugLogHandler()
    {
        $tmp = '';
        $this->api->setDebugLogHandler(
            function ($text) use (&$tmp) {
                $tmp .= $text;
            }
        );

        $this->api->postIndex(['limit' => 1]);

        $this->assertContains('Verbose HTTP Request output', $tmp);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidDebugLogHandler()
    {
        $this->api->setDebugLogHandler(['InvalidClass', 'debugLogHandler']);
    }

    public function testUnsetDebugLogHandler()
    {
        $this->api->setDebugLogHandler(null);
        $this->assertTrue(true);
    }

    public function testProgressHandler()
    {
        $tmp = [];
        $this->api->setProgressHandler(
            function ($downloadTotal, $downloadedBytes, $uploadTotal, $uploadedBytes) use (&$tmp) {
                $tmp = [
                    'downloadTotal'   => $downloadTotal,
                    'downloadedBytes' => $downloadedBytes,
                    'uploadTotal'     => $uploadTotal,
                    'uploadedBytes'   => $uploadedBytes,
                ];
            }
        );

        $this->api->postIndex(['limit' => 1]);

        $this->assertGreaterThan(0, $tmp['downloadTotal']);
    }

    /**
     * @expectedException \InvalidArgumentException
     */
    public function testInvalidProgressHandler()
    {
        $this->api->setProgressHandler(['InvalidClass', 'progressHandler']);
    }

    public function testUnsetProgressHandler()
    {
        $this->api->setProgressHandler(null);
        $this->assertTrue(true);
    }

    protected function setUp()
    {
        $this->api = new E621('PHPUnit @ ' . php_uname());
    }
}
