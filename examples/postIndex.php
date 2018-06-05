<?php

require __DIR__ . '/../vendor/autoload.php';

$api = new \jacklul\E621API\E621('Example project');
$request = $api->postIndex(['tags' => 'order:random ' . (isset($argv[1]) ? $argv[1] : ''), 'limit' => 5]);

if ($request->isSuccessful()) {
    $results = $request->getResult();
    if (count($results) > 0) {

        /** @var \jacklul\E621API\Entity\Post $post */
        foreach ($results as $post) {
            print 'Post: https://e621.net/post/show/' . $post->getId() . PHP_EOL;
        }
    } else {
        print 'No results';
    }
} else {
    print 'Error: ' . $request->getReason();
}
