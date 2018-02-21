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
 * @method array  getCreatedAt()
 * @method array  getUpdatedAt()
 * @method int    getCreatorId()
 * @method int    getX()
 * @method int    getY()
 * @method int    getWidth()
 * @method int    getHeight()
 * @method bool   getIsActive()
 * @method int    getPostId()
 * @method string getBody()
 * @method int    getVersion()
 */
class Note extends Entity
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
