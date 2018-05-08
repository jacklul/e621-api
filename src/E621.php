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
use jacklul\E621API\Entity\FavoritedUsers;
use jacklul\E621API\Entity\Forum;
use jacklul\E621API\Entity\Generic;
use jacklul\E621API\Entity\Note;
use jacklul\E621API\Entity\NoteHistory;
use jacklul\E621API\Entity\Pool;
use jacklul\E621API\Entity\Post;
use jacklul\E621API\Entity\PostFlagHistory;
use jacklul\E621API\Entity\PostMd5;
use jacklul\E621API\Entity\PostTagHistory;
use jacklul\E621API\Entity\Response;
use jacklul\E621API\Entity\Set;
use jacklul\E621API\Entity\SetMaintainer;
use jacklul\E621API\Entity\Tag;
use jacklul\E621API\Entity\TagAlias;
use jacklul\E621API\Entity\TagImplication;
use jacklul\E621API\Entity\TagRelated;
use jacklul\E621API\Entity\Ticket;
use jacklul\E621API\Entity\User;
use jacklul\E621API\Entity\UserRecord;
use jacklul\E621API\Entity\Wiki;
use jacklul\E621API\Entity\WikiHistory;

/**
 * Simple object-oriented e621 API wrapper
 * Some useful code borrowed from https://github.com/php-telegram-bot/core
 *
 * @method Response postCreate(array $params = null)
 * @method Response postUpdate(array $params = null)
 * @method Response postShow(array $params = null)
 * @method Response postCheckMd5(array $params = null)
 * @method Response postTags(array $params = null)
 * @method Response postIndex(array $params = null)
 * @method Response postFlag(array $params = null)
 * @method Response postDestroy(array $params = null)
 * @method Response postDeletedIndex(array $params = null)
 * @method Response postPopularByDay(array $params = null)
 * @method Response postPopularByWeek(array $params = null)
 * @method Response postPopularByMonth(array $params = null)
 * @method Response postRevertTags(array $params = null)
 * @method Response postVote(array $params = null)
 * @method Response tagIndex(array $params = null)
 * @method Response tagShow(array $params = null)
 * @method Response tagUpdate(array $params = null)
 * @method Response tagRelated(array $params = null)
 * @method Response tagAliasIndex(array $params = null)
 * @method Response tagImplicationIndex(array $params = null)
 * @method Response artistIndex(array $params = null)
 * @method Response artistCreate(array $params = null)
 * @method Response artistUpdate(array $params = null)
 * @method Response artistDestroy(array $params = null)
 * @method Response commentShow(array $params = null)
 * @method Response commentIndex(array $params = null)
 * @method Response commentSearch(array $params = null)
 * @method Response commentCreate(array $params = null)
 * @method Response commentUpdate(array $params = null)
 * @method Response commentDestroy(array $params = null)
 * @method Response commentHide(array $params = null)
 * @method Response commentUnhide(array $params = null)
 * @method Response commentVote(array $params = null)
 * @method Response blipCreate(array $params = null)
 * @method Response blipUpdate(array $params = null)
 * @method Response blipIndex(array $params = null)
 * @method Response blipShow(array $params = null)
 * @method Response blipHide(array $params = null)
 * @method Response blipUnhide(array $params = null)
 * @method Response wikiIndex(array $params = null)
 * @method Response wikiCreate(array $params = null)
 * @method Response wikiUpdate(array $params = null)
 * @method Response wikiShow(array $params = null)
 * @method Response wikiDestroy(array $params = null)
 * @method Response wikiLock(array $params = null)
 * @method Response wikiUnlock(array $params = null)
 * @method Response wikiRevert(array $params = null)
 * @method Response wikiHistory(array $params = null)
 * @method Response wikiRecentChanges(array $params = null)
 * @method Response noteIndex(array $params = null)
 * @method Response noteSearch(array $params = null)
 * @method Response noteHistory(array $params = null)
 * @method Response noteRevert(array $params = null)
 * @method Response noteUpdate(array $params = null)
 * @method Response userIndex(array $params = null)
 * @method Response userShow(array $params = null)
 * @method Response userRecordShow(array $params = null)
 * @method Response dmailCreate(array $params = null)
 * @method Response dmailInbox(array $params = null)
 * @method Response dmailShow(array $params = null)
 * @method Response dmailHide(array $params = null)
 * @method Response dmailUnhide(array $params = null)
 * @method Response dmailHideAll(array $params = null)
 * @method Response dmailUnhideAll(array $params = null)
 * @method Response dmailMarkAllRead(array $params = null)
 * @method Response forumCreate(array $params = null)
 * @method Response forumUpdate(array $params = null)
 * @method Response forumIndex(array $params = null)
 * @method Response forumSearch(array $params = null)
 * @method Response forumShow(array $params = null)
 * @method Response forumHide(array $params = null)
 * @method Response forumUnhide(array $params = null)
 * @method Response poolIndex(array $params = null)
 * @method Response poolShow(array $params = null)
 * @method Response poolUpdate(array $params = null)
 * @method Response poolCreate(array $params = null)
 * @method Response poolDestroy(array $params = null)
 * @method Response poolAddPost(array $params = null)
 * @method Response poolRemovePost(array $params = null)
 * @method Response setIndex(array $params = null)
 * @method Response setShow(array $params = null)
 * @method Response setCreate(array $params = null)
 * @method Response setUpdate(array $params = null)
 * @method Response setAddPost(array $params = null)
 * @method Response setRemovePost(array $params = null)
 * @method Response setDestroy(array $params = null)
 * @method Response setMaintainers(array $params = null)
 * @method Response setMaintainerIndex(array $params = null)
 * @method Response setMaintainerCreate(array $params = null)
 * @method Response setMaintainerDestroy(array $params = null)
 * @method Response setMaintainerApprove(array $params = null)
 * @method Response setMaintainerDeny(array $params = null)
 * @method Response setMaintainerBlock(array $params = null)
 * @method Response favoriteListUsers(array $params = null)
 * @method Response postTagHistoryIndex(array $params = null)
 * @method Response postFlagHistoryIndex(array $params = null)
 * @method Response ticketCreate(array $params = null)
 * @method Response ticketIndex(array $params = null)
 * @method Response ticketShow(array $params = null)
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
     * List of supported API methods and their execution settings
     *
     * @var array
     */
    private $actions = [
        'postCreate'           => [
            'path'       => 'post/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'postUpdate'           => [
            'path'       => 'post/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'postShow'             => [
            'path'   => 'post/show.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postCheckMd5'         => [
            'path'   => 'post/check_md5.json',
            'method' => 'GET',
            'class'  => PostMd5::class,
        ],
        'postTags'             => [
            'path'   => 'post/tags.json',
            'method' => 'GET',
            'class'  => Tag::class,
        ],
        'postIndex'            => [
            'path'   => 'post/index.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postFlag'             => [
            'path'       => 'post/flag.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'postDestroy'          => [
            'path'       => 'post/destroy.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'postDeletedIndex'     => [
            'path'   => 'post/deleted_index.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postPopularByDay'     => [
            'path'   => 'post/popular_by_day.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postPopularByWeek'    => [
            'path'   => 'post/popular_by_week.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postPopularByMonth'   => [
            'path'   => 'post/popular_by_month.json',
            'method' => 'GET',
            'class'  => Post::class,
        ],
        'postRevertTags'       => [
            'path'       => 'post/revert_tags.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'postVote'             => [
            'path'       => 'post/vote.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'tagIndex'             => [
            'path'   => 'tag/index.json',
            'method' => 'GET',
            'class'  => Tag::class,
        ],
        'tagShow'              => [
            'path'   => 'tag/show.json',
            'method' => 'GET',
            'class'  => Tag::class,
        ],
        'tagUpdate'            => [
            'path'       => 'tag/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'tagRelated'           => [
            'path'   => 'tag/related.json',
            'method' => 'GET',
            'class'  => TagRelated::class,
        ],
        'tagAliasIndex'        => [
            'path'   => 'tag_alias/index.json',
            'method' => 'GET',
            'class'  => TagAlias::class,
        ],
        'tagImplicationIndex'  => [
            'path'   => 'tag_implication/index.json',
            'method' => 'GET',
            'class'  => TagImplication::class,
        ],
        'artistIndex'          => [
            'path'   => 'artist/index.json',
            'method' => 'GET',
            'class'  => Artist::class,
        ],
        'artistCreate'         => [
            'path'       => 'artist/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'artistUpdate'         => [
            'path'       => 'artist/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'artistDestroy'        => [
            'path'       => 'artist/destroy.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'commentShow'          => [
            'path'   => 'comment/show.json',
            'method' => 'GET',
            'class'  => Comment::class,
        ],
        'commentIndex'         => [
            'path'   => 'comment/index.json',
            'method' => 'GET',
            'class'  => Comment::class,
        ],
        'commentSearch'        => [
            'path'   => 'comment/search.json',
            'method' => 'GET',
            'class'  => Comment::class,
        ],
        'commentCreate'        => [
            'path'       => 'comment/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'commentUpdate'        => [
            'path'       => 'comment/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'commentDestroy'       => [
            'path'       => 'comment/destroy.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'commentHide'          => [
            'path'       => 'comment/hide.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'commentUnhide'        => [
            'path'       => 'comment/unhide.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'commentVote'          => [
            'path'       => 'comment/vote.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'blipCreate'           => [
            'path'       => 'blip/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'blipUpdate'           => [
            'path'       => 'blip/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'blipIndex'            => [
            'path'   => 'blip/index.json',
            'method' => 'GET',
            'class'  => Blip::class,
        ],
        'blipShow'             => [
            'path'   => 'blip/show.json',
            'method' => 'GET',
            'class'  => Blip::class,
        ],
        'blipHide'             => [
            'path'       => 'blip/hide.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'blipUnhide'           => [
            'path'       => 'blip/unhide.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'wikiIndex'            => [
            'path'   => 'wiki/index.json',
            'method' => 'GET',
            'class'  => Wiki::class,
        ],
        'wikiCreate'           => [
            'path'       => 'wiki/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'wikiUpdate'           => [
            'path'       => 'wiki/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'wikiShow'             => [
            'path'   => 'wiki/show.json',
            'method' => 'GET',
            'class'  => Wiki::class,
        ],
        'wikiDestroy'          => [
            'path'       => 'wiki/destroy.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'wikiLock'             => [
            'path'       => 'wiki/lock.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'wikiUnlock'           => [
            'path'       => 'wiki/unlock.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'wikiRevert'           => [
            'path'       => 'wiki/revert.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'wikiHistory'          => [
            'path'   => 'wiki/history.json',
            'method' => 'GET',
            'class'  => WikiHistory::class,
        ],
        'wikiRecentChanges'    => [
            'path'   => 'wiki/recent_changes.json',
            'method' => 'GET',
            'class'  => Wiki::class,
        ],
        'noteIndex'            => [
            'path'   => 'note/index.json',
            'method' => 'GET',
            'class'  => Note::class,
        ],
        'noteSearch'           => [
            'path'   => 'note/search.json',
            'method' => 'GET',
            'class'  => Note::class,
        ],
        'noteHistory'          => [
            'path'   => 'note/history.json',
            'method' => 'GET',
            'class'  => NoteHistory::class,
        ],
        'noteRevert'           => [
            'path'       => 'note/revert.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'noteUpdate'           => [
            'path'       => 'note/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'userIndex'            => [
            'path'   => 'user/index.json',
            'method' => 'GET',
            'class'  => User::class,
        ],
        'userShow'             => [
            'path'   => 'user/show.json',
            'method' => 'GET',
            'class'  => User::class,
        ],
        'userRecordShow'       => [
            'path'   => 'user_record/show.json',
            'method' => 'GET',
            'class'  => UserRecord::class,
        ],
        'dmailCreate'          => [
            'path'       => 'dmail/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'dmailInbox'           => [
            'path'       => 'dmail/inbox.json',
            'method'     => 'GET',
            'class'      => Dmail::class,
            'need_login' => true,
        ],
        'dmailShow'            => [
            'path'       => 'dmail/show.json',
            'method'     => 'GET',
            'class'      => Dmail::class,
            'need_login' => true,
        ],
        'dmailHide'            => [
            'path'       => 'dmail/hide.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'dmailUnhide'          => [
            'path'       => 'dmail/unhide.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'dmailHideAll'         => [
            'path'       => 'dmail/hide_all.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'dmailUnhideAll'       => [
            'path'       => 'dmail/unhide_all.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'dmailMarkAllRead'     => [
            'path'       => 'dmail/mark_all_read.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'forumCreate'          => [
            'path'       => 'forum/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'forumUpdate'          => [
            'path'       => 'forum/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'forumIndex'           => [
            'path'   => 'forum/index.json',
            'method' => 'GET',
            'class'  => Forum::class,
        ],
        'forumSearch'          => [
            'path'   => 'forum/search.json',
            'method' => 'GET',
            'class'  => Forum::class,
        ],
        'forumShow'            => [
            'path'   => 'forum/show.json',
            'method' => 'GET',
            'class'  => Forum::class,
        ],
        'forumHide'            => [
            'path'       => 'forum/hide.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'forumUnhide'          => [
            'path'       => 'forum/unhide.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'poolIndex'            => [
            'path'   => 'pool/index.json',
            'method' => 'GET',
            'class'  => Pool::class,
        ],
        'poolShow'             => [
            'path'   => 'pool/show.json',
            'method' => 'GET',
            'class'  => Pool::class,
        ],
        'poolUpdate'           => [
            'path'       => 'pool/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'poolCreate'           => [
            'path'       => 'pool/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'poolDestroy'          => [
            'path'       => 'pool/destroy.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'poolAddPost'          => [
            'path'       => 'pool/add_post.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'poolRemovePost'       => [
            'path'       => 'pool/remove_post.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setIndex'             => [
            'path'   => 'set/index.json',
            'method' => 'GET',
            'class'  => Set::class,
        ],
        'setShow'              => [
            'path'   => 'set/show.json',
            'method' => 'GET',
            'class'  => Set::class,
        ],
        'setCreate'            => [
            'path'       => 'set/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setUpdate'            => [
            'path'       => 'set/update.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setAddPost'           => [
            'path'       => 'set/add_post.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setRemovePost'        => [
            'path'       => 'set/remove_post.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setDestroy'           => [
            'path'       => 'set/destroy.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setMaintainers'       => [
            'path'       => 'set/maintainers.json',
            'method'     => 'GET',
            'class'      => SetMaintainer::class,
            'need_login' => true,
        ],
        'setMaintainerIndex'   => [
            'path'       => 'set_maintainer/index.json',
            'method'     => 'GET',
            'class'      => SetMaintainer::class,
            'need_login' => true,
        ],
        'setMaintainerCreate'  => [
            'path'       => 'set_maintainer/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setMaintainerDestroy' => [
            'path'       => 'set_maintainer/destroy.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setMaintainerApprove' => [
            'path'       => 'set_maintainer/approve.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setMaintainerDeny'    => [
            'path'       => 'set_maintainer/deny.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'setMaintainerBlock'   => [
            'path'       => 'set_maintainer/block.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'favoriteListUsers'    => [
            'path'   => 'favorite/list_users.json',
            'method' => 'GET',
            'class'  => FavoritedUsers::class,
        ],
        'postTagHistoryIndex'  => [
            'path'   => 'post_tag_history/index.json',
            'method' => 'GET',
            'class'  => PostTagHistory::class,
        ],
        'postFlagHistoryIndex' => [
            'path'   => 'post_flag_history/index.json',
            'method' => 'GET',
            'class'  => PostFlagHistory::class,
        ],
        'ticketCreate'         => [
            'path'       => 'ticket/create.json',
            'method'     => 'POST',
            'class'      => Generic::class,
            'need_login' => true,
        ],
        'ticketIndex'          => [
            'path'   => 'ticket/index.json',
            'method' => 'GET',
            'class'  => Ticket::class,
        ],
        'ticketShow'           => [
            'path'   => 'ticket/show.json',
            'method' => 'GET',
            'class'  => Ticket::class,
        ],
    ];

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
     * E621 constructor
     *
     * @param string $user_agent
     * @param array  $custom_options
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
     * @param string $action
     * @param array  $data
     *
     * @return mixed
     * @throws InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function __call($action, array $data = [])
    {
        if (!isset($this->actions[$action]['path']) && !isset($this->actions[$action]['method']) && !isset($this->actions[$action]['class'])) {
            throw new InvalidArgumentException('Action "' . $action . '" doesn\'t exist!');
        }

        if (isset($this->actions[$action]['need_login']) && $this->actions[$action]['need_login'] === true && isset($data[0]) && (!isset($data[0]['user']) || !isset($data[0]['password_hash']))) {
            throw new InvalidArgumentException('Action "' . $action . '" require logging in, provide "user" and "password_hash" parameters!');
        }

        return $this->request($this->actions[$action]['path'], isset($data[0]) ? $data[0] : null, $this->actions[$action]['method'], $this->actions[$action]['class']);
    }

    /**
     * Main method for making requests
     *
     * @param string $path
     * @param array  $data
     * @param string $method
     * @param string $class
     *
     * @return string
     * @throws InvalidArgumentException
     * @throws \GuzzleHttp\Exception\GuzzleException
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
            $raw_result = (string)$response->getBody();
            $result = json_decode($raw_result, true);
        } catch (RequestException $e) {
            $this->debugLog($e);
            $result = ($e->getResponse()) ? (string)$e->getResponse()->getBody() : 'Empty response / Request timed out';
            $raw_result = $result;

            if ($e->getResponse() !== null && $e->getResponse()->getStatusCode() !== 200) {
                $result = $e->getResponse()->getStatusCode() . ' ' . $e->getResponse()->getReasonPhrase();
            } elseif (preg_match("/<[^<]+>/", $result) !== false) {
                $result = 'HTML data returned';
            }

            $result = ['success' => false, 'reason' => $result, 'raw_result' => $raw_result];
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

        return new Response($class, $result, $raw_result);
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
                $multiName = $key . '[' . $multiKey . ']' . (is_array($multiValue) ? '[' . key($multiValue) . ']' : '') . '';
                $multipart[] = ['name' => $multiName, 'contents' => (is_array($multiValue) ? reset($multiValue) : $multiValue)];
            }
        }

        if ($has_resource) {
            return ['multipart' => $multipart];
        }

        return ['form_params' => $data];
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
     * Write to debug log
     *
     * @param $message
     */
    private function debugLog($message)
    {
        $this->debug_log_handler !== null && is_callable($this->debug_log_handler) && call_user_func($this->debug_log_handler, $message);
    }

    /**
     * Write the temporary debug stream to log and close the stream handle
     */
    private function endDebugStream()
    {
        if (is_resource($this->debug_log_stream_handle)) {
            rewind($this->debug_log_stream_handle);
            $this->debugLog('E621 API Verbose HTTP Request output:' . PHP_EOL . stream_get_contents($this->debug_log_stream_handle) . PHP_EOL);
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
