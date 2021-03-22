<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   
    
    <title>crud</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.js" integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="  crossorigin="anonymous"></script>

</head>


<body>
<?php require_once 'conectar.php'; ?>


<?php
    if (isset($_SESSION['message'])): ?>


    <div class="alert alert-primary role="alert <?=$_SESSION['msg_type']?>">

    <?php
        echo $_SESSION['message'];
        unset($_SESSION['message']);
            
    ?>
    </div>

    <?php endif ?>

<div class="container">

    <?php
            $mysqli = new mysqli("localhost","root","","crud") or die(mysqli_error($mysqli));

            $resultado = $mysqli->query("SELECT *from data") or die($mysqli->error);
            
        ?>

                <div class="row justify-content-centere">
                    <table class="table">
                            <thead>
                                <tr>
                                    <th>Nome</th>
                                    <th>Local</th>
                                    <th colspan="2">Acao</th>
                                </tr>
                            </thead>

                            <?php
                                while($row = $resultado->fetch_assoc()):?>
                                    <tr>
                                        <td><?php echo $row['name']; ?></td>
                                        <td><?php echo $row['loc']; ?></td>
                                        <td>
                                            <a href="index.php?edit= <?php echo $row['id']; ?>"
                                                class="btn btn-info">Editar</a>
                                                
                                            <a href="conectar.php?delete= <?php echo $row['id']; ?>"
                                                class="btn btn-danger">Deletar</a>    
                                                
                                
            
                                        </td>
                                    </tr>
                                <?php endwhile; ?>

                            
                    </table>        
                
                </div>


        <?php
        function pre_r($array){
            echo '<pre>';
           print_r($array);
            echo '</pre>';
        }


    ?>
        <div class="row justify-content-center">
            <form action="conectar.php" method="POST">
                
                <input  type="hidden" name="id" value="<?php  echo $id; ?>">
                <div class="form-group">
                    <label>Nome</label>
                    <input type="text" name="name" class="form-control"
                         value="<?php echo $name; ?>" placeholder="Digite Nome">
                </div>
                <div class="form-group">    
                    <label>Local</label>
                    <input type="text" name="loc" class="form-control"
                      value="<?php echo $loc; ?>" placeholder="Digite Local">
                </div>
                <div class="form-group">
                <?php
                    if ($update == true):
                    ?>    
                        <button type="submit" class="btn btn-info" name="update">Atualizar</button>               
                    <?php else: ?>

                        <button type="submit" class="btn btn-primary" name="save">SALVAR</button>
                       
                    <?php endif; ?>
                </div>    
            </form>
        </div>
    </div>

 </div>
</body>
</html>
