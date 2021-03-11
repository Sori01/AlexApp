<?php
/*
Settings für Variablen, SESSION und MySQL
*/
session_start();

/* verbinde zur Datenbank */
/*$mysql = mysqli_connect("localhost", "foodie", "MOr1cJOK8kbJLcX8", "foodie");*/

/* Bekomme relativen Linkpfad für die Weiterlietungen */
$page_file_temp = $_SERVER["PHP_SELF"];
$page_directory = dirname($page_file_temp);
$link = "http://".$_SERVER['HTTP_HOST'].$page_directory."/";

/* Funktion um jede Zeile zu <li> Zeilen zu machen */
function ConvertToLines($string)
{
    // Um jede Zeile durchzugehen
    $newstring = "";
    foreach (preg_split("/((\r?\n)|(\r\n?))/", $string) as $line) {
        if ($line != "") {
            $newstring .= "<li>" . $line . "</li>";
        }
    }
    return $newstring;
}

/*Hashe das Passwort */
function hashPassword($password, $salt)
{
    return hash('sha256', $password . $salt);
}

/* Setzt die erforderlichen Sessions */
function setSessions($id, $username, $permission)
{
    $_SESSION['id'] = $id;
    $_SESSION['username'] = $username;
    $_SESSION['rights'] = $permission;
}
