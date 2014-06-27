<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/25/14
 * Time: 11:16 AM
 * NOTE: Faker requires PHP >= 5.3.3
 */

require_once __DIR__ . '/../../../app/models/Database.php';
require_once __DIR__ . '/../../../vendor/fzaninotto/faker/src/autoload.php';

$faker = Faker\Factory::create();

$db = Database::getConnection();

$sql = "INSERT INTO students
        (cwid, fname, lname, address, telephone)
        VALUES
        (:cwid, :fname, :lname, :address, :telephone)";

$query = $db->prepare($sql);

for ($i = 0; $i < 300; ++$i) {
    $gender = $faker->randomElement(array('male', 'female'));

    $data = array(
        'cwid' => $faker->numberBetween(100000000, 999999999),
        'fname' => $faker->firstName($gender),
        'lname' => $faker->lastName,
        'address' => $faker->address,
        'telephone' => $faker->phoneNumber,
    );

    $query->execute($data);

}

