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
 * @method string getTags()
 * @method string getLockedTags()
 * @method string getDescription()
 * @method array  getCreatedAt()
 * @method int    getCreatorId()
 * @method string getAuthor()
 * @method int    getChange()
 * @method string getSource()
 * @method string getScore()
 * @method string getFavCount()
 * @method string getMd5()
 * @method string getFileSize()
 * @method string getFileUrl()
 * @method string getFileExt()
 * @method string getSampleUrl()
 * @method string getSampleWidth()
 * @method string getSampleHeight()
 * @method string getPreviewUrl()
 * @method string getPreviewWidth()
 * @method string getPreviewHeight()
 * @method string getRating()
 * @method string getStatus()
 * @method string getWidth()
 * @method string getHeight()
 * @method bool   getHasComments()
 * @method bool   getHasNotes()
 * @method bool   getHasChildren()
 * @method string getChildren()
 * @method string getParentId()
 * @method array  getArtist()
 * @method array  getSources()
 * @method string getDelReason()
 *
 * @property int created_at
 * @property string children
 */
class Post extends Entity
{
    public function getCreatedAtInt()
    {
        return isset($this->created_at['s']) ? $this->created_at['s'] : null;
    }

    public function getChildrenArray()
    {
        return isset($this->children) ? explode(',', $this->children) : null;
    }
}
