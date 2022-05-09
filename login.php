<?php
$erreur = "";
if (isset($_POST["submit"])) {
  $erreur = "ahla";
  $name = $_POST["email"];
  $password = $_POST["password"];
  @$valider = $_POST["valider"];

  include("./include/config.php");
  $sel = $pdo->prepare("select * from enseignant where login=? and pass=? limit 1");
  $sel->execute(array($name, md5($password)));
  $tab = $sel->fetchAll();
  if (count($tab) > 0) {
    session_start();
    $_SESSION["prenomNom"] = ucfirst(strtolower($tab[0]["prenom"])) .
      " " . strtoupper($tab[0]["nom"]);
    $_SESSION["autoriser"] = "oui";
    header("location:../index.php");
  } else {
    $erreur = "Mauvais login ou mot de passe!";
  }
}
?>
<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
  <meta name="generator" content="Hugo 0.88.1">
  <title>SCO-ENICAR Se Connecter</title>

  <!-- Bootstrap core CSS -->
  <link href="./assets/dist/css/bootstrap.min.css" rel="stylesheet">



  <style>
    .bd-placeholder-img {
      font-size: 1.125rem;
      text-anchor: middle;
      -webkit-user-select: none;
      -moz-user-select: none;
      -ms-user-select: none;
      user-select: none;
    }

    h6 {
      color: red;
    }

    @media (min-width: 768px) {
      .bd-placeholder-img-lg {
        font-size: 3.5rem;
      }
    }
  </style>


  <!-- Custom styles for this template -->
  <link href="./assets/dist/css/signin.css" rel="stylesheet">
</head>

<body class="text-center">


  <form id="myForm" class="form-signin" method="post" action="login.php">
    <img class="mb-4" src="./assets/brand/user-login.svg" alt="" width="72" height="72">
    <h1 class="h3 mb-3 font-weight-normal">Veuillez vous connecter</h1>
    <h6 id="erreur"><?php echo $erreur ?></h6>
    <label for="inputEmail" class="sr-only">Email </label>
    <input type="email" name="email" id="inputEmail" class="form-control" placeholder="Email address" required autofocus>
    <label for="inputPassword" class="sr-only">Mot de Passe</label>
    <input type="password" name="password" id="inputPassword" class="form-control" placeholder="Password" required>

    <button class="btn btn-lg btn-primary btn-block" type="submit" name="submit">Se Connecter</button>
    <br><a href="inscription.php"> Créer un Compte</a>
    <p class="mt-5 mb-3 text-muted">&copy; SOC-Enicar 2021-2022</p>
  </form>
  </script>
</body>

</html>
