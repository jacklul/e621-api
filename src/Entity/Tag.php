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
 * @method string getId()
 * @method string getName()
 * @method string getCount()
 * @method string getType()
 * @method bool   getTypeLocked()
 *
 * @property int type
 */
class Tag extends Entity
{
    /**
     * @return null|string
     */
    public function getTypeString()
    {
        switch ($this->type) {
            case 0:
                return 'general';
            case 1:
                return 'artist';
            case 3:
                return 'copyright';
            case 34:
                return 'character';
            case 5:
                return 'species';
            default:
                return null;
        }
    }
}
