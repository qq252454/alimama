<?php
namespace lib\config;
$cfg = new Config();
$cfg->config();
class Config{

	public function config(){

		return array(
			"host" => "localhost",
			"use" => "root",
			"pass" => "root",
			"port" => 3306
		);
	}
}