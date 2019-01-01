<?php 
namespace Boyo\WPBangMeta;
	
if (!defined('ABSPATH')) die;

abstract class CustomMeta {
	
	private static $_instances = array();
	
    public static function instance() {
        $class = get_called_class();
        if (!isset(self::$_instances[$class])) {
            self::$_instances[$class] = new $class();
        }
        return self::$_instances[$class];
    }
    
	private $fieldsRaw = [];
	
	public $fields = [];
	
	public function setFields(array $fields, int $priority = 10) {
		
		while ($this->hasPriority($priority)) {
			$priority++;
		}
		
		$this->fieldsRaw[$priority] = $fields;
		
		$this->fields = [];
		
		foreach($this->fieldsRaw as $fields) {
			$this->fields += $fields;
		}
		
		return $this->fields;
		
	}
	
	public function getFields() {
		
		return $this->fields;
		
	}
	
	abstract function register();
	
	public function hasPriority($priority) {
		
		if (isset($this->fieldsRaw[$priority])) {
			return true;
		}
		
		return false;
		
	}
	
}