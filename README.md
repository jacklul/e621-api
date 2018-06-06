# e621 API [![Build Status](https://travis-ci.org/jacklul/e621-api.svg?branch=master)](https://travis-ci.org/jacklul/e621-api)

Simple wrapper for e621.net API written in PHP.

**This class is currently in development, most of the stuff was not tested and not every method in entities is implemented yet.**

## Table of Contents
- [Instructions](#instructions)
    - [Installation](#installation)
    - [Usage](#usage)
    - [Logging in](#logging-in)
    - [Miscellaneous](#miscellaneous)
- [API Methods](#api-methods)
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
        $results = $request->getResult();    // Get the result data
    } else {
        echo $request->getReason();     // Failure reason
        echo $request->getMessage();    // Failure dscription message (when available)
        echo $request->getRawResult();  // Get raw response
    }
```

- In case of `postIndex()` method result will be array of `Post` objects:

```php
   Array
   (
       [0] => jacklul\E621API\Entity\Post Object
           (
               [id] => 1194987
               [tags] => 2017 anthro armband bandage cat clothed clothing day digitigrade falvie feathers feline foot_wraps fur hair hi_res male mammal melee_weapon outside scabbard
   scarf sheathed_weapon short_hair skimpy sky snow snowing solo standing step_pose sword weapon white_fur white_hair wraps
               [locked_tags] =>
               [description] =>
               [created_at] => Array
                   (
                       [json_class] => Time
                       [s] => 1492637589
                       [n] => 932211000
                   )
   
               [creator_id] => 169756
               [author] => Millcore
               [change] => 11649500
               [source] => https://www.furaffinity.net/view/23264446/
               [score] => 49
               [fav_count] => 104
               [md5] => d9988923347357a24ade031b9997de63
               [file_size] => 1776405
               [file_url] => https://static1.e621.net/data/d9/98/d9988923347357a24ade031b9997de63.png
               [file_ext] => png
               [preview_url] => https://static1.e621.net/data/preview/d9/98/d9988923347357a24ade031b9997de63.jpg
               [preview_width] => 96
               [preview_height] => 150
               [sample_url] => https://static1.e621.net/data/sample/d9/98/d9988923347357a24ade031b9997de63.jpg
               [sample_width] => 517
               [sample_height] => 800
               [rating] => s
               [status] => active
               [width] => 776
               [height] => 1200
               [has_comments] => 1
               [has_notes] =>
               [has_children] =>
               [children] =>
               [parent_id] =>
               [artist] => Array
                   (
                       [0] => falvie
                   )
   
               [sources] => Array
                   (
                       [0] => https://www.furaffinity.net/view/23264446/
                       [1] => http://www.furaffinity.net/user/falvie/
                       [2] => https://d.facdn.net/art/falvie/1492632100/1492632100.falvie_kodiakonesm.png
                   )
           )
   )
```

- You can easily iterate over it using `foreach()` and print every image's URL:

```php
    /** @var \jacklul\E621API\Entity\Post $post */
    foreach ($results as $post) {
        echo $post->getFileUrl() . PHP_EOL;
    }
```

### Logging in

Some actions require logging in to execute, to authenticate you can either pass `login` and `password_hash` (API key) parameters with each request or set it globally:

```php
    $api = new E621('My project');
    $api->login('login', 'api_key');  // Set login data
    $request = $api->dmailInbox();
    $api->logout();                   // Remove login data
```

### Miscellaneous

You can set progress handler through **Guzzle**'s options or after initializing `E621` object using:

```php
    $api->setProgressHandler([$this, 'progress']);
```

To set a function for detailed logging of each request use:

```php
    $api->setDebugLogHandler([$this, 'logger']);
```

To unset those handlers pass `NULL` as the argument:

```php
    $api->setProgressHandler(null);
    $api->setDebugLogHandler(null);
```

## API Methods

See [official API documentation](https://e621.net/help/show/api).

- **postCreate** - requires login
- **postUpdate** - requires login
- **postShow**
- **postCheckMd5**
- **postTags**
- **postIndex**
- **postFlag** - requires login
- **postDestroy** - requires login
- **postDeletedIndex**
- **postPopularByDay**
- **postPopularByWeek**
- **postPopularByMonth**
- **postRevertTags** - requires login
- **postVote** - requires login
- **tagIndex**
- **tagShow**
- **tagUpdate** - requires login
- **tagRelated**
- **tagAliasIndex**
- **tagImplicationIndex**
- **artistIndex**
- **artistCreate** - requires login
- **artistUpdate** - requires login
- **artistDestroy** - requires login
- **commentShow**
- **commentIndex**
- **commentSearch**
- **commentCreate** - requires login
- **commentUpdate** - requires login
- **commentDestroy** - requires login
- **commentHide** - requires login
- **commentUnhide** - requires login
- **commentVote** - requires login
- **blipCreate** - requires login
- **blipUpdate** - requires login
- **blipIndex**
- **blipShow**
- **blipHide** - requires login
- **blipUnhide** - requires login
- **wikiIndex**
- **wikiCreate** - requires login
- **wikiUpdate** - requires login
- **wikiShow**
- **wikiDestroy** - requires login
- **wikiLock** - requires login
- **wikiUnlock** - requires login
- **wikiRevert** - requires login
- **wikiHistory**
- **wikiRecentChanges**
- **noteIndex**
- **noteSearch**
- **noteHistory**
- **noteRevert** - requires login
- **noteUpdate** - requires login
- **userIndex**
- **userShow**
- **userRecordShow**
- **dmailCreate** - requires login
- **dmailInbox** - requires login
- **dmailShow** - requires login
- **dmailHide** - requires login
- **dmailUnhide** - requires login
- **dmailHideAll** - requires login
- **dmailUnhideAll** - requires login
- **dmailMarkAllRead** - requires login
- **forumCreate**
- **forumUpdate**
- **forumIndex**
- **forumSearch**
- **forumShow**
- **forumHide** - requires login
- **forumUnhide** - requires login
- **poolIndex**
- **poolShow**
- **poolUpdate** - requires login
- **poolCreate** - requires login
- **poolDestroy** - requires login
- **poolAddPost** - requires login
- **poolRemovePost** - requires login
- **setIndex**
- **setShow**
- **setCreate** - requires login
- **setUpdate** - requires login
- **setAddPost** - requires login
- **setRemovePost** - requires login
- **setDestroy** - requires login
- **setMaintainers** - requires login
- **setMaintainerIndex** - requires login
- **setMaintainerCreate** - requires login
- **setMaintainerDestroy** - requires login
- **setMaintainerApprove** - requires login
- **setMaintainerDeny** - requires login
- **setMaintainerBlock** - requires login
- **favoriteListUsers**
- **postTagHistoryIndex**
- **postFlagHistoryIndex**
- **ticketCreate** - requires login
- **ticketIndex**
- **ticketShow**

## License

See [LICENSE](LICENSE).
