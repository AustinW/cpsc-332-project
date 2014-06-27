<?php
/**
 * Created by PhpStorm.
 * User: austinwhite
 * Date: 6/25/14
 * Time: 10:19 PM
 */

require_once __DIR__ . '/../../../app/models/Database.php';
require_once __DIR__ . '/../../../vendor/fzaninotto/faker/src/autoload.php';

$faker = Faker\Factory::create();

$db = Database::getConnection();

$query = "SELECT * FROM students";
$stmt = $db->prepare($query);
$stmt->execute();
$students = array();
while ($row = $stmt->fetchObject()) {
    $students[] = $row;
}

$query = "SELECT * FROM sections";
$stmt = $db->prepare($query);
$stmt->execute();
$sections = array();
while ($row = $stmt->fetchObject()) {
    $sections[] = $row;
}

$query = "INSERT INTO enrollment
          (student_cwid, section_number, grade)
          VALUES
          (:student_cwid, :section_number, :grade)";

$stmt = $db->prepare($query);

$sectionIndexesUsed = array();

foreach ($students as $student) {

    // Student will enroll from 1 to 5 sections
    for ($i = 0; $i < $faker->numberBetween(3, 6); ++$i) {

        do { $sectionIndex = $faker->numberBetween(0, count($sections) - 1); } while(in_array($sectionIndex, $sectionIndexesUsed));
        $sectionIndexesUsed[] = $sectionIndex;

        $stmt->execute(array(
            'student_cwid' => $student->cwid,
            'section_number' => $sections[$sectionIndex]->number,
            'grade' => $faker->randomElement(array('A', 'A-', 'B+', 'B', 'B-', 'C+', 'C', 'C-', 'D+', 'D', 'D-', 'F'))
        ));
    }

    // Reset used section indexes
    $sectionIndexesUsed = array();
}