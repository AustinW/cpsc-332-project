<?php
require_once 'models/Database.php';

$db = Database::getConnection();

if (isset($_GET['type']) && $_GET['type'] == 'professor') {
    // Professor...

    if (isset($_GET['ssn']) && is_numeric($_GET['ssn'])) {

        $params = array('ssn' => (int)$_GET['ssn']);

        $sql = "SELECT professors.`fname`, professors.`lname`, courses.`title`, sections.`classroom`, sections.`meeting_days`, sections.`beginning_time`, sections.`end_time`
                FROM professors
                INNER JOIN sections ON sections.`professor_ssn` = professors.`ssn`
                INNER JOIN courses ON courses.`number` = sections.`course_number`
                WHERE ssn = :ssn";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        while ($row = $stmt->fetchObject()) {
            echo '<tr>';
            echo '<td>' . $row->fname . ' ' . $row->lname . '</td>';
            echo '<td>' . $row->title . '</td>';
            echo '<td>' . $row->classroom . '</td>';
            echo '<td>' . $row->meeting_days . '</td>';
            echo '<td>' . $row->beginning_time . ' - ' . $row->end_time . '</td>';
            echo '</tr>';
        }
    } else if (isset($_GET['course_number']) && is_numeric($_GET['course_number']) && isset($_GET['section_number']) && is_numeric($_GET['section_number'])) {

        $params = array(
            'course_number' => (int) $_GET['course_number'],
            'section_number' => (int) $_GET['section_number']
        );

        $gradeTemplate = array('A' => 0, 'A-' => 0, 'B+' => 0, 'B' => 0, 'B-' => 0, 'C+' => 0, 'C' => 0, 'C-' => 0, 'D+' => 0, 'D' => 0, 'D-' => 0, 'F' => 0);

        $sql = "SELECT enrollment.grade, COUNT(grade) AS grade_count, courses.title
                FROM enrollment
                INNER JOIN sections ON sections.number = enrollment.section_number
                INNER JOIN courses ON courses.number = sections.course_number
                WHERE section_number = :section_number AND course_number = :course_number
                GROUP BY enrollment.grade";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        $retrievedGrades = array();

        $courseTitle = null;
        while ($row = $stmt->fetchObject()) {
            if ( ! $courseTitle) $courseTitle = $row->title;
            $retrievedGrades[$row->grade] = (int) $row->grade_count;
        }

        $grades = array_merge(
            $gradeTemplate,
            $retrievedGrades
        );

        echo '<tr>';
        foreach ($grades as $gradeCount) {
            echo '<td><strong>' . $gradeCount . '</strong></td>';
        }
        echo '</tr>';

    } else {
        // error...
    }
} else {

    if (isset($_GET['course_number']) && is_numeric($_GET['course_number'])) {

        $params = array(
            'course_number' => (int) $_GET['course_number']
        );

        $sql = "SELECT sections.number, sections.classroom, sections.meeting_days, sections.beginning_time, sections.end_time, courses.title,
                  (SELECT COUNT(*) FROM enrollment WHERE section_number = sections.number) AS enrollment_count
                FROM sections
                INNER JOIN courses ON courses.number = sections.course_number
                WHERE sections.course_number = :course_number";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        while ($row = $stmt->fetchObject()) {
            echo '<tr>';
            echo '<td>' . $row->number . '</td>';
            echo '<td>' . $row->classroom . '</td>';
            echo '<td>' . $row->meeting_days . '</td>';
            echo '<td>' . $row->beginning_time . ' - ' . $row->end_time . '</td>';
            echo '<td><span class="badge badge-green">' . $row->enrollment_count . '</span></td>';
            echo '</tr>';
        }
    } else if (isset($_GET['ssn']) && is_numeric($_GET['ssn'])) {

        $params = array(
            'ssn' => (int) $_GET['ssn']
        );

        $sql = "SELECT courses.number, courses.title, enrollment.grade
                FROM enrollment
                INNER JOIN sections ON sections.number = enrollment.section_number
                INNER JOIN courses ON courses.number = sections.course_number
                WHERE enrollment.student_cwid = :ssn";

        $stmt = $db->prepare($sql);
        $stmt->execute($params);

        while ($row = $stmt->fetchObject()) {
            echo '<tr>';
            echo '<td>(' . $row->number . ') ' . $row->title . '</td>';
            echo '<td>' . $row->grade . '</td>';
            echo '</tr>';
        }
    }
}