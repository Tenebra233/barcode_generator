<?php


namespace Itro\BarcodeGenerator;

use Illuminate\Database\Capsule\Manager;

final class BarcodeGenerator
{
    
    /**
     * plugin version
     *
     * @var string
     */
    const VERSION = '1.0';
    const NONCE_NAME = "itro_ipp_wpnonce";
    
    /** @var self singletone instance */
    private static $instance;
    
    
    /**
     * Cloning is forbidden.
     * @since 1.0
     */
    public function __clone()
    {
        throw new Exception(__('Class already instantiated'), 'itro_ipp');
    }
    
    /**
     *
     * @return BarcodeGenerator
     */
    public static function getInstance()
    {
        if (empty(self::$instance)) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
    
    public function boot()
    {
        //        ob_start();
        
        // CONNESSIONE AL DB TRAMITE ELOQUENT
        
        $capsule = new Manager();
        
        $capsule->addConnection([
            'driver' => 'mysql',
            'username' => DB_USER,
            'database' => DB_NAME,
            'host' => DB_HOST,
            'password' => DB_PASSWORD,
            //		    'charset' => 'utf8',
            //		    'collation' => 'utf8_unicode_ci',
            'prefix' => '',
        ]);
        
        // Make this Capsule instance available globally via static methods... (optional)
        $capsule->setAsGlobal();
        
        // Setup the Eloquent ORM... (optional; unless you've used setEventDispatcher())
        $capsule->bootEloquent();
        
        Hooks::run();
        
        //		$this->registerHooks();
        //		$this->registerMenu();
        
        //        $init_out = ob_get_clean();
    }
    
    

    
   
    
    /**
     * Get the plugin url.
     * @return string
     */
    public function pluginUrl()
    {
        return untrailingslashit(plugins_url('/', __FILE__));
    }
    
    /**
     * Get the plugin path.
     * @return string
     */
    public function pluginPath()
    {
        return untrailingslashit(plugin_dir_path(__FILE__));
    }
    
    /**
     * Get Ajax URL.
     * @return string
     */
    public function ajaxUrl()
    {
        return admin_url('admin-ajax.php', 'relative');
    }
    
}

