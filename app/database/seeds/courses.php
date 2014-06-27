<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/25/14
 * Time: 11:16 AM
 * NOTE: Faker requires PHP >= 5.3.3
 */

require_once __DIR__ . '/../../../app/models/Database.php';
require_once __DIR__ . '/../../../app/database/seeds/providers/book.php';
require_once __DIR__ . '/../../../vendor/fzaninotto/faker/src/autoload.php';

$faker = Faker\Factory::create();
$faker->addProvider(new \Faker\Provider\Book($faker));

$db = Database::getConnection();

$sql = "INSERT INTO courses
        (number, title, textbook, units)
        VALUES
        (:number, :title, :textbook, :units)";

$query = $db->prepare($sql);

$courseNames = array(
    'CPSC 120 (Introduction to Programming)',
    'CPSC 121 (Programming Concepts)',
    'CPSC 131 (Data Structures Concepts)',
    'CPSC 223 (Object-Oriented Programming Language)',
    'CPSC 240 (Computer Organization and Assembly Langage)',
    'CPSC 253U or 254 (UNIX or Open Source Systems)',
    'CPSC 311 (Technical Writing for Computer Science)',
    'CPSC 315 (Social and Ethical Issues in Computing)',
    'CPSC 323 (Programming Languages and Translation)',
    'CPSC 332 (File Structures and Database Systems)',
    'CPSC 335 (Problem Solving Strategies)',
    'CPSC 351 (Operating Systems Concepts)',
    'CPSC 362 (Foundations of Software Engineering)',
    'CPSC 440 (Computer System Architecture)',
    'CPSC 471 (Computer Communications)',
    'CPSC 481 (Artificial Intelligence)',
    'CPSC 440 (Computer System Architecture)',
    'CPSC 462 (Software Design)',
    'CPSC 589 (Seminar in Computer Science)',
    'CPSC 597 (Project or CPSC 598 Thesis)',
    'CPSC 541 (Systems and Software Standards and Requirements)',
    'CPSC 542 (Software Verification and Validation)',
    'CPSC 543 (Software Maintenance)',
    'CPSC 544 (Software Process Definition)',
    'CPSC 545 (Software Design and Architecture)',
    'CPSC 546 (Software Project Management)',
    'CPSC 547 (Software Measurement)',
    'CPSC 548 (Professional, Ethical, and Legal Issues for Software Engineers)',
);

foreach ($courseNames as $courseName) {

    $query->execute(array(
        'number' => $faker->numberBetween(10000, 99999),
        'title' => $courseName,
        'textbook' => $faker->title,
        'units' => $faker->numberBetween(1,4)
    ));

}

