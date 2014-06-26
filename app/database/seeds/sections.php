<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/25/14
 * Time: 10:19 PM
 */

require_once __DIR__ . '/../../../app/models/BaseModel.php';
require_once __DIR__ . '/../../../vendor/fzaninotto/faker/src/autoload.php';

$faker = Faker\Factory::create();

$db = BaseModel::getConnection();

$query = "SELECT * FROM professors";
$stmt = $db->prepare($query);
$stmt->execute();
$professors = array();
while ($row = $stmt->fetchObject()) {
    $professors[] = $row;
}

$query = "SELECT * FROM courses";
$stmt = $db->prepare($query);
$stmt->execute();
$courses = array();
while ($row = $stmt->fetchObject()) {
    $courses[] = $row;
}

$query = "INSERT INTO sections
          (number, professor_ssn, course_number, classroom, meeting_days, beginning_time, end_time, seats)
          VALUES
          (:number, :professor_ssn, :course_number, :classroom, :meeting_days, :beginning_time, :end_time, :seats)";

$stmt = $db->prepare($query);

$sectionNumbersUsed = array();

foreach ($professors as $professor) {

    // Professor will teach from 1 to 3 sections
    for ($i = 0; $i < $faker->numberBetween(1, 3); ++$i) {
        $course = $courses[$faker->numberBetween(0, count($courses) - 1)]; // do-while to prevent duplicate courses?

        do { $sectionNumber = $faker->numberBetween(1000, 9999); } while(in_array($sectionNumber, $sectionNumbersUsed));
        $sectionNumbersUsed[] = $sectionNumber;

        $beginning_time = $faker->numberBetween(0, 23);
        $end_time = ($beginning_time + $faker->numberBetween(1, 4)) % 24;

        $stmt->execute(array(
            'number' => $sectionNumber,
            'professor_ssn' => $professor->ssn,
            'course_number' => $course->number,
            'classroom' => $faker->word . ' ' . $faker->numberBetween(100, 599),
            'meeting_days' => $faker->randomElement(array('MWF', 'TTh', 'MW', 'M', 'T', 'W', 'Th', 'F', 'S')),
            'beginning_time' => $beginning_time . ':00',
            'end_time' => $end_time . ':00',
            'seats' => $faker->numberBetween(1,100)
        ));
    }
}