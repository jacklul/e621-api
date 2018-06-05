<?php

namespace jacklul\E621API\Tests;

use jacklul\E621API\E621;
use PHPUnit\Framework\TestCase;

final class PostsTest extends TestCase
{
    /**
     * @var E621
     */
    private $api;

    protected function setUp()
    {
        if (!$this->api instanceof E621) {
            $this->api = new E621('PHPUnit @ ' . php_uname());
        }
    }

    public function testPostListing()
    {
        $post_id = null;
        $result = $this->api->postIndex(['limit' => 1]);

        if ($result->isSuccessful()) {
            $results = $result->getResult();

            /** @var \jacklul\E621API\Entity\Post $post */
            $post = $results[0];
            $post_id = $post->getId();
        }

        $this->assertInternalType("int", $post_id);
    }
}
