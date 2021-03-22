<?php

session_start();

$mysqli = new mysqli("localhost","root","","crud") or die(mysqli_error($mysqli));
$update = false;
$name = '';
$loc = '';
$id = 0;

if (isset($_POST['save']) ){
    $name = $_POST['name'];
    $loc = $_POST['loc'];

    

$mysqli->query("INSERT INTO data(name,loc) values('$name','$loc')") or
    die($mysqli->error);

    $_SESSION['message'] = "salvo com sucesso";
    $_SESSION['msg_type'] = "sucesso!";

    header("location: index.php");
}

if (isset($_GET['delete'])){

    $id = $_GET['delete'];
    $mysqli->query("DELETE FROM data WHERE id =$id") or die($mysqli->error());

    $_SESSION['message'] = "deletado com sucesso";
    $_SESSION['msg_type'] = "excluido!";

    header("location: index.php");
}

if (isset($_GET['edit'])){
    $id = $_GET['edit'];
    $update = true;
    $resultado = $mysqli->query("SELECT * FROM data WHERE id=$id") or die($mysqli->error());
    if(count($resultado) ==1){
        $row = $resultado->fetch_array();
        $name = $row['name'];
        $loc = $row['loc'];
    }
}

  if (isset($_POST['update'])){
      $id = $_POST['id'];
      $name = $_POST['name'];
      $loc = $_POST['loc'];
    
      $mysqli->query("UPDATE data SET name='$name', loc ='$loc' WHERE id=$id") or 
      die($mysqli->error());
      $_SESSION['message'] = "Atualizado com sucesso";
      $_SESSION['msg_type'] = "erro";

      header('location: index.php');



  }