<?php

if (empty($_ENV['DB_HOST'])) $_ENV['DB_HOST'] = 'localhost';
if (empty($_ENV['DB_NAME'])) $_ENV['DB_NAME'] = 'test_db';
if (empty($_ENV['DB_USER'])) $_ENV['DB_USER'] = 'postgres';
if (empty($_ENV['DB_PASS'])) $_ENV['DB_PASS'] = 'postgres';

return [
    'class' => 'yii\db\Connection',
    'dsn' => 'pgsql:host='.$_ENV['DB_HOST'].';port=5432;dbname='.$_ENV['DB_NAME'],
    'username' => $_ENV['DB_USER'],
    'password' => $_ENV['DB_PASS'],
    'charset' => 'utf8',
    'tablePrefix' => 'alisjanskij_',
];
