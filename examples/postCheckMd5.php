<?php

require __DIR__ . '/../vendor/autoload.php';

if (!isset($argv[1])) {
    exit('Please provide image MD5 as an argument');
}

$api = new \jacklul\E621API\E621('Example project');
$request = $api->postCheckMd5(['md5' => $argv[1]]);

if ($request->isSuccessful()) {
    /** @var \jacklul\E621API\Entity\PostMd5 $result */
    $result = $request->getResult();
    if ($result->getExists()) {
        print 'Post: https://e621.net/post/show/' . $result->getPostId();
    } else {
        print 'No results';
    }
} else {
    print 'Error: ' . $request->getReason();
}
