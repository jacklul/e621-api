<?php
/**
 * This file is part of the e621 API package.
 *
 * (c) Jack'lul <jacklulcat@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace jacklul\E621API\Entity;

/**
 * @method string getFavoritedUsers()
 */
class FavoritedUsers extends Entity
{
    public function getFavoritedUsersArray()
    {
        return isset($this->favorited_users) ? explode(',', $this->favorited_users) : null;
    }
}
