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
  <div id="top">
    
  <form action="startseite.php" method="post">
    <p class="text">Tragen Sie hier die ID der infizierten Person ein.</p>
    <input name="coronaid" placeholder="ID" type="text">
    <button class="link-ad" type="submit" name="hinzufügen">Hinzufügen</button>
  </form>

  </div>

  <div id="middle">
  <?php
if (isset($_POST["coronaid"])) {
    /*echo "<h2>ID lautet: " .$_POST["coronaid"] . "</h2>";*/
    echo " <h2> Die Personen ID wurde erfolgreich in die Datenbank eingetragen.</h2>";
  }

?>
  </div>

</body>

</html>