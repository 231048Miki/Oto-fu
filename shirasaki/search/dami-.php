<h1>だみーページですよーーー</h1>
<?php 
require('../../db_open.php');
require('searchCtl.php');
  foreach( $_POST['tags'] as $value ){
    echo "{$value}, ";
}
tagSearch($_POST['tags'] ,$dbh);