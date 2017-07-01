<?php
/*
 You may not change or alter any portion of this comment or credits
 of supporting developers from this source code or any supporting source code
 which is considered copyrighted (c) material of the original comment or credit authors.

 This program is distributed in the hope that it will be useful,
 but WITHOUT ANY WARRANTY; without even the implied warranty of
 MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
*/
/**
 * contact module for xoops
 *
 * @copyright       The XOOPS Project http://sourceforge.net/projects/xoops/
 * @license         GPL 2.0 or later
 * @package         contact
 * @since           1.0
 * @min_xoops       2.5.7
 * @author          Goffy (xoops.wedega.com) - Email:<webmaster@wedega.com> - Website:<http://xoops.wedega.com>
 */
defined('XOOPS_ROOT_PATH') || exit('Restricted access');

/**
 * Class ContactHelper
 */
class ContactHelper
{
    /**
     * @var string
     */
    private $dirname;
    /**
     * @var string
     */
    private $module;
    /**
     * @var string
     */
    private $handler;
    /**
     * @var string
     */
    private $config;
    /**
     * @var string
     */
    private $debug;
    /**
     * @var array
     */
    private $debugArray = array();
    /*
    *  @protected function constructor class
    *  @param mixed $debug
    */
    /**
     * ContactHelper constructor.
     * @param $debug
     */
    protected function __construct($debug)
    {
        $this->debug = $debug;
        $this->dirname =  basename(dirname(__DIR__));
    }
    /*
    *  @static function &getInstance
    *  @param mixed $debug
    */
    /**
     * @param bool $debug
     * @return bool|ContactHelper
     */
    public static function &getInstance($debug = false)
    {
        static $instance = false;
        if (!$instance) {
            $instance = new self($debug);
        }
        return $instance;
    }
    /*
    *  @static function getModule
    *  @param null
    */
    /**
     * @return string
     */
    public function &getModule()
    {
        if ($this->module === null) {
            $this->initModule();
        }
        return $this->module;
    }
    /*
    *  @static function getConfig
    *  @param string $name
    */
    /**
     * @param null $name
     * @return null|string
     */
    public function getConfig($name = null)
    {
        if ($this->config === null) {
            $this->initConfig();
        }
        if (!$name) {
            $this->addLog('Getting all config');
            return $this->config;
        }
        if (!isset($this->config[$name])) {
            $this->addLog("ERROR :: CONFIG '{$name}' does not exist");
            return null;
        }
        $this->addLog("Getting config '{$name}' : " . $this->config[$name]);
        return $this->config[$name];
    }
    /*
    *  @static function setConfig
    *  @param string $name
    *  @param mixed $value
    */
    /**
     * @param null $name
     * @param null $value
     * @return mixed
     */
    public function setConfig($name = null, $value = null)
    {
        if ($this->config === null) {
            $this->initConfig();
        }
        $this->config[$name] = $value;
        $this->addLog("Setting config '{$name}' : " . $this->config[$name]);
        return $this->config[$name];
    }
    /*
    *  @static function getHandler
    *  @param string $name
    */
    /**
     * @param $name
     * @return mixed
     */
    public function &getHandler($name)
    {
        if (!isset($this->handler[$name . 'Handler'])) {
            $this->initHandler($name);
        }
        $this->addLog("Getting handler '{$name}'");
        return $this->handler[$name . 'Handler'];
    }
    /*
    *  @static function initModule
    *  @param null
    */
    public function initModule()
    {
        global $xoopsModule;
        if (isset($xoopsModule) && is_object($xoopsModule) && $xoopsModule->getVar('dirname') == $this->dirname) {
            $this->module = $xoopsModule;
        } else {
            /** @var XoopsModule $hModule */
            $hModule = xoops_getHandler('module');
            $this->module = $hModule::getByDirname($this->dirname);
        }
        $this->addLog('INIT MODULE');
    }
    /*
    *  @static function initConfig
    *  @param null
    */
    public function initConfig()
    {
        $this->addLog('INIT CONFIG');
        /** @var XoopsConfigHandler $hModConfig */
        $hModConfig = xoops_getHandler('config');
        $this->config = $hModConfig->getConfigsByCat(0, $this->getModule()->getVar('mid'));
    }
    /*
    *  @static function initHandler
    *  @param string $name
    */
    /**
     * @param $name
     */
    public function initHandler($name)
    {
        $this->addLog('INIT ' . $name . ' HANDLER');
        $this->handler[$name . 'Handler'] = xoops_getModuleHandler($name, $this->dirname);
    }
    /*
    *  @static function addLog
    *  @param string $log
    */
    /**
     * @param $log
     */
    public function addLog($log)
    {
        if ($this->debug) {
            if (is_object($GLOBALS['xoopsLogger'])) {
                $GLOBALS['xoopsLogger']->addExtra($this->module->name(), $log);
            }
        }
    }
}
