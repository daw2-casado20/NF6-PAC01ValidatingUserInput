<?php
$db = mysqli_connect('localhost', 'adri', 'root') or 
    die ('Unable to connect. Check your connection parameters.');
mysqli_select_db($db, 'mimusica') or die(mysqli_error($db));

if (!isset($_GET['do']) || $_GET['do'] != 1) {
    switch ($_GET['type']) {
    case 'movie':
        echo 'Are you sure you want to delete this musica?<br/>';
        break;
    case 'people':
        echo 'Are you sure you want to delete this person?<br/>';
        break;
    } 
    echo '<a href="' . $_SERVER['REQUEST_URI'] . '&do=1">yes</a> '; 
    echo 'or <a href="admin.php">no</a>';
} else {
    switch ($_GET['type']) {
    case 'movie':

        $query = 'DELETE FROM music  WHERE music_id= ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
?>
<p style="text-align: center;">Your person has been deleted.
<a href="admin.php">Return to Index</a></p>
<?php
        break;
    case 'people':
         $query = 'DELETE FROM persona  WHERE persona_id = ' . $_GET['id'];
        $result = mysqli_query($db, $query) or die(mysqli_error($db));
?>
<p style="text-align: center;">Your song has been deleted.
<a href="admin.php">Return to Index</a></p>
<?php
        break;
    }
}
?>

