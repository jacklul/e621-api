<?php

require __DIR__ . '/../vendor/autoload.php';

$api = new \jacklul\E621API\E621('Example project');

if (file_exists(__DIR__ . '/login.ini')) {
    $auth = parse_ini_file(__DIR__ . '/login.ini');
    if (isset($auth['username']) && $auth['api_key']) {
        $api->login($auth['username'], $auth['api_key']);
    }
}

$request = $api->dmailInbox();

if ($request->isSuccessful()) {
    $results = $request->getResult();
    if (count($results) > 0) {
        /** @var \jacklul\E621API\Entity\Dmail $result */
        $result = $request->getResult()[0];
        print 'Title: ' . $result->getTitle() . PHP_EOL;
        print 'To: ' . $result->getTo() . PHP_EOL;
        print 'From: ' . $result->getFrom() . PHP_EOL;
        print 'Is read: ' . $result->getHasSeen() . PHP_EOL;
    } else {
        print 'No results';
    }
} else {
    print 'Error: ' . $request->getReason();
}
