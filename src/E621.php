<?php
/**
 * This file is part of the e621 API package.
 *
 * (c) Jack'lul <jacklulcat@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jacklul\E621API;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use InvalidArgumentException;
use jacklul\E621API\Entity\Artist;
use jacklul\E621API\Entity\Blip;
use jacklul\E621API\Entity\Comment;
use jacklul\E621API\Entity\Dmail;
use jacklul\E621API\Entity\Forum;
use jacklul\E621API\Entity\Generic;
use jacklul\E621API\Entity\Note;
use jacklul\E621API\Entity\Pool;
use jacklul\E621API\Entity\PoolPost;
use jacklul\E621API\Entity\Post;
use jacklul\E621API\Entity\PostFlagHistory;
use jacklul\E621API\Entity\PostMd5;
use jacklul\E621API\Entity\PostTagHistory;
use jacklul\E621API\Entity\Response;
use jacklul\E621API\Entity\Set;
use jacklul\E621API\Entity\SetMaintainer;
use jacklul\E621API\Entity\SetPost;
use jacklul\E621API\Entity\Tag;
use jacklul\E621API\Entity\TagAlias;
use jacklul\E621API\Entity\TagImplication;
use jacklul\E621API\Entity\Ticket;
use jacklul\E621API\Entity\User;
use jacklul\E621API\Entity\UserRecord;
use jacklul\E621API\Entity\Wiki;

/**
 * Simple object-oriented e621 API wrapper
 * Some useful code borrowed from https://github.com/php-telegram-bot/core
 *
 * @method Response postCreate(array $params)
 * @method Response postUpdate(array $params)
 * @method Response postShow(array $params)
 * @method Response postCheckMd5(array $params)
 * @method Response postTags(array $params)
 * @method Response postIndex(array $params)
 * @method Response postFlag(array $params)
 * @method Response postDestroy(array $params)
 * @method Response postDeletedIndex(array $params)
 * @method Response postPopularByDay(array $params)
 * @method Response postPopularByWeek(array $params)
 * @method Response postPopularByMonth(array $params)
 * @method Response postRevertTags(array $params)
 * @method Response postVote(array $params)
 * @method Response tagIndex(array $params)
 * @method Response tagShow(array $params)
 * @method Response tagUpdate(array $params)
 * @method Response tagRelated(array $params)
 * @method Response tagAliasIndex(array $params)
 * @method Response tagImplicationIndex(array $params)
 * @method Response artistIndex(array $params)
 * @method Response artistCreate(array $params)
 * @method Response artistUpdate(array $params)
 * @method Response artistDestroy(array $params)
 * @method Response commentShow(array $params)
 * @method Response commentIndex(array $params)
 * @method Response commentSearch(array $params)
 * @method Response commentCreate(array $params)
 * @method Response commentUpdate(array $params)
 * @method Response commentDestroy(array $params)
 * @method Response commentHide(array $params)
 * @method Response commentUnhide(array $params)
 * @method Response commentVote(array $params)
 * @method Response blipCreate(array $params)
 * @method Response blipUpdate(array $params)
 * @method Response blipIndex(array $params)
 * @method Response blipShow(array $params)
 * @method Response blipHide(array $params)
 * @method Response blipUnhide(array $params)
 * @method Response wikiIndex(array $params)
 * @method Response wikiCreate(array $params)
 * @method Response wikiUpdate(array $params)
 * @method Response wikiShow(array $params)
 * @method Response wikiDestroy(array $params)
 * @method Response wikiLock(array $params)
 * @method Response wikiUnlock(array $params)
 * @method Response wikiRevert(array $params)
 * @method Response wikiHistory(array $params)
 * @method Response wikiRecentChanges(array $params)
 * @method Response noteIndex(array $params)
 * @method Response noteSearch(array $params)
 * @method Response noteHistory(array $params)
 * @method Response noteRevert(array $params)
 * @method Response noteUpdate(array $params)
 * @method Response userIndex(array $params)
 * @method Response userShow(array $params)
 * @method Response userRecordShow(array $params)
 * @method Response dmailCreate(array $params)
 * @method Response dmailInbox(array $params)
 * @method Response dmailShow(array $params)
 * @method Response dmailHide(array $params)
 * @method Response dmailUnhide(array $params)
 * @method Response dmailHideAll(array $params)
 * @method Response dmailUnhideAll(array $params)
 * @method Response dmailMarkAllRead(array $params)
 * @method Response forumCreate(array $params)
 * @method Response forumUpdate(array $params)
 * @method Response forumIndex(array $params)
 * @method Response forumSearch(array $params)
 * @method Response forumShow(array $params)
 * @method Response forumHide(array $params)
 * @method Response forumUnhide(array $params)
 * @method Response poolIndex(array $params)
 * @method Response poolShow(array $params)
 * @method Response poolUpdate(array $params)
 * @method Response poolCreate(array $params)
 * @method Response poolDestroy(array $params)
 * @method Response poolAddPost(array $params)
 * @method Response poolRemovePost(array $params)
 * @method Response setIndex(array $params)
 * @method Response setShow(array $params)
 * @method Response setCreate(array $params)
 * @method Response setUpdate(array $params)
 * @method Response setAddPost(array $params)
 * @method Response setRemovePost(array $params)
 * @method Response setDestroy(array $params)
 * @method Response setMaintainers(array $params)
 * @method Response setMaintainerIndex(array $params)
 * @method Response setMaintainerCreate(array $params)
 * @method Response setMaintainerDestroy(array $params)
 * @method Response setMaintainerApprove(array $params)
 * @method Response setMaintainerDeny(array $params)
 * @method Response setMaintainerBlock(array $params)
 * @method Response favoriteListUsers(array $params)
 * @method Response postTagHistoryIndex(array $params)
 * @method Response postFlagHistoryIndex(array $params)
 * @method Response ticketCreate(array $params)
 * @method Response ticketIndex(array $params)
 * @method Response ticketShow(array $params)
 */
