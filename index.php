<?php
require('securite.php') ; 
   $bdd =new  mysqli('localhost', 'root', '', 'ufr-sds');
  if(isset($_POST['Enregistrer']))
  {
      if(!empty($_POST['nometud']) AND !empty($_POST['prenometud']) AND !empty($_POST['datenaissanceetud']) AND!empty($_POST['emailetud']) AND!empty($_POST['telephoneetud']) AND!empty($_POST['nomtuteur']))
      {
        $nom = htmlspecialchars($_POST['nometud']);
        $prenom = htmlspecialchars($_POST['prenometud']);
        $naissance = htmlspecialchars($_POST['datenaissanceetud']);
        $email = htmlspecialchars($_POST['emailetud']);
        $telephone = htmlspecialchars($_POST['telephoneetud']); 
        $tuteur=htmlspecialchars($_POST['nomtuteur']);

        $ins = $bdd->prepare('INSERT INTO etudiants (nom, prenom, date_naissance, email, telephone, idtuteur, date_inscription)
        VALUES (?, ?, ?, ?, ?, ?, NOW())');
        $ins->execute(array($nom, $prenom, $naissance, $email, $telephone, $tuteur));
        header('location:index.php');
            if($ins){
                $destinataire=$email;
                $sujet="Confirmation d'inscription";
                $message="Hello ".$nom. " ".$prenom. ", votre inscription en faculteé de science de la santé à été effectuer avec succès veuillez passez à l'administration dans une semaine pour le rétrait de votre attestation!";
                $headers="From:mradouabou97@gmail.com";
                mail($destinataire,$sujet,$message,$headers);
            header('location:index.php');
            $error = "L'inscription a été réalisé avec succès!";
            }else{
                $error= "Erreur d'ajout";
            } 
      }
      else{
        $error = "Veuillez remplir tous les champs!";
      }
  }



  if(isset($_POST['EnregistrerTuteur']))
  {
      if(!empty($_POST['nomt']) AND !empty($_POST['prenomt']) AND !empty($_POST['emailt']) AND!empty($_POST['telephonet']))
      {
        $nomt = htmlspecialchars($_POST['nomt']);
        $prenomt = htmlspecialchars($_POST['prenomt']);
        $emailt = htmlspecialchars($_POST['emailt']);
        $telephonet = htmlspecialchars($_POST['telephonet']); 


        $inserttuteur = $bdd->prepare("INSERT INTO tuteurs(nom,prenom,email,telephone) VALUES(?,?,?,?)");
        $inserttuteur->execute(array($nomt, $prenomt, $emailt, $telephonet,));
        if($inserttuteur){
          header("Location:index.php");
          }
    }
    else{
        $error = "Veuillez remplir tous les champs!";
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
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        
        <title>Compte Administrateur</title>
        <link href="https://cdn.jsdelivr.net/npm/simple-datatables@latest/dist/style.css" rel="stylesheet" />
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
    </head>
    <body class="sb-nav-fixed">
        
        <nav class="sb-topnav navbar navbar-expand navbar-dark entetepageindex">
            <div class="sb-sidenav-footer">
                

            </div>

            <a class="navbar-brand ps-3" href="index.html"></a>

            <button class="btn btn-link btn-sm order-1 order-lg-0 me-4 me-lg-0" id="sidebarToggle" href="#!"><i class="fas fa-bars"></i></button>

            <form class="d-none d-md-inline-block form-inline ms-auto me-0 me-md-3 my-2 my-md-0">
            </form>

            <ul class="navbar-nav ms-auto ms-md-0 me-3 me-lg-4">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="deconnexion.php">Se deconnecter</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion entetepageindex" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        
                        <div class="nav">
                            <!-- <div class="sb-sidenav-menu-heading">Core</div> -->
                            <a class="nav-link" href="index.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Tableau
                            <!-- </a>
                            <div class="sb-sidenav-menu-heading">Interface</div>
                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Layouts
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a> -->

                            <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                                <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                                Fonctionnalités
                                <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                            </a>
                            <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                                    <div>
                                    <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button">Inscrire un étudiant</a>
                                    </div>
                                    
                                </nav>
                            </div>
                            <div class="sb-sidenav-menu-heading"></div>

                        </div>
                    </div>

                </nav>
            </div>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4" style="color:blue !important; color: #ECCFCF;-webkit-text-stroke: 3px #01AA52;">Espace Administrateur</h1>
                        
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Liste Des Etudiants Inscrits 
                            </div>

                            <div class="card-body">
                                <table id="datatablesSimple">
                                    <thead style="text-align:center !important;">
                                        <tr>
                                            <th style="text-align:center !important;">Matricule</th>
                                            <th style="text-align:center !important;">Nom</th>
                                            <th style="text-align:center !important;">Prénom</th>
                                            <th style="text-align:center !important;">Date de Naissance</th>
                                            <th style="text-align:center !important;">Email</th>
                                            <th style="text-align:center !important;">Telephone</th>
                                            <th style="text-align:center !important;">Tuteur</th>
                                            <th style="text-align:center !important;">Date d'inscription</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <?php 
                                        $bdd =new  mysqli('localhost', 'root', '', 'ufr-sds');
                                        $req3 = mysqli_query($bdd , "SELECT * FROM etudiants");
                                        if(mysqli_num_rows($req3) == 0){

                                            echo "<p  style= color:red;>Aucun abonné n'as été ajouté!</p>";
                                        }else {
                                            while($row = mysqli_fetch_assoc($req3)){
                                                echo " 
                                                <tbody style='text-align:center;'>
                                                <tr> 
                                                    <td>$row[matricule]</td>
                                                    <td>$row[nom]</td>
                                                    <td>$row[prenom]</td>
                                                    <td>$row[date_naissance]</td>
                                                    <td>$row[email]</td>
                                                    <td>$row[telephone]</td>
                                                    <td>$row[idtuteur]</td>
                                                    <td>$row[date_inscription]</td>
                                                    <td >
                                                    <a href='voirtuteur.php?afficheid=".$row['idtuteur']." ' ><ion-icon  style='cursor: pointer; font-size: 21px; color:green' name='eye'></a>
                                                    <a href='modifieretudiant.php?updateid=".$row['matricule']." '  ><ion-icon style='cursor: pointer; font-size: 21px; color:blue' name='create-outline'></ion-icon></a>
                                                    <a href='supprimeretudiant.php?supid=".$row['matricule']." '  ><ion-icon style='cursor: pointer; font-size: 21px; color:red' name='trash-outline'></ion-icon></a> 
                                                    </td>
                                                </tr>
                                                </tbody>
                                                ";
                                            }
                                        }

                                    ?>

                                </table>
                                <div class="modal fade" id="exampleModalToggle" aria-hidden="true" aria-labelledby="exampleModalToggleLabel" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalToggleLabel">INSCRIPTION</h3>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="" method="post">
            <h5>Information de l'étudiant</h5>
                <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="completeprenom" name="nometud">
                                    
                </div>
                <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="completeprenom" name="prenometud">
                                
                </div>
                <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Date de Naissance</label>
                    <input type="date" class="form-control" id="completedatedebut" aria-describedby="emailHelp" name="datenaissanceetud">
                                
                </div>
                <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="text" class="form-control" id="completeprenom" name="emailetud">
                                
                </div>
                <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Telephone</label>
                    <input type="text" class="form-control" id="completeprenom" name="telephoneetud">
                                
                </div>
                <h5>Information du tuteur</h5>
                <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Nom Et Prenom</label>
                    <select name ="nomtuteur" type="text" class="form-control">
                        <?php 
                            while($lign=mysqli_fetch_assoc($solution)){

                            echo "<option value ='$lign[id_tuteur]'>$lign[nom] $lign[prenom]</option>";
                            }
                        ?>
                    </select>
                                
                </div>
                <button type="submit" class="btn btn-primary" name="Enregistrer" onclick="AddUser()">Valider l'inscription</button>
          </form>
      </div>
      <div class="modal-footer">
        <button class="btn btn-primary" data-bs-target="#exampleModalToggle2" data-bs-toggle="modal">Enregistrer un tuteur</button>
      </div>
    </div>
  </div>
</div>







<div class="modal fade" id="exampleModalToggle2" aria-hidden="true" aria-labelledby="exampleModalToggleLabel2" tabindex="-1">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalToggleLabel2">Enregistrement tuteur</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
          <form action="" method="post">
            <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Nom</label>
                    <input type="text" class="form-control" id="completeprenom" name="nomt">
                                    
                </div>
                <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Prenom</label>
                    <input type="text" class="form-control" id="completeprenom" name="prenomt">
                                
                </div>
                <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Email</label>
                    <input type="text" class="form-control" id="completeprenom" name="emailt">
                                
                </div>
                <div class="mb-1">
                    <label for="exampleInputEmail1" class="form-label">Telephone</label>
                    <input type="text" class="form-control" id="completeprenom" name="telephonet">
                                
                </div>
                <button type="submit" class="btn btn-primary" name="EnregistrerTuteur" onclick="AddUser()">Valider l'inscription</button>
                <!-- <a class="btn btn-primary" data-bs-toggle="modal" href="#exampleModalToggle" role="button"><button type="submit" class="btn btn-primary" name="EnregistrerTuteur" onclick="AddUser()">Valider l'inscription</button></a> -->
          </form>
      </div>
    </div>
  </div>
</div>


                </main>
                <footer class="py-4 footerpageindex mt-auto">
                    <div class="container-fluid px-4">
                        <div class="d-flex align-items-center justify-content-center small">
                            <div class="text-muted">© Université Joseph-Ki Zerbo  2022 Tous Droits Réservés</div>
                            <!-- <div>
                                <a href="#">Privacy Policy</a>
                                &middot;
                                <a href="#">Terms &amp; Conditions</a>
                            </div> -->
                        </div>
                    </div>
                </footer>
            </div>
        </div>
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        <script src="js/scripts.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script>
        <script src="assets/demo/chart-area-demo.js"></script>
        <script src="assets/demo/chart-bar-demo.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/simple-datatables@latest" crossorigin="anonymous"></script>
        <script src="js/datatables-simple-demo.js"></script>
    </body>
</html>
