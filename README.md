# e621 API

[![Build Status](https://travis-ci.org/jacklul/e621-api.svg?branch=master)](https://travis-ci.org/jacklul/e621-api)

Simple wrapper for e621.net API.

**This class is currently in development, most of the stuff was not tested and not every method in entities is implemented and documented yet.**

## Table of Contents
- [Instructions](#instructions)
    - [Installation](#installation)
    - [Usage](#usage)

## Instructions
### Installation

Install this package through [Composer](https://github.com/composer/composer) - `composer require jacklul/e621-api`.

### Usage

- Initialize the object with User-Agent "My project":

```php
    require 'vendor/autoload.php';
    
    use jacklul\E621API\E621;
    
    $api = new E621('My project');
```

- Perform request with own parameters:

```php
    $request = $api->postIndex(['tags' => 'falvie cat order:>score', 'limit' => 25]);
```

- This will return `Response` object, to get the actual data we make sure the request was successful first before getting result data:

```php
    if ($request->isSuccessful()) {
        $results = $request->getResult();    // get the result data
    } else {
        echo $request->getReason();  // print request failure reason
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

- To authenticate using API key you can either pass `login` and `password_hash` (API key) parameters with each request or set it globally:

```php
    $api->setAuth('login', 'api_key');
```

## License

See [LICENSE](LICENSE).
