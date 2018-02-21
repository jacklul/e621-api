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
 * @method string getBody()
 * @method array  getCreatedAt()
 * @method int    getId()
 * @method int    getReportedBy()
 * @method int    getScore()
 * @method int    getUserId()
 */
class UserRecord extends Entity
{
    public function getCreatedAtInt()
    {
        return isset($this->created_at) && isset($this->created_at['s']) ? $this->created_at['s'] : null;
    }
}
