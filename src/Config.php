<?php 
namespace Boyo\WPBangMeta;

if (!defined('ABSPATH')) die;

class Config {
	
	/** @var The single instance of the class */
	private static $_instance = null;	
	
	// Don't load more than one instance of the class
	public static function instance() {
		if ( null == self::$_instance ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }	

	public function __construct() {
	    
		if (!defined('PROJECT_DIR')) {
			define('PROJECT_DIR',dirname(__DIR__,4));
		} 
		
	}
	
	// holds the loaded config files
    private $config = [];
    
    // loads and returns a config key
    public function get($key) {
	    
	    $keySplit = explode('.', $key);
	    
	    if (isset($keySplit[0])) {
		    
		    if (!isset($this->config[$keySplit[0]])) {
			    
			    if (file_exists( PROJECT_DIR . '/config/' . $keySplit[0] . '.php')) {
				    
				    $this->config[$keySplit[0]] = require_once PROJECT_DIR . '/config/' . $keySplit[0] . '.php';
			    }
		    }
		    
		    if (isset($keySplit[1]) && isset($this->config[$keySplit[0]][$keySplit[1]])) {
			    
			    return $this->config[$keySplit[0]][$keySplit[1]];
			    
			} else {
				
				if (isset($this->config[$keySplit[0]])) {
				
					return $this->config[$keySplit[0]];
						
				}
				
			}
			
			
	    }
	    
	    return null;
    }

}