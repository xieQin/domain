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