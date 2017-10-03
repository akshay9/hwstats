<?php 

$db = new PDO('mysql:dbname='. getenv('OPENSHIFT_APP_NAME') .';host='.getenv('OPENSHIFT_MYSQL_DB_HOST'), getenv('OPENSHIFT_MYSQL_DB_USERNAME'), getenv('OPENSHIFT_MYSQL_DB_PASSWORD'));

?>