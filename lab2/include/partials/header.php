<?php
/* 
  Сурагчийн хүснэгтэд sisiID гаар key(associate array) хийхэд болохгүй санагдсан
  учир нь сурагч хүснэгтрүү нэмэлт утга оруулахад key өмнө нь зарлагдсан байх
  ёстой.
*/
  include 'functions.php';
  include './configure/conf.php';

//   initFilesWithJsons();

  if(!isset($courses)){
    $courses=readArrayFromFile($coursesFilePath);
  }
  if(!isset($students)){
    $students=readArrayFromFile($studentsFilePath);
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Бяцхан сиси</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="static/stylesheets/bootstrap/bootstrap.min.css">
  <link rel="stylesheet" href="static/stylesheets/main.css">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <a class="navbar-brand" href="#">СИСИма</a>

  <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0">
      <li class="nav-item active">
        <a class="nav-link" href="./">Нүүр хуудас <span class="sr-only">(current)</span></a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="addnew.php">Оюутанд хичээл нэмэх</a>
      </li>
      <li class="nav-item">
        <a class="nav-link disabled" href="#">Disabled</a>
      </li>
    </ul>
    <form class="form-inline my-2 my-lg-0" action="./" method="post">
      <input class="form-control mr-sm-2" type="search" name="searchStudentByLname" placeholder="Оюутан хайх" aria-label="Search">
      <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Хайх</button>
    </form>
  </div>
</nav>