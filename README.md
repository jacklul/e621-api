# e621 API [![Build Status](https://travis-ci.org/jacklul/e621-api.svg?branch=master)](https://travis-ci.org/jacklul/e621-api)

Simple wrapper for e621.net API written in PHP.

**This class is currently in development, most of the stuff was not tested and not every method in entities is implemented yet.**

## Table of Contents
- [Instructions](#instructions)
    - [Installation](#installation)
    - [Usage](#usage)
    - [Authentication](#authentication)
- [Methods](#methods)
- [License](#license)

## Instructions
### Installation

Install this package through [Composer](https://github.com/composer/composer) - `composer require jacklul/e621-api`.

### Usage

- Initialize the object with user-agent:

```php
    require 'vendor/autoload.php';
    
    use jacklul\E621API\E621;
    
    $api = new E621('My project');
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
        echo $request->getReason();  // Print request failure reason
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

### Authentication

Some actions require logging in to execute, to authenticate you can either pass `login` and `password_hash` (API key) parameters with each request or set it globally:

```php
    $api = new E621('My project');
    $api->login('login', 'api_key');  // Set login data
    $request = $api->dmailInbox();
    $api->logout();                   // Remove login data
```
```

## Methods

See [official API documentation](https://e621.net/help/show/api).

- **postCreate** (array $params)  **requires login**
- **postUpdate** (array $params)  **requires login**
- **postShow** (array $params)
- **postCheckMd5** (array $params)
- **postTags** (array $params)
- **postIndex** (array $params)
- **postFlag** (array $params)  **requires login**
- **postDestroy** (array $params)  **requires login**
- **postDeletedIndex** (array $params)
- **postPopularByDay** (array $params)
- **postPopularByWeek** (array $params)
- **postPopularByMonth** (array $params)
- **postRevertTags** (array $params)  **requires login**
- **postVote** (array $params)  **requires login**
- **tagIndex** (array $params)
- **tagShow** (array $params)
- **tagUpdate** (array $params)  **requires login**
- **tagRelated** (array $params)
- **tagAliasIndex** (array $params)
- **tagImplicationIndex** (array $params)
- **artistIndex** (array $params)
- **artistCreate** (array $params)  **requires login**
- **artistUpdate** (array $params)  **requires login**
- **artistDestroy** (array $params)  **requires login**
- **commentShow** (array $params)
- **commentIndex** (array $params)
- **commentSearch** (array $params)
- **commentCreate** (array $params)  **requires login**
- **commentUpdate** (array $params)  **requires login**
- **commentDestroy** (array $params)  **requires login**
- **commentHide** (array $params)  **requires login**
- **commentUnhide** (array $params)  **requires login**
- **commentVote** (array $params)  **requires login**
- **blipCreate** (array $params)  **requires login**
- **blipUpdate** (array $params)  **requires login**
- **blipIndex** (array $params)
- **blipShow** (array $params)
- **blipHide** (array $params)  **requires login**
- **blipUnhide** (array $params)  **requires login**
- **wikiIndex** (array $params)
- **wikiCreate** (array $params)  **requires login**
- **wikiUpdate** (array $params)  **requires login**
- **wikiShow** (array $params)
- **wikiDestroy** (array $params)  **requires login**
- **wikiLock** (array $params)  **requires login**
- **wikiUnlock** (array $params)  **requires login**
- **wikiRevert** (array $params)  **requires login**
- **wikiHistory** (array $params)
- **wikiRecentChanges** (array $params)
- **noteIndex** (array $params)
- **noteSearch** (array $params)
- **noteHistory** (array $params)
- **noteRevert** (array $params)  **requires login**
- **noteUpdate** (array $params)  **requires login**
- **userIndex** (array $params)
- **userShow** (array $params)
- **userRecordShow** (array $params)
- **dmailCreate** (array $params)  **requires login**
- **dmailInbox** (array $params)  **requires login**
- **dmailShow** (array $params)  **requires login**
- **dmailHide** (array $params)  **requires login**
- **dmailUnhide** (array $params)  **requires login**
- **dmailHideAll** (array $params)  **requires login**
- **dmailUnhideAll** (array $params)  **requires login**
- **dmailMarkAllRead** (array $params)  **requires login**
- **forumCreate** (array $params)
- **forumUpdate** (array $params)
- **forumIndex** (array $params)
- **forumSearch** (array $params)
- **forumShow** (array $params)
- **forumHide** (array $params)  **requires login**
- **forumUnhide** (array $params)  **requires login**
- **poolIndex** (array $params)
- **poolShow** (array $params)
- **poolUpdate** (array $params)  **requires login**
- **poolCreate** (array $params)  **requires login**
- **poolDestroy** (array $params)  **requires login**
- **poolAddPost** (array $params)  **requires login**
- **poolRemovePost** (array $params)  **requires login**
- **setIndex** (array $params)
- **setShow** (array $params)
- **setCreate** (array $params)  **requires login**
- **setUpdate** (array $params)  **requires login**
- **setAddPost** (array $params)  **requires login**
- **setRemovePost** (array $params)  **requires login**
- **setDestroy** (array $params)  **requires login**
- **setMaintainers** (array $params)  **requires login**
- **setMaintainerIndex** (array $params)  **requires login**
- **setMaintainerCreate** (array $params)  **requires login**
- **setMaintainerDestroy** (array $params)  **requires login**
- **setMaintainerApprove** (array $params)  **requires login**
- **setMaintainerDeny** (array $params)  **requires login**
- **setMaintainerBlock** (array $params)  **requires login**
- **favoriteListUsers** (array $params)
- **postTagHistoryIndex** (array $params)
- **postFlagHistoryIndex** (array $params)
- **ticketCreate** (array $params)  **requires login**
- **ticketIndex** (array $params)
- **ticketShow** (array $params)

## License

See [LICENSE](LICENSE).
