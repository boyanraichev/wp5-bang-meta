<?php 
namespace Boyo\WPBangMeta;
	
if (!defined('ABSPATH')) die;

abstract class CustomMeta {
	
	/** @var The single instance of the class */
	private static $_instance = null;	
	
	// Don't load more than one instance of the class
	public static function instance() {
		if ( null == self::$_instance ) {
            self::$_instance = new self();
        }
        return self::$_instance;
    }
    
	private $fieldsRaw = [];
	
	private $fields = [];
	
	public function setFields(array $fields, int $priority = 10) {
		
		while ($this->hasPriority($priority)) {
			$priority++;
		}
		
		$this->fieldsRaw[$priority] = $fields;
		
		$this->fields = [];
		
		foreach($this->fieldsRaw as $fields) {
			$this->fields .= $fields;
		}
		
		return $this->fields;
		
	}
	
	public function getFields() {
		
		return $this->fields;
		
	}
	
	abstract function register();
	
	public hasPriority($priority) {
		
		if (isset($this->fieldsRaw[$priority])) {
			return true;
		}
		
		return false;
		
	}
	
}