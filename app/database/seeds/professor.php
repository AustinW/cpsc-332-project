<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/25/14
 * Time: 11:16 AM
 * NOTE: Faker requires PHP >= 5.3.3
 */

require_once __DIR__ . '/../../../app/models/BaseModel.php';
require_once __DIR__ . '/../../../vendor/fzaninotto/faker/src/autoload.php';

$faker = Faker\Factory::create();

$db = BaseModel::getConnection();

$sql = "INSERT INTO professors
        (ssn, fname, lname, sex, title, salary, college_degrees, address_street, address_city, address_state, address_zip, phone_area, phone_number)
        VALUES
        (:ssn, :fname, :lname, :sex, :title, :salary, :college_degrees, :address_street, :address_city, :address_state, :address_zip, :phone_area, :phone_number)";

$query = $db->prepare($sql);

for ($i = 0; $i < 100; ++$i) {
    $gender = $faker->randomElement(array('male', 'female'));

    $data = array(
        'ssn' => $faker->numberBetween(100000000, 999999999),
        'fname' => $faker->firstName($gender),
        'lname' => $faker->lastName,
        'sex' => $faker->randomElement(array('male', 'female')),
        'title' => $faker->title($gender),
        'salary' => $faker->randomNumber(5),
        'college_degrees' => $faker->randomElement(array('BS Computer Science', 'BS Mathematics')),
        'address_street' => $faker->streetAddress,
        'address_city' => $faker->city,
        'address_state' => $faker->stateAbbr,
        'address_zip' => $faker->numberBetween(10000, 99999),
        'phone_area' => $faker->numberBetween(100, 999),
        'phone_number' => $faker->numberBetween(1000000, 9999999)
    );

    $query->execute($data);

}

