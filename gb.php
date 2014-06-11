<?php

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