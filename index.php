<?php
/* Standard Einstellungen */
require_once("settings.php");

$error_registration_text = "";
/* Gucke ob Submit gesetzt wurde */
if (isset($_POST['submit']) && !isset($_SESSION['id'])) {
  /* Prüfe ob die relevanten Felder leer sind */
  if ($_POST['username'] == "") {
    $error_registration_text = "Das Usernamefeld ist leer\n";
  }
  if ($_POST['password'] == "") {
    $error_registration_text .= "Du hast dein Passwort nicht eingegeben\n";
  }
  if ($error_registration_text == "" || $error_registration_text == null) {
    /* Prüfe ob Username existiert */
    $checkusername = $mysql->query("SELECT password, salt, userid, permission FROM users WHERE username='" . $_POST['username'] . "'");
    if ($checkusername->num_rows === 0) {
      $error_registration_text .= "Der Username existiert nicht\n";
    }
    if ($error_registration_text == "" || $error_registration_text == null) {
      /* Prüfe ob das Passwort richtig ist */
      $result = $checkusername->fetch_object();
      $hash = hashPassword($_POST['password'], $result->salt);
      if ($hash != $result->password) {
        $error_registration_text .= "Das Passwort ist falsch\n";
      }
      if ($error_registration_text == "" || $error_registration_text == null) {
        /* Setze die Relevanten Sessions und leite weiter */
        setSessions($result->userid, $_POST['username'], $result->permission);
        header("Location: " . $link . "");
      }
    }
  }
  if ($error_registration_text != "") {
    $error_registration_text = ConvertToLines($error_registration_text);
  }
}
?>
<!DOCTYPE html>
<html lang="de">

<head>
  <title>Alex</title>
  <meta charset="UTF-8">
  <link href="style.css" rel="stylesheet">
</head>

<body>
  <div id="main">
    <div class="index">
      <?php
      /* Prüfe ob Nutzer bereits angemeldet ist */
      if (isset($_SESSION['id'])) {
      ?>
        <p>Du bist bereits angemeldet!</p>
      <?php
      } else {
      ?>
        <h1>Alex | Gesundheitsamt</h1>
        <br>
        <form action="startseite.php" method="POST">
          <?php
          if ($error_registration_text != null) {
          ?>
            <div class="error">
              <details>
                <summary><strong>Fehler</strong></summary>
                <ul>
                  <?php
                  echo $error_registration_text;
                  ?>
                </ul>
              </details>
            </div>
          <?php
          }
          /* Gebe Erfolgsmeldung von Registrierung aus */
          if (isset($_SESSION['successful'])) {
          ?>
            <div class="successful">
              <p><?php echo $_SESSION['successful']; ?></p>
            </div>
          <?php
            unset($_SESSION['successful']);
          }
          ?>
          <input name="username" placeholder="Dein Username" type="text" value="<?php echo $_POST['username'] ?? null ?>">
          <br>
          <input name="password" placeholder="Dein Passwort" type="password" value="<?php echo $_POST['password'] ?? null ?>">
          <br>
         
          <button class="link-blue" type="submit" name="submit">Anmelden</button>
         
        </form>
      <?php
      } ?>
    </div>
  </div>
</body>

</html>