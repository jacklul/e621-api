## Due to many changes in the new API this project has been discontinued.

# e621 API [![Build Status](https://travis-ci.org/jacklul/e621-api.svg?branch=master)](https://travis-ci.org/jacklul/e621-api)

Simple wrapper for e621.net API written in PHP, uses [**Guzzle**](https://github.com/guzzle/guzzle) under the hood.

**This class is currently in development, most of the stuff was not tested and not every method in entities is implemented yet.**

## Table of Contents
- [Instructions](#instructions)
    - [Installation](#installation)
    - [Usage](#usage)
    - [Logging in](#logging-in)
    - [Debugging](#debugging)
- [API Methods](#api-methods)
- [Exceptions](#exceptions)
- [License](#license)

## Instructions

### Installation

Install this package through [Composer](https://github.com/composer/composer) - `composer require jacklul/e621-api`.

### Usage

- Initialize the `E621` object:

```php
    require 'vendor/autoload.php';
    
    use jacklul\E621API\E621;
    
    $api = new E621();
```

- You should specify custom user agent to identify your project:

```php
    $options = [
        'headers'  => [
            'User-Agent' => 'My project',
        ],
    ];
    
    $api = new E621($options);
```

- Perform request with parameters:

```php
    $request = $api->postIndex(['tags' => 'cat order:score', 'limit' => 25]);
```

- This will return `Response` object, to get the actual data we make sure the request was successful first before getting result data:

```php
    if ($request->isSuccessful()) {
        $results = $request->getResult();    // Result data (usually array of objects, empty array means no results)
    } else {
        echo $request->getReason();     // Failure reason
        echo $request->getMessage();    // Failure descriptive message (when available)
        echo $request->getRawResult();  // Raw response (when available)
    }
```

- You can easily iterate over the result using `foreach()` and then print every image's URL:

```php
    /** @var \jacklul\E621API\Entity\Post $post */
    foreach ($results as $post) {
        echo $post->getFileUrl() . PHP_EOL;
    }
```

You can pass **Guzzle**'s options applied only for a single request as a second parameter:

```php
    $request = $api->postIndex(['tags' => 'cat order:score'], ['timeout' => 10]);
```

By default library will throw exceptions on connection failures or errors, you can disable this by using:

```php
    $api->throwExceptions(false);   // Not recommended
```

When disabled - all error messages will be available via `$request->getError()` method and `$request->getReason()` will contain a message that you can display to the user.

### Logging in

Some actions require logging in to execute, to authenticate you can either pass `login` and `password_hash` (API key) parameters with each request or set it globally:

```php
    $api = new E621();
    $api->login('login', 'api_key');  // Set authentication data
    $request = $api->dmailInbox();
    $api->logout();                   // Remove authentication data
```

### Debugging

You can set progress handler through **Guzzle**'s options while initializing the object, per single request or after:

```php
    $api->setProgressHandler([$this, 'progress']);
    $api->setProgressHandler(null);     // Unset the handler
```

Similar with a debug logging function:

```php
    $api->setDebugLogHandler([$this, 'logger']);
    $api->setDebugLogHandler(null);     // Unset the handler
```

This will write the output to `php://temp` until the request finishes and then it will flush it to your handler, if you need to use different approach then set your handler through **Guzzle**'s options.

## API Methods

See [official API documentation](https://e621.net/help/show/api).

#### Posts

- **postCreate** (login required)
- **postUpdate** (login required)
- **postShow**
- **postCheckMd5**
- **postTags**
- **postIndex**
- **postFlag** (login required)
- **postDestroy** (login required)
- **postDeletedIndex**
- **postPopularByDay**
- **postPopularByWeek**
- **postPopularByMonth**
- **postRevertTags** (login required)
- **postVote** (login required)

#### Tags

- **tagIndex**
- **tagShow**
- **tagUpdate** (login required)
- **tagRelated**
- **tagAliasIndex**
- **tagImplicationIndex**

#### Artists

- **artistIndex**
- **artistCreate** (login required)
- **artistUpdate** (login required)
- **artistDestroy** (login required)

#### Comments

- **commentShow**
- **commentIndex**
- **commentSearch**
- **commentCreate** (login required)
- **commentUpdate** (login required)
- **commentDestroy** (login required)
- **commentHide** (login required)
- **commentUnhide** (login required)
- **commentVote** (login required)

#### Blips

- **blipCreate** (login required)
- **blipUpdate** (login required)
- **blipIndex**
- **blipShow**
- **blipHide** (login required)
- **blipUnhide** (login required)

#### Wiki

- **wikiIndex**
- **wikiCreate** (login required)
- **wikiUpdate** (login required)
- **wikiShow**
- **wikiDestroy** (login required)
- **wikiLock** (login required)
- **wikiUnlock** (login required)
- **wikiRevert** (login required)
- **wikiHistory**
- **wikiRecentChanges**

#### Notes

- **noteIndex**
- **noteSearch**
- **noteHistory**
- **noteRevert** (login required)
- **noteUpdate** (login required)

#### Users

- **userIndex**
- **userShow**
- **userRecordShow**

#### Dmail

- **dmailCreate** (login required)
- **dmailInbox** (login required)
- **dmailShow** (login required)
- **dmailHide** (login required)
- **dmailUnhide** (login required)
- **dmailHideAll** (login required)
- **dmailUnhideAll** (login required)
- **dmailMarkAllRead** (login required)

#### Forum

- **forumCreate** (login required)
- **forumUpdate** (login required)
- **forumIndex**
- **forumSearch**
- **forumShow**
- **forumHide** (login required)
- **forumUnhide** (login required)

#### Pools

- **poolIndex**
- **poolShow**
- **poolUpdate** (login required)
- **poolCreate** (login required)
- **poolDestroy** (login required)
- **poolAddPost** (login required)
- **poolRemovePost** (login required)

#### Sets

- **setIndex**
- **setShow**
- **setCreate** (login required)
- **setUpdate** (login required)
- **setAddPost** (login required)
- **setRemovePost** (login required)
- **setDestroy** (login required)
- **setMaintainers** (login required)

#### Maintainers

- **setMaintainerIndex** (login required)
- **setMaintainerCreate** (login required)
- **setMaintainerDestroy** (login required)
- **setMaintainerApprove** (login required)
- **setMaintainerDeny** (login required)
- **setMaintainerBlock** (login required)

#### Favorites

- **favoriteListUsers**
- **favoriteCreate** (login required)
- **favoriteDestroy** (login required)

#### Tag History

- **postTagHistoryIndex**

#### Flag History

- **postFlagHistoryIndex**

#### Tickets

- **ticketCreate** (login required)
- **ticketIndex**
- **ticketShow**

## Exceptions

#### `jacklul\E621API\Exception\ConnectException` 

Is thrown when connection to e621.net API failed or timed out, in most cases it will also contain `GuzzleHttp\Exception\ConnectException` exception which might explain the issue (`$e->getPrevious()`).

#### `jacklul\E621API\Exception\LoginRequiredException`
 
Is thrown when executed method requires logging in but no login data was provided.

#### `jacklul\E621API\Exception\E621Exception`

Is thrown when something happens but it's none of the above.
 
Possible cases:

- HTTP client error, will contain `GuzzleHttp\Exception\GuzzleException` exception (`$e->getPrevious()`)
- data parsing error, will contain `Psr\Http\Message\ResponseInterface` object (`$e->getResponse()`, to get raw body use `$e->getResponse()->getBody()`

## License

**MIT License**, for details see [LICENSE](LICENSE).
