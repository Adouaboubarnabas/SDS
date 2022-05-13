<?php
  session_start();
  // Vérifiez si l'utilisateur est connecté, sinon redirigez-le vers la page de connexion
  if(!isset($_SESSION["email"])){
    header("Location: login.php");
    exit(); 
  }
   $bdd =new  mysqli('localhost', 'root', '', 'ufr-sds');
  if(isset($_POST['Enregistrer']))
  {
      if(!empty($_POST['nom']) AND !empty($_POST['prenom']) AND !empty($_POST['naissance']) AND!empty($_POST['email']) AND!empty($_POST['telephone']) AND!empty($_POST['debut']))
      {
        $nom = htmlspecialchars($_POST['nom']);
        $prenom = htmlspecialchars($_POST['prenom']);
        $naissance = htmlspecialchars($_POST['naissance']);
        $email = htmlspecialchars($_POST['email']);
        $telephone = htmlspecialchars($_POST['telephone']);
        $datedebut = htmlspecialchars($_POST['debut']);
  
  
        
        $sql = "INSERT INTO etudiants (nom, prenom, date_naissance, email, telephone, date_inscription)
        VALUES ('$nom', '$prenom', '$naissance', '$email', '$telephone', '$datedebut')";
        $result = mysqli_query($bdd, $sql);
        $_SESSION['message'] = "Votre abonnement a été enregistré";
        $_SESSION['msg_type'] = "success";
        header('location:index.php');
            if($result){
              
            header('location:index.php');
              
            }else{
                echo "Erreur d'ajout";
            } 
      }
      else{
        $error = "Veuillez remplir tous les champs!";
      }
  }
  ?>