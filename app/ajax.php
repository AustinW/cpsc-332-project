<?php
require_once 'models/Database.php';

$db = Database::instance();

$noResultsFound = '<tr><td colspan="%d" class="no-results">No results found...</td></tr>';
$invalidDataError = '<tr><td colspan="%d" class="error">Invalid data submitted...</td></tr>';

if (isset($_GET['type']) && $_GET['type'] == 'professor') {
    // Professor...

    if (isset($_GET['ssn']) && is_numeric($_GET['ssn'])) {

        $ssn = (int)$_GET['ssn'];

        $sql = "SELECT professors.name, courses.title, sections.classroom, sections.meeting_days, sections.beginning_time, sections.end_time
                FROM professors
                INNER JOIN sections ON sections.professor_ssn = professors.ssn
                INNER JOIN courses ON courses.number = sections.course_number
                WHERE ssn = ?";

        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $ssn);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($name, $title, $classroom, $meeting_days, $beginning_time, $end_time);

        if ($stmt->num_rows == 0) {
            printf($noResultsFound, 5);
        } else {
            while ($row = $stmt->fetch()) {
                echo '<tr>';
                echo '<td>' . $name . '</td>';
                echo '<td>' . $title . '</td>';
                echo '<td>' . $classroom . '</td>';
                echo '<td>' . $meeting_days . '</td>';
                echo '<td>' . $beginning_time . ' - ' . $end_time . '</td>';
                echo '</tr>';
            }
        }

        $stmt->free_result();
        $stmt->close();

    } else if (isset($_GET['course_number']) && is_numeric($_GET['course_number']) && isset($_GET['section_number']) && is_numeric($_GET['section_number'])) {

        $course_number = (int) $_GET['course_number'];
        $section_number = (int) $_GET['section_number'];

        $gradeTemplate = array('A' => 0, 'A-' => 0, 'B+' => 0, 'B' => 0, 'B-' => 0, 'C+' => 0, 'C' => 0, 'C-' => 0, 'D+' => 0, 'D' => 0, 'D-' => 0, 'F' => 0);

        $sql = "SELECT enrollment.grade, COUNT(grade) AS grade_count, courses.title
                FROM enrollment
                INNER JOIN sections ON sections.number = enrollment.section_number
                INNER JOIN courses ON courses.number = sections.course_number
                WHERE section_number = ? AND course_number = ?
                GROUP BY enrollment.grade";

        $stmt = $db->prepare($sql);
        $stmt->bind_param('ii', $section_number, $course_number);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($grade, $gradeCount, $title);

        if ($stmt->num_rows == 0) {
            printf($noResultsFound, count($gradeTemplate));
        } else {
            $retrievedGrades = array();

            $courseTitle = null;
            while ($row = $stmt->fetch()) {
                if ( ! $courseTitle) $courseTitle = $title;
                $retrievedGrades[$grade] = (int) $gradeCount;
            }

            $grades = array_merge(
                $gradeTemplate,
                $retrievedGrades
            );

            echo '<tr data-course-title="' . $courseTitle . '">';
            foreach ($grades as $gradeCount) {
                echo '<td><strong>' . $gradeCount . '</strong></td>';
            }
            echo '</tr>';
        }

        $stmt->free_result();
        $stmt->close();
    } else {
        printf($invalidDataError, 12);
    }
} else {

    if (isset($_GET['course_number']) && is_numeric($_GET['course_number'])) {

        $courseNumber = (int) $_GET['course_number'];

        $sql = "SELECT sections.number, sections.classroom, sections.meeting_days, sections.beginning_time, sections.end_time, courses.title,
                  (SELECT COUNT(*) FROM enrollment WHERE section_number = sections.number) AS enrollment_count
                FROM sections
                INNER JOIN courses ON courses.number = sections.course_number
                WHERE sections.course_number = ?";

        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $courseNumber);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($number, $classroom, $meetingDays, $beginningTime, $endTime, $title, $enrollmentCount);

        if ($stmt->num_rows == 0) {
            printf($noResultsFound, 5);
        } else {
            while ($row = $stmt->fetch()) {
                echo '<tr data-course-title="' . $title . '">';
                echo '<td>' . $number . '</td>';
                echo '<td>' . $classroom . '</td>';
                echo '<td>' . $meetingDays . '</td>';
                echo '<td>' . $beginningTime . ' - ' . $endTime . '</td>';
                echo '<td><span class="badge badge-green">' . $enrollmentCount . '</span></td>';
                echo '</tr>';
            }
        }

        $stmt->free_result();
        $stmt->close();

    } else if (isset($_GET['cwid']) && is_numeric($_GET['cwid'])) {

        $cwid = (int) $_GET['cwid'];

        $sql = "SELECT courses.number, courses.title, enrollment.grade, students.name
                FROM enrollment
                INNER JOIN sections ON sections.number = enrollment.section_number
                INNER JOIN courses ON courses.number = sections.course_number
                INNER JOIN students ON students.cwid = enrollment.student_cwid
                WHERE enrollment.student_cwid = ?";

        $stmt = $db->prepare($sql);
        $stmt->bind_param('i', $cwid);
        $stmt->execute();
        $stmt->store_result();
        $stmt->bind_result($number, $title, $grade, $studentName);


        if ($stmt->num_rows == 0) {
            printf($noResultsFound, 2);
        } else {
            while ($row = $stmt->fetch()) {
                echo '<tr data-student-name="' . $studentName . '">';
                echo '<td>(' . $number . ') ' . $title . '</td>';
                echo '<td>' . $grade . '</td>';
                echo '</tr>';
            }
        }
    } else {
        printf($invalidDataError, 5);
    }
}