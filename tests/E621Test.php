<?php

namespace jacklul\E621API\Tests;

use jacklul\E621API\E621;
use PHPUnit\Framework\TestCase;
use PHPUnit\Runner\Version;

final class E621Test extends TestCase
{
    /**
     * @var string
     */
    private $phpunit_version;

    /**
     * @var E621
     */
    private $api;

    protected function setUp()
    {
        if ($this->phpunit_version === null) {
            if (class_exists(Version::class)) {
                /** @noinspection PhpUndefinedClassInspection */
                $phpunit_version_string = explode(' by', \PHPUnit\Runner\Version::getVersionString())[0];
            } elseif (class_exists('PHPUnit_Runner_Version')) {
                /** @noinspection PhpUndefinedClassInspection */
                $phpunit_version_string = explode(' by', \PHPUnit_Runner_Version::getVersionString())[0];
            }

            if (isset($phpunit_version_string)) {
                preg_match('/((?:[0-9]+\.?)+)/', $phpunit_version_string, $matches);
                $this->phpunit_version = $matches[1];
            }
        }

        $this->api = new E621(
            [
                'headers' => [
                    'User-Agent' => 'PHPUnit' . $this->phpunit_version . ' @ ' . php_uname(),
                ],
            ]
        );
    }

    protected function tearDown()
    {
        $this->api = null;
    }

    public function testConstructWithInvalidOptions()
    {
        if ((float)$this->phpunit_version < 6.5) {
            if ((float)phpversion() < 7.0) {
                /** @noinspection PhpUndefinedClassInspection */
                /** @noinspection PhpUndefinedMethodInspection */
                $this->setExpectedException(\PHPUnit_Framework_Error::class);
            } else {
                /** @noinspection PhpUndefinedMethodInspection */
                $this->setExpectedException(\TypeError::class);
            }
        } else {
            /** @noinspection PhpParamsInspection */
            /** @noinspection PhpUndefinedMethodInspection */
            $this->expectException(\TypeError::class);
        }

        new E621(null);
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

        if ((float)$this->phpunit_version < 6.5) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->setExpectedException(\InvalidArgumentException::class);
        } else {
            /** @noinspection PhpParamsInspection */
            /** @noinspection PhpUndefinedMethodInspection */
            $this->expectException(\InvalidArgumentException::class);
        }

        $this->api->setDebugLogHandler(['InvalidClass', 'debugLogHandler']);

        $this->api->setDebugLogHandler(null);   // Nothing should happen
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

        if ((float)$this->phpunit_version < 6.5) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->setExpectedException(\InvalidArgumentException::class);
        } else {
            /** @noinspection PhpParamsInspection */
            /** @noinspection PhpUndefinedMethodInspection */
            $this->expectException(\InvalidArgumentException::class);
        }

        $this->api->setProgressHandler(['InvalidClass', 'progressHandler']);

        $this->api->setProgressHandler(null);   // Nothing should happen
    }

    /**
     * @expectedException \jacklul\E621API\Exception\LoginRequiredException
     */
    public function testLoginRequiredMethodWithoutLoginData()
    {
        $this->api->dmailInbox();
    }

    public function testPostListingMethod()
    {
        $post_id = null;
        $result = $this->api->postIndex(['limit' => 1]);

        if ($result->isSuccessful()) {
            $results = $result->getResult();

            /** @var \jacklul\E621API\Entity\Post $post */
            $post = $results[0];
            $post_id = $post->getId();
        }

        $this->assertInternalType('int', $post_id);
    }

    public function testTimeoutWithAndWithoutExceptions()
    {
        $this->api->throwExceptions(true);

        if ((float)$this->phpunit_version < 6.5) {
            /** @noinspection PhpUndefinedMethodInspection */
            $this->setExpectedException(\jacklul\E621API\Exception\ConnectException::class, \jacklul\E621API\Exception\ConnectException::MESSAGE);
        } else {
            /** @noinspection PhpParamsInspection */
            /** @noinspection PhpUndefinedMethodInspection */
            $this->expectException(\jacklul\E621API\Exception\ConnectException::class);
            /** @noinspection PhpParamsInspection */
            /** @noinspection PhpUndefinedMethodInspection */
            $this->expectExceptionMessage(\jacklul\E621API\Exception\ConnectException::MESSAGE);
        }

        $this->api->postIndex(['limit' => 1000], ['timeout' => 0.01]);

        $this->api->throwExceptions(false);
        $result = $this->api->postIndex(['limit' => 1000], ['timeout' => 0.01]);

        $this->assertEquals(false, $result->isSuccessful());
        $this->assertEquals($result->getReason(), \jacklul\E621API\Exception\ConnectException::MESSAGE);
    }
}
