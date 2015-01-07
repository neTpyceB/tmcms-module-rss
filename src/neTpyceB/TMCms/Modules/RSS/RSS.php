<?php
namespace neTpyceB\TMCms\Modules\RSS;

defined('INC') or exit;

/**
 * Class ModuleRss
 */
class Rss implements neTpyceB\TMCms\Modules\IModule
{
    /** @var $this */
    private static $instance;

    public static function getInstance() {
        if (!self::$instance) self::$instance = new self;
        return self::$instance;
    }
}