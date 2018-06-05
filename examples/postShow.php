<?php

require __DIR__ . '/../vendor/autoload.php';

if (!isset($argv[1])) {
    exit('Please provide post ID as an argument');
}

$api = new \jacklul\E621API\E621('Example project');
$request = $api->postShow(['id' => $argv[1]]);

if ($request->isSuccessful()) {
    /** @var \jacklul\E621API\Entity\Post $result */
    $result = $request->getResult();
    if (!empty($result)) {
        print 'Post: https://e621.net/post/show/' . $result->getId() . PHP_EOL;
        print 'File: ' . $result->getFileUrl() . PHP_EOL;
        print 'Tags: ' . $result->getTags() . PHP_EOL;
        print 'Score: ' . $result->getScore() . PHP_EOL;
        print 'Favorites: ' . $result->getFavCount() . PHP_EOL;
    } else {
        print 'No results';
    }
} else {
    print 'Error: ' . $request->getReason();
}
