<?php

class setupController extends BaseController {
	
	protected $layout='master.master';
	
	public function __construct() {

	}
	public function department() {
		$this->layout->title="Setup";
	}
}

?>