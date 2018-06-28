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
 * This class contain API methods configuration
 */
class Methods
{
    /**
     * List of supported API methods and their execution configuration
     *
     * @var array
     */
    private static $methods_config = [
        'postCreate'           => [
            'path'          => 'post/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'postUpdate'           => [
            'path'          => 'post/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'post/flag.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'postDestroy'          => [
            'path'          => 'post/destroy.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'post/revert_tags.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'postVote'             => [
            'path'          => 'post/vote.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'tag/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'artist/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'artistUpdate'         => [
            'path'          => 'artist/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'artistDestroy'        => [
            'path'          => 'artist/destroy.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'comment/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'commentUpdate'        => [
            'path'          => 'comment/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'commentDestroy'       => [
            'path'          => 'comment/destroy.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'commentHide'          => [
            'path'          => 'comment/hide.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'commentUnhide'        => [
            'path'          => 'comment/unhide.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'commentVote'          => [
            'path'          => 'comment/vote.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'blipCreate'           => [
            'path'          => 'blip/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'blipUpdate'           => [
            'path'          => 'blip/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'blip/hide.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'blipUnhide'           => [
            'path'          => 'blip/unhide.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'wikiIndex'            => [
            'path'   => 'wiki/index.json',
            'method' => 'GET',
            'class'  => Wiki::class,
        ],
        'wikiCreate'           => [
            'path'          => 'wiki/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'wikiUpdate'           => [
            'path'          => 'wiki/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'wikiShow'             => [
            'path'   => 'wiki/show.json',
            'method' => 'GET',
            'class'  => Wiki::class,
        ],
        'wikiDestroy'          => [
            'path'          => 'wiki/destroy.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'wikiLock'             => [
            'path'          => 'wiki/lock.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'wikiUnlock'           => [
            'path'          => 'wiki/unlock.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'wikiRevert'           => [
            'path'          => 'wiki/revert.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'note/revert.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'noteUpdate'           => [
            'path'          => 'note/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'dmail/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'dmailInbox'           => [
            'path'          => 'dmail/inbox.json',
            'method'        => 'GET',
            'class'         => Dmail::class,
            'require_login' => true,
        ],
        'dmailShow'            => [
            'path'          => 'dmail/show.json',
            'method'        => 'GET',
            'class'         => Dmail::class,
            'require_login' => true,
        ],
        'dmailHide'            => [
            'path'          => 'dmail/hide.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'dmailUnhide'          => [
            'path'          => 'dmail/unhide.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'dmailHideAll'         => [
            'path'          => 'dmail/hide_all.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'dmailUnhideAll'       => [
            'path'          => 'dmail/unhide_all.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'dmailMarkAllRead'     => [
            'path'          => 'dmail/mark_all_read.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'forumCreate'          => [
            'path'          => 'forum/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'forumUpdate'          => [
            'path'          => 'forum/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'forum/hide.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'forumUnhide'          => [
            'path'          => 'forum/unhide.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'pool/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'poolCreate'           => [
            'path'          => 'pool/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'poolDestroy'          => [
            'path'          => 'pool/destroy.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'poolAddPost'          => [
            'path'          => 'pool/add_post.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'poolRemovePost'       => [
            'path'          => 'pool/remove_post.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'set/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'setUpdate'            => [
            'path'          => 'set/update.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'setAddPost'           => [
            'path'          => 'set/add_post.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'setRemovePost'        => [
            'path'          => 'set/remove_post.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'setDestroy'           => [
            'path'          => 'set/destroy.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'setMaintainers'       => [
            'path'          => 'set/maintainers.json',
            'method'        => 'GET',
            'class'         => SetMaintainer::class,
            'require_login' => true,
        ],
        'setMaintainerIndex'   => [
            'path'          => 'set_maintainer/index.json',
            'method'        => 'GET',
            'class'         => SetMaintainer::class,
            'require_login' => true,
        ],
        'setMaintainerCreate'  => [
            'path'          => 'set_maintainer/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'setMaintainerDestroy' => [
            'path'          => 'set_maintainer/destroy.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'setMaintainerApprove' => [
            'path'          => 'set_maintainer/approve.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'setMaintainerDeny'    => [
            'path'          => 'set_maintainer/deny.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
        ],
        'setMaintainerBlock'   => [
            'path'          => 'set_maintainer/block.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
            'path'          => 'ticket/create.json',
            'method'        => 'POST',
            'class'         => Generic::class,
            'require_login' => true,
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
     * @param $name
     * @return array|bool
     * @throws \InvalidArgumentException
     */
    public static function lookupByName($name)
    {
        if (empty($name)) {
            throw new \InvalidArgumentException('Argument "name" cannot be empty');
        }

        if (!isset(self::$methods_config[$name])) {
            throw new \InvalidArgumentException('Method "' . $name . '" doesn\'t exist');
        }

        return self::$methods_config[$name];
    }

    /**
     * @param $path
     * @return null|\stdClass
     * @throws \InvalidArgumentException
     */
    public static function lookupByPath($path)
    {
        if (empty($path)) {
            throw new \InvalidArgumentException('Argument "path" cannot be empty');
        }

        foreach (self::$methods_config as $key => $val) {
            if ($val['path'] === $path) {
                return $val;
            }
        }

        return null;
    }
}