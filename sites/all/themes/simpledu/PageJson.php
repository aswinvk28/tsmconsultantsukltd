<?php
/*
 * Created on 15 Aug 2012
 *
 * To change the template for this generated file go to
 * Window - Preferences - PHPeclipse - PHP - Code Templates
 */
 
require_once("DBQuery.php"); 

class JsonService {
	
	// for cache
//	private $cid;
//	private $data;
//	private $bin;
	
	private $DBQuery;
	
	function __construct() {
		$this->DBQuery = new DBQuery();
	}
	
	public function fetchProviders($machineName) {
		return drupal_json_encode($this->DBQuery->fetchProviders($machineName));
	}
	
	public function fetchCourses($fetchCourseStyle) {
		if(empty($fetchCourseStyle)) {
			return false;
		}
		if($fetchCourseStyle !== "COMBO" && $fetchCourseStyle !== "DESIGN") {
			return "false";
		}
		return drupal_json_encode($this->DBQuery->fetchCourses($fetchCourseStyle));
	}
	
	public function fetchFrontPageContent($nodeType) {
		return drupal_json_encode($this->DBQuery->fetchFrontPageContent($nodeType));
	}
	
	public function fetchFAQs($machineName) {
		return drupal_json_encode($this->DBQuery->fetchFAQs($machineName));
	}
	
	public function fetchCourseCategory($machineName) {
		return drupal_json_encode($this->DBQuery->fetchCourseCategory($machineName));
	}
	
	public function setCache($array = array()) {
		
	}
	
}

?>
