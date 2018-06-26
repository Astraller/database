<?php

class Db{

	private $link = null;
	private $resource = null;

	public function __construct(){
		global $config;
		$this->link = mysql_connect($config['db']['server'], $config['db']['user'], $config['db']['password']);
		mysql_select_db($config['db']['database'], $this->link);
		mysql_query("SET NAMES utf8");
		return $this;
	}

	public function query($sql){
		if(empty($sql))die("Query is empty!");
		$this->resource = mysql_query($sql, $this->link);
		if(mysql_errno($this->link) != 0){
			die(mysql_error($this->link)."<br />\nSQL:".$sql);
		}
		return $this;
	}

	public function insertId(){
		if($this->link == null)die("Resource is NULL!");
		return mysql_insert_id($this->link);
	}

	public function getOne(){
		if($this->resource == null)die("Resource is NULL!");
		return mysql_fetch_object($this->resource);
	}

	public function getOneArray(){
		if($this->resource == null)die("Resource is NULL!");
		return mysql_fetch_assoc($this->resource);
	}

	public function getField($fieldname, $row = 0){
		if(empty($fieldname))die("Field name was empty!");
		if($this->resource == null)die("Resource is NULL!");

		return @mysql_result($this->resource, $row, $fieldname);
	}

	public function getMany($key = "id"){
		if($this->resource == null)die("Resource is NULL!");
		$result = array();
		while($res = mysql_fetch_object($this->resource)){
			$result[$res[$key]] = $res;
		}
		return $result;
	}

	public function getManyArray($key = "id"){
		if($this->resource == null)die("Resource is NULL!");
		$result = array();
		while($res = mysql_fetch_assoc($this->resource)){
			$result[$res[$key]] = $res;
		}
		return $result;
	}

	public function getFieldArray($field, $key = "id"){
		if($this->resource == null)die("Resource is NULL!");
		$result = array();
		while($res = mysql_fetch_assoc($this->resource)){
			$result[$res[$key]] = $res[$field];
		}
		return $result;
	}

	public static function instance(){
		return new self();
	}

}

?>