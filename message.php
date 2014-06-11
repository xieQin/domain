<?php

class message{

	public $name;
	public $email;
	public $content;

	public function __set($name,$value){
		$this->$name = $value;
	}

	public function __get($name){
		if(!isset($this->$name)){
			$this->$name = $value;
		}
	}
}

class levelModel{
	public function write(gbookModel $gb,$data){
		$book = $gb->getBookPath();
		$gb->write($data);
	}
}

class gbookModel{

	private $bookPath;
	private $data;

	public function setBookPath($bookPath){
		$this->bookPath = $bookPath;
	}

	public function getBookPath(){
		return $this->$bookPath;
	}

	public function open(){

	}

	public function close(){

	}

	public function read(){
		return file_get_contents($this->bookPath);
	}

	public function write($data){
		$this->data = self::safe($data) -> name."&".self::safe($data) ->email."\r\nsaid:\r\n".self::safe($data) ->content;
		return file_put_contents($this->bookPath, $this->data, FILE_APPEND);
	}

	public function safe($data){
		$reflect = new ReflectionObject($data);
		$props = $reflect->getProperties();
		$messagebox = new stdClass();
		foreach ($props as $prop) {
			$ivar = $prop->getName();
			$messagebox->$ivar = trim($prop->getValue($data));
		}
		return $messagebox;
	}

	public function delete(){
		file_put_contents($this->bookPath, "it is empty now !");
	}
}

class authorControl{

	public function message(levelModel $l, gbookModel $g, message $data){
		$l->write($g, $data);
	}

	public function view(gbookModel $g){
		return $g->read();
	}

	public function delete(gbookModel $g){
		$g->delete();
		echo self::view($g);
	}
}

$message = new message;
$message->name = 'phper';
$message->email = 'phper@php.net';
$message->content = 'a crazy phper loves php so much';
$gb = new authorControl();
$pen = new levelModel();
$book = new gbookModel();
$book->setBookPath("D:\xampp\htdocs\domain\a.txt");
$gb->message($pen,$book,$message);
echo $gb->view($book);
$gb->delete($book);