class E621
{
    /**
     * Library version
     *
      * @var string
     */
    const VERSION = '0.1.0';

    /**
     * Base URL for API calls
     *
      * @var string
     */
    private $base_uri = 'https://e621.net';

    /**
     * Guzzle's Client object
     *
      * @var Client
     */
    private $client;

    /**
     * Handler for requests in progress
     *
      * @var callable
     */
    private $progress_handler;

    /**
     * Handler for debug logging
     *
      * @var callable
     */
    private $debug_log_handler;

    /**
     * Temporary handle for request logging
     *
      * @var resource
     */
    private $debug_log_stream_handle;

    /**
     * List of supported API methods
     *
      * @var array
     */
    public $actions = [
        'postCreate' => [
            'path'   => 'post/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'postUpdate' => [
            'path'   => 'post/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'postShow' => [
            'path'   => 'post/show.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postCheckMd5' => [
            'path'   => 'post/check_md5.json',
            'method' => 'GET',
            'class'  => PostMd5::class,
        ],
        'postTags' => [
            'path'   => 'post/tags.json',
            'method' => 'GET',
            'class'  => Tag::class,
        ],
        'postIndex' => [
            'path'   => 'post/index.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postFlag' => [
            'path'   => 'post/flag.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'postDestroy' => [
            'path'   => 'post/destroy.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'postDeletedIndex' => [
            'path'   => 'post/deleted_index.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postPopularByDay' => [
            'path'   => 'post/popular_by_day.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postPopularByWeek' => [
            'path'   => 'post/popular_by_week.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postPopularByMonth' => [
            'path'   => 'post/popular_by_month.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postRevertTags' => [
            'path'   => 'post/revert_tags.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'postVote' => [
            'path'   => 'post/vote.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'tagIndex' => [
            'path'   => 'tag/index.json',
            'method' => 'GET',
            'class'  => Tag::class,
        ],
        'tagShow' => [
            'path'   => 'tag/show.json',
            'method' => 'GET',
            'class'  => Tag::class,
        ],
        'tagUpdate' => [
            'path'   => 'tag/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'tagRelated' => [
            'path'   => 'tag/related.json',
            'method' => 'GET',
            'class'  => Tag::class,
        ],
        'tagAliasIndex' => [
            'path'   => 'tag_alias/index.json',
            'method' => 'GET',
            'class'  => TagAlias::class,
        ],
        'tagImplicationIndex' => [
            'path'   => 'tag_implication/index.json',
            'method' => 'GET',
            'class'  => TagImplication::class,
        ],
        'artistIndex' => [
            'path'   => 'artist/index.json',
            'method' => 'GET',
            'class'  => Artist::class,
        ],
        'artistCreate' => [
            'path'   => 'artist/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'artistUpdate' => [
            'path'   => 'artist/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'artistDestroy' => [
            'path'   => 'artist/destroy.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'commentShow' => [
            'path'   => 'comment/show.json',
            'method' => 'GET',
            'class'  => Comment::class,
        ],
        'commentIndex' => [
            'path'   => 'comment/index.json',
            'method' => 'GET',
            'class'  => Comment::class,
        ],
        'commentSearch' => [
            'path'   => 'comment/search.json',
            'method' => 'GET',
            'class'  => Comment::class,
        ],
        'commentCreate' => [
            'path'   => 'comment/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'commentUpdate' => [
            'path'   => 'comment/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'commentDestroy' => [
            'path'   => 'comment/destroy.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'commentHide' => [
            'path'   => 'comment/hide.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'commentUnhide' => [
            'path'   => 'comment/unhide.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'commentVote' => [
            'path'   => 'comment/vote.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'blipCreate' => [
            'path'   => 'blip/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'blipUpdate' => [
            'path'   => 'blip/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'blipIndex' => [
            'path'   => 'blip/index.json',
            'method' => 'GET',
            'class'  => Blip::class,
        ],
        'blipShow' => [
            'path'   => 'blip/show.json',
            'method' => 'GET',
            'class'  => Blip::class,
        ],
        'blipHide' => [
            'path'   => 'blip/hide.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'blipUnhide' => [
            'path'   => 'blip/unhide.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'wikiIndex' => [
            'path'   => 'wiki/index.json',
            'method' => 'GET',
            'class'  => Wiki::class,
        ],
        'wikiCreate' => [
            'path'   => 'wiki/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'wikiUpdate' => [
            'path'   => 'wiki/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'wikiShow' => [
            'path'   => 'wiki/show.json',
            'method' => 'GET',
            'class'  => Wiki::class,
        ],
        'wikiDestroy' => [
            'path'   => 'wiki/destroy.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'wikiLock' => [
            'path'   => 'wiki/lock.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'wikiUnlock' => [
            'path'   => 'wiki/unlock.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'wikiRevert' => [
            'path'   => 'wiki/revert.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'wikiHistory' => [
            'path'   => 'wiki/history.json',
            'method' => 'GET',
            'class'  => Generic::class,
        ],
        'wikiRecentChanges' => [
            'path'   => 'wiki/recent_changes.json',
            'method' => 'GET',
            'class'  => Generic::class,
        ],
        'noteIndex' => [
            'path'   => 'note/index.json',
            'method' => 'GET',
            'class'  => Note::class,
        ],
        'noteSearch' => [
            'path'   => 'note/search.json',
            'method' => 'GET',
            'class'  => Note::class,
        ],
        'noteHistory' => [
            'path'   => 'note/history.json',
            'method' => 'GET',
            'class'  => Generic::class,
        ],
        'noteRevert' => [
            'path'   => 'note/revert.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'noteUpdate' => [
            'path'   => 'note/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'userIndex' => [
            'path'   => 'user/index.json',
            'method' => 'GET',
            'class'  => User::class,
        ],
        'userShow' => [
            'path'   => 'user/show.json',
            'method' => 'GET',
            'class'  => User::class,
        ],
        'userRecordShow' => [
            'path'   => 'user_record/show.json',
            'method' => 'GET',
            'class'  => UserRecord::class,
        ],
        'dmailCreate' => [
            'path'   => 'dmail/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'dmailInbox' => [
            'path'   => 'dmail/inbox.json',
            'method' => 'GET',
            'class'  => Dmail::class,
        ],
        'dmailShow' => [
            'path'   => 'dmail/show.json',
            'method' => 'GET',
            'class'  => Dmail::class,
        ],
        'dmailHide' => [
            'path'   => 'dmail/hide.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'dmailUnhide' => [
            'path'   => 'dmail/unhide.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'dmailHideAll' => [
            'path'   => 'dmail/hide_all.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'dmailUnhideAll' => [
            'path'   => 'dmail/unhide_all.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'dmailMarkAllRead' => [
            'path'   => 'dmail/mark_all_read.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'forumCreate' => [
            'path'   => 'forum/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'forumUpdate' => [
            'path'   => 'forum/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'forumIndex' => [
            'path'   => 'forum/index.json',
            'method' => 'GET',
            'class'  => Forum::class,
        ],
        'forumSearch' => [
            'path'   => 'forum/search.json',
            'method' => 'GET',
            'class'  => Forum::class,
        ],
        'forumShow' => [
            'path'   => 'forum/show.json',
            'method' => 'GET',
            'class'  => Forum::class,
        ],
        'forumHide' => [
            'path'   => 'forum/hide.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'forumUnhide' => [
            'path'   => 'forum/unhide.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'poolIndex' => [
            'path'   => 'pool/index.json',
            'method' => 'GET',
            'class'  => Pool::class,
        ],
        'poolShow' => [
            'path'   => 'pool/show.json',
            'method' => 'GET',
            'class'  => PoolPost::class,
        ],
        'poolUpdate' => [
            'path'   => 'pool/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'poolCreate' => [
            'path'   => 'pool/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'poolDestroy' => [
            'path'   => 'pool/destroy.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'poolAddPost' => [
            'path'   => 'pool/add_post.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'poolRemovePost' => [
            'path'   => 'pool/remove_post.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setIndex' => [
            'path'   => 'set/index.json',
            'method' => 'GET',
            'class'  => Set::class,
        ],
        'setShow' => [
            'path'   => 'set/show.json',
            'method' => 'GET',
            'class'  => SetPost::class,
        ],
        'setCreate' => [
            'path'   => 'set/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setUpdate' => [
            'path'   => 'set/update.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setAddPost' => [
            'path'   => 'set/add_post.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setRemovePost' => [
            'path'   => 'set/remove_post.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setDestroy' => [
            'path'   => 'set/destroy.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setMaintainers' => [
            'path'   => 'set/maintainers.json',
            'method' => 'GET',
            'class'  => SetMaintainer::class,
        ],
        'setMaintainerIndex' => [
            'path'   => 'set_maintainer/index.json',
            'method' => 'GET',
            'class'  => SetMaintainer::class,
        ],
        'setMaintainerCreate' => [
            'path'   => 'set_maintainer/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setMaintainerDestroy' => [
            'path'   => 'set_maintainer/destroy.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setMaintainerApprove.json' => [
            'path'   => 'set_maintainer/approve.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setMaintainerDeny' => [
            'path'   => 'set_maintainer/deny.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'setMaintainerBlock' => [
            'path'   => 'set_maintainer/block.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'favoriteListUsers' => [
            'path'   => 'favorite/list_users.json',
            'method' => 'GET',
            'class'  => User::class,
        ],
        'postTagHistoryIndex' => [
            'path'   => 'post_tag_history/index.json',
            'method' => 'GET',
            'class'  => PostTagHistory::class,
        ],
        'postFlagHistoryIndex' => [
            'path'   => 'post_flag_history/index.json',
            'method' => 'GET',
            'class'  => PostFlagHistory::class,
        ],
        'ticketCreate' => [
            'path'   => 'ticket/create.json',
            'method' => 'POST',
            'class'  => Generic::class,
        ],
        'ticketIndex' => [
            'path'   => 'ticket/index.json',
            'method' => 'GET',
            'class'  => Ticket::class,
        ],
        'ticketShow' => [
            'path'   => 'ticket/show.json',
            'method' => 'GET',
            'class'  => Ticket::class,
        ],
    ];

    /**
     * E621 constructor
     *
      * @param string $user_agent
      * @param array $custom_options
     *
      * @throws InvalidArgumentException
     */
    public function __construct($user_agent, array $custom_options = null)
    {
        if (empty($user_agent) && $user_agent !== false) {
            throw new InvalidArgumentException('Argument "user_agent" must be set!');
        }

        $options = [
            'base_uri' => $this->base_uri,
            'headers'  => [
                'User-Agent' => $user_agent . ' (E621API/' . self::VERSION . ' Guzzle/' . Client::VERSION . ' PHP/' . PHP_VERSION . ')',
                'Accept'     => 'application/json',
            ],
        ];

        if (strlen($options['headers']['User-Agent']) > 255) {
            trigger_error('User-Agent field exceeds 255 characters!', E_USER_WARNING);
        }

        if (is_array($custom_options) && !empty($custom_options)) {
            $options = array_merge($options, $custom_options);
        }

        $this->client = new Client($options);
    }

    /**
     * Main method for making requests
     *
      * @param string $path
      * @param array $data
      * @param string $method
      * @param string $class
     *
      * @return string
      * @throws InvalidArgumentException
     */
    private function request($path = 'post/index.json', array $data = null, $method = 'GET', $class = null)
    {
        if (empty($path)) {
            throw new InvalidArgumentException('Argument "path" cannot be empty!');
        }

        if (strtoupper($method) === 'GET') {
            $options = ['query' => $data];
        } elseif (strtoupper($method) === 'POST') {
            $options = $this->prepareRequestParams($data);
        } else {
            throw new InvalidArgumentException('Unsupported request method!');
        }

        ($this->progress_handler !== null && is_callable($this->progress_handler)) && $options['progress'] = $this->progress_handler;
        ($this->debug_log_handler !== null && is_callable($this->debug_log_handler)) && $options['debug'] = $this->createDebugStream();

        try {
            $response = $this->client->request($method, $path, $options);
            $result = json_decode((string) $response->getBody(), true);
        } catch (RequestException $e) {
            $this->debugLog($e);
            $result = ($e->getResponse()) ? (string) $e->getResponse()->getBody() : 'Empty response / Request timed out';

            // Replace the result when HTML code is detected or request result code isn't 200
            if ($e->getResponse()->getStatusCode() !== 200 || preg_match("/<[^<]+>/", $result) !== false) {
                $result = (string) $e->getResponse()->getStatusCode() . ' ' . (string)$e->getResponse()->getReasonPhrase();
            }

            $result = ['success' => false, 'reason' => $result];
        } finally {
            $this->endDebugStream();
        }

        // Search for result class if we don't have one
        if (empty($class)) {
            $class = Generic::class;
            foreach ($this->actions as $key => $val) {
                if ($val['path'] === $path) {
                    $class = $val['class'];
                }
            }
        }

        return new Response($class, $result);
    }

    /**
     * Prepare request params for POST request, convert to multipart when needed
     *
      * @param array $data
     *
      * @return array
     */
    private function prepareRequestParams(array $data)
    {
        $has_resource = false;
        $multipart = [];

        foreach ($data as $key => $value) {
            if (!is_array($value)) {
                $multipart[] = ['name' => $key, 'contents' => $value];
                continue;
            }

            foreach ($value as $multiKey => $multiValue) {
                is_resource($multiValue) && $has_resource = true;
                $multiName = $key . '[' .$multiKey . ']' . (is_array($multiValue) ? '[' . key($multiValue) . ']' : '') . '';
                $multipart[] = ['name' => $multiName, 'contents' => (is_array($multiValue) ? reset($multiValue) : $multiValue)];
            }
        }

        if ($has_resource) {
            return ['multipart' => $multipart];
        }

        return ['form_params' => $data];
    }

    /**
      * @param string $action
      * @param array $data
     *
      * @return mixed
      * @throws InvalidArgumentException
     */
    public function __call($action, array $data = [])
    {
        if (!isset($this->actions[$action]['path']) && !isset($this->actions[$action]['method']) && !isset($this->actions[$action]['class'])) {
            throw new InvalidArgumentException('Action "' . $action . '" doesn\'t exist!');
        }

        return $this->request($this->actions[$action]['path'], isset($data[0]) ? $data[0] : null, $this->actions[$action]['method'], $this->actions[$action]['class']);
    }

    /**
     * Write to debug log
     *
      * @param $message
     */
    private function debugLog($message)
    {
        $this->debug_log_handler !== null && is_callable($this->debug_log_handler) && call_user_func($this->debug_log_handler, $message);
    }

    /**
     * Get the stream handle of the temporary debug output
     *
      * @return mixed The stream if debug is active, else false
     */
    private function createDebugStream()
    {
        if ($this->debug_log_stream_handle === null) {
            $this->debug_log_stream_handle = fopen('php://temp', 'w+b');
        }

        return $this->debug_log_stream_handle;
    }

    /**
     * Write the temporary debug stream to log and close the stream handle
     */
    private function endDebugStream()
    {
        if (is_resource($this->debug_log_stream_handle)) {
            rewind($this->debug_log_stream_handle);
            $this->debugLog('E621 API Verbose HTTP Request output:' . PHP_EOL .  stream_get_contents($this->debug_log_stream_handle) . PHP_EOL);
            fclose($this->debug_log_stream_handle);
            $this->debug_log_stream_handle = null;
        }
    }

    /**
     * Set progress handler
     *
      * @param callable $progress_handler
     *
      * @throws InvalidArgumentException
     */
    public function setRequestProgressHandler($progress_handler)
    {
        if ($progress_handler !== null && is_callable($progress_handler)) {
            $this->progress_handler = $progress_handler;
        } else {
            throw new InvalidArgumentException('Argument "progress_handler" must be callable!');
        }
    }

    /**
     * Set debug log handler
     *
      * @param mixed $debug_log_handler
     *
      * @throws InvalidArgumentException
     */
    public function setDebugLogHandler($debug_log_handler)
    {
        if ($debug_log_handler !== null && is_callable($debug_log_handler)) {
            $this->debug_log_handler = $debug_log_handler;
        } else {
            throw new InvalidArgumentException('Argument "debug_log_handler" must be callable!');
        }
    }
}
