<?php
$db = mysqli_connect('localhost', 'adri', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'mimusica') or die(mysqli_error($db));
if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            music_nombre, musica_anio, musica_tipo, musica_cantante, music_productor
        FROM
            music
        WHERE
            music_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $music_nombre = '';
    $musica_tipo = 0;
    $musica_anio = date('Y');
    $musica_cantante = 0;
    $music_productor = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> Musica</title>
 </head>
 <body>
    <?php
    if (isset($_GET['error']) && $_GET['error'] != '') {
    echo '<div id="error">' . $_GET['error'] . '</div>';
    }
    ?>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=movie"
   method="post">
   <table>
    <tr>
     <td>Nombre musica</td>
     <td><input type="text" name="music_nombre"
      value="<?php echo $music_nombre; ?>"/></td>
    </tr><tr>
     <td>Tipo de musica</td>
     <td><select name="musica_tipo">
<?php
// select the movie type information
$query = 'SELECT
        musictipo_id, musictipo_label
    FROM
        tiposmusica
    ORDER BY
        musictipo_label';
$result = mysqli_query($db, $query) or die(mysqli_error($db));
// populate the select options with the results
while ($row = mysqli_fetch_assoc($result)) {
    foreach ($row as $value) {
        if ($row['musictipo_id'] == $movie_type) {
            echo '<option value="' . $row['musictipo_id'] .
                '" selected="selected">';
        } else {
            echo '<option value="' . $row['musictipo_id'] . '">';
        }
        echo $row['musictipo_label'] . '</option>';
    }
}
?>
      </select></td>
    </tr><tr>
     <td>Musica año</td>
     <td><select name="musica_anio">
<?php
// populate the select options with years
for ($yr = date("Y"); $yr >= 1970; $yr--) {
    if ($yr == $musica_anio) {
        echo '<option value="' . $yr . '" selected="selected">' . $yr .
            '</option>';
    } else {
        echo '<option value="' . $yr . '">' . $yr . '</option>';
    }
}
?>
      </select></td>
    </tr>
    <tr>
     <td>Cantante</td>
     <td><input type="text" name="musica_cantante"
      value="<?php echo $musica_cantante; ?>"/></td>
    </tr>
    <tr>
     <td>Director</td>
     <td><input type="text" name="music_productor"
      value="<?php echo $music_productor; ?>"/></td>
    </tr>

    <tr>
     <td colspan="2" style="text-align: center;">
<?php
if ($_GET['action'] == 'edit') {
    echo '<input type="hidden" value="' . $_GET['id'] . '" name="music_id" />';
}
?>
      <input type="submit" name="submit"
       value="<?php echo ucfirst($_GET['action']); ?>" />
     </td>
    </tr>
   </table>
  </form>
 </body>
</html>
