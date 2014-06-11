<?php

class levelModel{
	public function write(gbookModel $gb,$data){
		$book = $gb->getBookPath();
		$gb->write($data);
	}
}