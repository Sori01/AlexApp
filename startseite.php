<!DOCTYPE html>
<html lang="de">

<head>
  <title>Alex</title>
  <meta charset="UTF-8">
  <link href="style.css" rel="stylesheet">
</head>

<body>
  <div class="nav">
  <h1>Alex | Gesundheitsamt</h1> 
  </div>

  <div id="reiter">
    <a href="startseite.php" class="left">Corona Positiv</a>
    <a href="negativ.php" class="left">Corona Negativ</a>
  </div>

  <div id="top">
    
    <form action="startseite.php" method="post">
      <p class="text">Tragen Sie hier die ID der infizierten Person ein.</p>
      <input name="coronaid" placeholder="ID" type="text">
      <button class="link-ad" type="submit" name="hinzufügen">Hinzufügen</button>
    </form>

  </div>

  <div id="middle">
  <?php
  session_start();

    if (
      isset($_POST["password"]) && isset($_POST["username"]) &&
      !empty($_POST["password"]) && !empty($_POST["username"])
      ) {
      $_SESSION["password"] = $_POST["password"];
      $_SESSION["username"] = $_POST["username"];
    }
    else if (
      !isset($_SESSION["password"]) || !isset($_SESSION["username"]) ||
      empty($_SESSION["password"]) || empty($_SESSION["username"])
      ) {
      header("Location:index.php");
      die();
    }

 
$ch = curl_init(); 
$pw = $_SESSION["password"]; //"Test123";
$name = $_SESSION["username"]; //"Mosbach";

$url = "http://18.198.41.152:8080/checkLogin.php?name={$name}&password={$pw}";

curl_setopt($ch, CURLOPT_URL, $url); 

//return the transfer as a string 
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

// $output contains the output string 
$output = curl_exec($ch); 

$output = json_decode($output);
if ($output->message == "login") {
  //echo "login successful";
}
else {
  header("Location:index.php");
  die();
}

// close curl resource to free up system resources 
curl_close($ch);


if (isset($_POST["coronaid"])) {
    /*echo "<h2>ID lautet: " .$_POST["coronaid"] . "</h2>";*/
    
  
    // create curl resource 
    $ch = curl_init(); 

    $personId = $_POST["coronaid"];
    $ts = "2021-03-12";
    $pw = $_SESSION["password"]; //"Test123";
    $name = $_SESSION["username"]; //"Mosbach";

    $url = "http://18.198.41.152:8080/setIDtoPositive.php?personid={$personId}&timestamp={$ts}&name={$name}&password={$pw}";
    //var_dump($url);

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url); 

    //return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 
    //var_dump($output);

    echo " <h2> Die Personen ID wurde erfolgreich in die Datenbank eingetragen.</h2>";

    // close curl resource to free up system resources 
    curl_close($ch);
    }

  ?>
  </div>

</body>

</html>