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
    
    <form action="negativ.php" method="post">
      <p class="text">Tragen Sie hier die ID der nicht infizierten Person ein.</p>
      <input name="nocoronaid" placeholder="ID" type="text">
      <button class="link-ad" type="submit" name="hinzufügen">Hinzufügen</button>
    </form>

  </div>

  <div id="middle">
  <?php
    if (isset($_POST["nocoronaid"])) {
  
    // create curl resource 
    $ch = curl_init(); 

    $personId = $_POST["coronaid"];
    $ts = "2021-03-12";
    $pw = $_SESSION["password"];                        //"Test123";
    $name = $_SESSION["username"];  

    $url = "http://18.198.41.152:8080/setIDtoNegative.php?personid={$personId}&timestamp={$ts}&name={$name}&password={$pw}";

    //var_dump($url);

    // set url 
    curl_setopt($ch, CURLOPT_URL, $url); 

    //return the transfer as a string 
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

    // $output contains the output string 
    $output = curl_exec($ch); 
    //var_dump($output);

    /*echo "<h2>ID lautet: " .$_POST["nocoronaid"] . "</h2>";*/
    echo " <h2> Die Personen ID wurde erfolgreich in die Datenbank eingetragen.</h2>";

    // close curl resource to free up system resources 
    curl_close($ch);
    }

  ?>
  </div>

</body>

</html>