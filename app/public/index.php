<?php

$pdo = new PDO(
    'mysql:dbname=simplenote;host=mysql;charset=UTF8',
    'simplenote',
    'jaimelagalette',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
);

$query = $pdo->query('SHOW VARIABLES like "version"');

$row = $query->fetch();

echo 'MySQL version : ' . $row['Value'];