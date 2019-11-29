<?php
$db = mysqli_connect('localhost', 'adri', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'mimusica') or die(mysqli_error($db));
?>
<html>
 <head>
  <title>Commit</title>
 </head>
 <body>
<?php
$email = $_POST['email'];
switch ($_GET['action']) {
case 'add':
    switch ($_GET['type']) {
    case 'movie':
        $query = 'INSERT INTO
            music
                (music_nombre, musica_anio, musica_tipo, musica_cantante,
                music_productor)
            VALUES
                ("' . $_POST['music_nombre'] . '",
                 ' . $_POST['musica_anio'] . ',
                 ' . $_POST['musica_tipo'] . ',
                 ' . $_POST['musica_cantante'] . ',
                 ' . $_POST['music_productor'] . ')';
        break;
    case 'people':
        $error = array();
        $persona_nomComple = isset($_POST['persona_nomComple']) ?
            trim($_POST['persona_nomComple']) : '';
        if (empty($persona_nomComple)) {
            $error[] = urlencode('Please enter a person name.');
        }
        $persona_productor = isset($_POST['persona_productor']) ? 
            trim($_POST['persona_productor']) : '';
        if (!is_numeric($persona_productor)) {
            $error[] = urlencode('Please enter a numeric.');
        }
        $persona_pais = isset($_POST['persona_pais']) ? 
            trim($_POST['persona_pais']) : '';
        if (!is_numeric($persona_pais)) {
            $error[] = urlencode('Please enter a numeric.');
        }
        if (empty($_POST["email"])) {
        $error[] = "El email es requerido <br>";
        } else {
        $email = $_POST['email'];
        // Queremos que el email tenga un formato adecuado
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            $error[] = "Formato de email incorrecto";
        }
        }
        if (empty($error)) {
        $query = 'INSERT INTO
            persona
                (persona_nomComple, persona_productor, persona_pais)
            VALUES
                ("' . $_POST['persona_nomComple'] . '",
                 ' . $_POST['persona_productor'] . ',
                 ' . $_POST['persona_pais'] . ')';
         } else {
          header('Location:people.php?action=add' .
              '&error=' . join($error, urlencode('<br/>')));
        }
        break;
    }
    break;
case 'edit':
    switch ($_GET['type']) {
    case 'movie':
        $query = 'UPDATE music SET
                music_nombre = "' . $_POST['music_nombre'] . '",
                musica_anio = ' . $_POST['musica_anio'] . ',
                musica_tipo = ' . $_POST['musica_tipo'] . ',
                musica_cantante = ' . $_POST['musica_cantante'] . ',
                music_productor = ' . $_POST['music_productor'] . '
            WHERE
                music_id = ' . $_POST['music_id'];
        break;
    case 'people':
        $error = array();
        $persona_nomComple = isset($_POST['persona_nomComple']) ?
            trim($_POST['persona_nomComple']) : '';
        if (empty($persona_nomComple)) {
            $error[] = urlencode('Please enter a person name.');
        }
        $persona_productor = isset($_POST['persona_productor']) ? 
            trim($_POST['persona_productor']) : '';
        if (!is_numeric($persona_productor)) {
            $error[] = urlencode('Please enter a numeric.');
        }
        $persona_pais = isset($_POST['persona_pais']) ? 
            trim($_POST['persona_pais']) : '';
        if (!is_numeric($persona_pais)) {
            $error[] = urlencode('Please enter a numeric.');
        }
        if (empty($_POST["email"])) {
        $error[] = "El email es requerido <br>";
        } else {
        $email = $_POST['email'];
        // Queremos que el email tenga un formato adecuado
        if (!preg_match("/([\w\-]+\@[\w\-]+\.[\w\-]+)/", $email)) {
            $error[] = "Formato de email incorrecto";
        }
        }
        if (empty($error)) {
    $query = 'UPDATE persona SET
            persona_nomComple = "' . $_POST['persona_nomComple'] . '",
            persona_productor = ' . $_POST['persona_productor'] . ',
            persona_pais = ' . $_POST['persona_pais'] . '
        WHERE
            persona_id = ' . $_POST['persona_id'];
        } else {
          header('Location:people.php?action=edit&id=' . $_POST['persona_id'] .
              '&error=' . join($error, urlencode('<br/>')));
        }
        break;
    }
    break;
}
if (isset($query)) {
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
}
?>
  <p>Done!</p>
 </body>
</html>
