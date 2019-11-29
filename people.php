<?php
$db = mysqli_connect('localhost', 'adri', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'mimusica') or die(mysqli_error($db));
if ($_GET['action'] == 'edit') {
    //retrieve the record's information 
    $query = 'SELECT
            persona_nomComple, persona_pais, persona_productor
        FROM
            persona
        WHERE
            persona_id = ' . $_GET['id'];
    $result = mysqli_query($db, $query) or die(mysqli_error($db));
    extract(mysqli_fetch_assoc($result));
} else {
    //set values to blank
    $persona_nomComple = '';
    $persona_pais = 0;
    $persona_productor = 0;
}
?>
<html>
 <head>
  <title><?php echo ucfirst($_GET['action']); ?> Musica</title>
 </head>
 <body>
  <?php
  if (isset($_GET['error']) && $_GET['error'] != '') {
  echo '<div id="error" style="background-color:black;color:white;text-align:center;padding:5px;">' . $_GET['error'] . '</div>';
  }
  ?>
  <form action="commit.php?action=<?php echo $_GET['action']; ?>&type=people"
   method="post">
   <table>
    <tr>
     <td>Nombre del cantante</td>
     <td><input type="text" name="persona_nomComple"
      value="<?php echo $persona_nomComple; ?>"/></td>
    </tr><tr>
     <td>Pais de residencia</td>
     <td><input type="text" name="persona_pais"
      value="<?php echo $persona_pais; ?>"/></td>
    </tr>
    <tr>
     <td>Introduce un email</td>
     <td><input type="text" name="email"/></td>
    </tr>
    <tr>
     <td>Productores</td>
     <td><input type="text" name="persona_productor"
      value="<?php echo $persona_productor; ?>"/></td>
    </tr>

<?php
if ($_GET['action'] == 'edit') {

    echo '<input type="hidden" value="' . $_GET['id'] . '" name="persona_id" />';
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
