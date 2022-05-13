<?php   
  $bdd =new  mysqli('localhost', 'root', '', 'ufr-sds');
  $id = $_GET['updateid'];
  $sql = "SELECT * FROM etudiants WHERE matricule = '$id'";
  $result = mysqli_query($bdd, $sql);
  $row = mysqli_fetch_assoc($result);
    $name= $row['nom'];
    $prenom= $row['prenom']; 
    $naissance= $row['date_naissance'];
    $email= $row['email'];
    $numero= $row['telephone'];
    $tuteur= $row['idtuteur'];
  
    


    if(isset($_POST['Enregistrer'])){
        $name = $_POST['nometud'];
        $prenom = $_POST['prenometud'];
        $naissance = $_POST['datenaissanceetud'];
        $email = $_POST['emailetud']; 
        
        $numero = $_POST['telephoneetud'];
      
       
       
        $sql = "UPDATE etudiants SET nom = '$name', prenom = '$prenom', date_naissance = '$naissance', email='$email',
         telephone = '$numero'  WHERE matricule = '$id'";
        $result = mysqli_query($bdd, $sql);
        if($result){
            header("location:index.php");
            
        }
        else{
            echo "Erreur lors de la modification";
        }
    }
    
    
 ?>
 <?php 
  $query = " SELECT * FROM `tuteurs` ORDER BY `id_tuteur` DESC";
  $solution = mysqli_query($bdd, $query)
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
    <div class="container">
        <div class="row">
            <div class="col md-6  offset-md-2">
            <form action="" method="post">
                                            <h5>Information de l'étudiant</h5>
                                                <div class="mb-1">
                                                    <label for="exampleInputEmail1" class="form-label">Nom</label>
                                                    <input type="text" class="form-control" id="completeprenom" name="nometud" value="<?php echo $row ['nom']?>">
                                                                    
                                                </div>
                                                <div class="mb-1">
                                                    <label for="exampleInputEmail1" class="form-label">Prenom</label>
                                                    <input type="text" class="form-control" id="completeprenom" name="prenometud"  value="<?php echo $row ['prenom']?>">
                                                                
                                                </div>
                                                <div class="mb-1">
                                                    <label for="exampleInputEmail1" class="form-label">Date de Naissance</label>
                                                    <input type="date" class="form-control" id="completedatedebut" aria-describedby="emailHelp" name="datenaissanceetud" value="<?php echo $row ['date_naissance']?>">
                                                                
                                                </div>
                                                <div class="mb-1">
                                                    <label for="exampleInputEmail1" class="form-label">Email</label>
                                                    <input type="text" class="form-control" id="completeprenom" name="emailetud" value="<?php echo $row ['email']?>">
                                                                
                                                </div>
                                                <div class="mb-1">
                                                    <label for="exampleInputEmail1" class="form-label">Telephone</label>
                                                    <input type="text" class="form-control" id="completeprenom" name="telephoneetud" value="<?php echo $row ['telephone']?>">
                                                                
                                                </div>
                                                <h5>Information du tuteur</h5>
                                                <div class="mb-1">
                                                    <label for="exampleInputEmail1" class="form-label">Nom Et Prenom</label>
                                                    <select name ="nomtuteur" type="text" class="form-control" value="<?php echo $row ['idtuteur']?>" >
                                                        <?php 
                                                            while($lign=mysqli_fetch_assoc($solution)){

                                                            echo "<option value ='$lign[id_tuteur]'>$lign[nom] $lign[prenom]</option>";
                                                            }
                                                        ?>
                                                    </select>
                                                                
                                                </div>
                                                <button type="submit" class="btn btn-primary" name="Enregistrer" onclick="AddUser()">Valider la modification</button>
                                        </form>

            </div>
        </div>
    </div>

</body>
</html>