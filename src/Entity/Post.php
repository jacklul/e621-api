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
 * @method int getId()
 * @method string getAuthor()
 * @method int getCreatorId()
 * @method array getCreatedAt()
 * @method string getStatus()
 * @method string getSource()
 * @method array getSources()
 * @method string getTags()
 * @method array getArtist()
 * @method string getDescription()
 * @method string getFavCount()
 * @method string getScore()
 * @method string getRating()
 * @method string getParentId()
 * @method bool getHasChildren()
 * @method string getChildren()
 * @method bool getHasNotes()
 * @method bool getHasComments()
 * @method string getMd5()
 * @method string getFileUrl()
 * @method string getFileExt()
 * @method string getFileSize()
 * @method string getWidth()
 * @method string getHeight()
 * @method string getSampleUrl()
 * @method string getSampleWidth()
 * @method string getSampleHeight()
 * @method string getPreviewUrl()
 * @method string getPreviewWidth()
 * @method string getPreviewHeight()
 * @method string getDelReason()
 *
 * @package jacklul\E621API\Entity
 */
class Post extends Entity
{
    public function getCreatedAtInt()
    {
        return isset($data['created_at']['s']) ? $data['created_at']['s'] : null;
    }

    public function getChildrenArray()
    {
        return isset($data['children']) ? explode(',', $data['children']) : null;
    }
}
