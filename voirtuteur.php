

<?php   
  $bdd =new  mysqli('localhost', 'root', '', 'ufr-sds');
  $id = $_GET['afficheid'];
  $sql = "SELECT * FROM tuteurs  WHERE id_tuteur = '$id'";
  $result = mysqli_query($bdd, $sql);
  $row = mysqli_fetch_assoc($result);
    $name= $row['nom'];
    $prenom= $row['prenom']; 
    $email= $row['email']; 
    $numero= $row['telephone']; 
   
  
    


   
    
    
 ?>
 










<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0"> <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>

    <title>Document</title>
</head>
<body>
    <div class="container py-5">
        <div class="row">
            <div class="col-md-3 offset-md-4 mt-5">
            <h2 class="style">Coordonnees tuteur</h2>
            </div>
        </div>
        <div class="row py-4">
            <div class="col-md-5 offset-md-3 py-5">
               
                <table class="table table-bordered py-5">
                    <thead>
                        <tr>
                            <td>Nom</td>
                            <td>Prenom</td>
                            <td>Email</td>
                            <td>Telephone</td>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?php echo $row['nom']   ?></td>
                            <td><?php echo   $row['prenom']  ?></td>
                            <td><?php echo   $row['email']  ?></td>
                            <td><?php echo    $row['telephone'] ?></td>
                        </tr>
                    </tbody>

                </table>

            </div>
        </div>
        <div class="row">
            <div class="col-md-3 offset-md-4 mt-5">
           <a href="index.php"><button class="btn btn-primary">Retour</button></a> 
            </div>
        </div>

    </div>
    
</body>
</html>