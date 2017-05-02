<?php

/**
 * Class PageFeedbackEntry
 *
 * @author Reece Alexander <reece@steadlane.com.au>
 *
 * @property int Rating 1-5 (Terrible-Excellent)
 * @property string Comment An optional comment the user is able to provided
 * @property string IPAddress The IP address is used to enforce uniqueness
 * @property int PageID
 * @method Page Page
 */
class PageFeedbackEntry extends DataObject
{
    /** @var array */
    private static $db = array(
        'Rating' => 'Enum("1,2,3,4,5")',
        'Comment' => 'Text',
        'IPAddress' => 'Varchar(255)'
    );

    /** @var array */
    private static $has_one = array(
        'Page' => 'Page'
    );

    /** @var array */
    private static $summary_fields = array(
        'Rating' => 'Rating',
        'CmsFriendlyComment' => 'Comment'
    );

    /**
     * @return string|HTMLText
     */
    public function getCmsFriendlyComment()
    {
        if (strlen($this->Comment)) {
            return $this->Comment;
        }

        $html = HTMLText::create();
        $html->setValue('<em>No comment was provided..</em>');

        return $html;
    }
}