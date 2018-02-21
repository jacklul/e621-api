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
 * @method int    getWikiId()
 * @method array  getCreatedAt()
 * @method array  getUpdatedAt()
 * @method string getTitle()
 * @method string getBody()
 * @method int    getUpdaterId()
 * @method bool   getLocked()
 * @method int    getVersion()
 */
class WikiHistory extends Entity
{
    public function getCreatedAtInt()
    {
        return isset($this->created_at) && isset($this->created_at['s']) ? $this->created_at['s'] : null;
    }

    public function getUpdatedAtInt()
    {
        return isset($this->updated_at) && isset($this->updated_at['s']) ? $this->updated_at['s'] : null;
    }
}
