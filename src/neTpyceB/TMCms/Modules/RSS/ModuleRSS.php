<?php
namespace neTpyceB\TMCms\Modules\RSS;

use neTpyceB\TMCms\Modules\IModule;

defined('INC') or exit;

/**
 * Class ModuleRss
 */
class ModuleRSS implements IModule
{
    /** @var $this */
    private static $instance;

    public static $tables = [];

    public static function getInstance() {
        if (!self::$instance) self::$instance = new self;
        return self::$instance;
    }

    private $items = [];
    private $channel_title;
    private $channel_link;
    private $channel_image;
    private $channel_image_link;

    /**
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * @param array $items
     * @return $this
     */
    public function setItems(array $items)
    {
        $this->items = $items;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannelTitle()
    {
        return $this->channel_title;
    }

    /**
     * @param string $channel_title
     * @return $this
     */
    public function setChannelTitle($channel_title)
    {
        $this->channel_title = $channel_title;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannelLink()
    {
        return $this->channel_link;
    }

    /**
     * @param string $channel_link
     * @return $this
     */
    public function setChannelLink($channel_link)
    {
        $this->channel_link = $channel_link;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannelImage()
    {
        return $this->channel_image;
    }

    /**
     * @param string $channel_image
     * @return $this
     */
    public function setChannelImage($channel_image)
    {
        $this->channel_image = $channel_image;

        return $this;
    }

    /**
     * @return string
     */
    public function getChannelImageLink()
    {
        return $this->channel_image_link;
    }

    /**
     * @param string $channel_image_link
     * @return $this
     */
    public function setChannelImageLink($channel_image_link)
    {
        $this->channel_image_link = $channel_image_link;

        return $this;
    }

    public function publish() {
        $res = '<?xml version="1.0" encoding="utf-8"?><rss version="2.0"><channel><title>'. htmlspecialchars($this->getChannelTitle()) .'</title><link>'. $this->getChannelLink() .'</link>';
        if ($this->getChannelImage()) {
            $res .= '<image><url>'. $this->getChannelImage() .'</url>';
            if ($this->getChannelImageLink()) $res .= '<link>'. $this->getChannelImageLink() .'</link>';
            $res .= '</image>';
        }
        $items = $this->getItems();
        while (list(, $v) = each($items)) {
            $res .= '<item>';
            if (isset($v['title'])) $res .= '<title><![CDATA['. $v['title'] .']]></title>';
            if (isset($v['link'])) $res .= '<link>'. htmlspecialchars($v['link']) .'</link>';
            if (isset($v['description'])) $res .= '<description><![CDATA['. $v['description'] .']]></description>';
            if (isset($v['pubDate'])) {
                if (ctype_digit($v['pubDate'])) $res .= '<pubDate>'. gmdate('D, d M Y H:i:s', $v['pubDate']) .' GMT</pubDate>';
                else $res .= '<pubDate>'. $v['pubDate'] .'</pubDate>';
            }
            if (isset($v['category'])) $res .= '<category>'. htmlspecialchars($v['category']) .'</category>';
            $res .= '</item>';
        }
        unset($v);
        $res .= '</channel></rss>';
        return $res;
    }

    public function publishHeaders() {
        header('Content-type: application/xml');
    }
}