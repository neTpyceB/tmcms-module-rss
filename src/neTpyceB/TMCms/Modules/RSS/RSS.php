<?php
namespace neTpyceB\TMCms\Modules\RSS;

use neTpyceB\TMCms\Modules\IModule;

defined('INC') or exit;

/**
 * Class ModuleRss
 */
class Rss implements IModule
{
    /** @var $this */
    private static $instance;

    public static function getInstance() {
        if (!self::$instance) self::$instance = new self;
        return self::$instance;
    }
}