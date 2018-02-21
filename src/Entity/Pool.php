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
 * @method string getName()
 * @method array  getCreatedAt()
 * @method array  getUpdatedAt()
 * @method int    getUserId()
 * @method bool   getIsLocked()
 * @method int    getPostCount()
 *
 * This methods are not available in poolIndex() but only in poolShow():
 * @method string getDescription()
 * @method string getShortname()
 * @method array  getPosts()
 * @method bool   getIsActive()
 */
class Pool extends Entity
{
    public function __construct($data)
    {
        if (isset($data['posts'])) {
            /** @var $class [] $result */
            foreach ($data['posts'] as &$post) {
                $post = new Post($post);
            }
        }

        parent::__construct($data);
    }

    public function getCreatedAtInt()
    {
        return isset($this->created_at) && isset($this->created_at['s']) ? $this->created_at['s'] : null;
    }

    public function getUpdatedAtInt()
    {
        return isset($this->updated_at) && isset($this->updated_at['s']) ? $this->updated_at['s'] : null;
    }
}
