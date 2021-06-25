<?php
require __DIR__ . '/vendor/autoload.php';

use i74ifaDb\DB;

$db = new DB('mysql', 'localhost', 'rodir', 'root', '');


echo '<pre>';
$users = $db->table('users')
    ->Select(['users.name', 'users.username', 'users.email', 'countries.country', 'countries.zip'])
    ->join('countries', 'countries.user_id = users.id')
    ->where(['name' => 'Good'])
    ->execute()->get(PDO::FETCH_OBJ);

?>


<table border="1">
    <thead>
    <tr>
        <th>name</th>
        <th>username</th>
        <th>email</th>
        <th>country</th>
        <th>zip</th>
    </tr>
    </thead>
    <tbody>
    <?php foreach ($users as $user): ?>
    <tr>
        <td><?= $user->name ?></td>
        <td><?= $user->username ?></td>
        <td><?= $user->email ?></td>
        <td><?= $user->country ?></td>
        <td><?= $user->zip ?></td>
    </tr>
    <?php endforeach ?>
    </tbody>
</table>
