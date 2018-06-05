<?php

namespace jacklul\E621API\Tests;

use jacklul\E621API\E621;
use PHPUnit\Framework\TestCase;

final class CommonsTest extends TestCase
{
    /**
     * @var E621
     */
    private $api;

    protected function setUp()
    {
        $this->api = new E621('PHPUnit @ ' . php_uname());
    }

    /**
     * @expectedException \jacklul\E621API\Exception\LoginRequiredException
     */
    public function testLoginRequiredMethodWithoutLoginData()
    {
        $this->api->dmailInbox();
    }
}
