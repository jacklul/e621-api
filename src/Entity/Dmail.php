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
 * @method int    getId()
 * @method int    getParentId()
 * @method string getTitle()
 * @method string getBody()
 * @method bool   getHasSeen()
 * @method array  getCreatedAt()
 * @method int    getFromId()
 * @method string getFrom()
 * @method int    getToId()
 * @method string getTo()
 *
 * @property int created_at
 */
class Dmail extends Entity
{
    public function getCreatedAtInt()
    {
        return isset($this->created_at['s']) ? $this->created_at['s'] : null;
    }
}
