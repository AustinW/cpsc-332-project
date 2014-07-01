# CPSC 332 Project

## SQL Queries:

Our project uses the following queries to scan the database for relevant information.

[Database Schema](https://github.com/AustinW/cpsc-332-project/blob/master/university.sql)

### Professor

Part A)
```sql
SELECT professors.name, courses.title, sections.classroom, sections.meeting_days, sections.beginning_time, sections.end_time
FROM professors
INNER JOIN sections ON sections.professor_ssn = professors.ssn
INNER JOIN courses ON courses.number = sections.course_number
WHERE ssn = ?
```

Part B)
```sql
SELECT enrollment.grade, COUNT(grade) AS grade_count, courses.title
FROM enrollment
INNER JOIN sections ON sections.number = enrollment.section_number
INNER JOIN courses ON courses.number = sections.course_number
WHERE section_number = ? AND course_number = ?
GROUP BY enrollment.grade
```

### Students

Part A)
```sql
SELECT sections.number, sections.classroom, sections.meeting_days, sections.beginning_time, sections.end_time, courses.title,
  (SELECT COUNT(*) FROM enrollment WHERE section_number = sections.number) AS enrollment_count
FROM sections
INNER JOIN courses ON courses.number = sections.course_number
WHERE sections.course_number = ?
```

Part B)
```sql
SELECT courses.number, courses.title, enrollment.grade
FROM enrollment
INNER JOIN sections ON sections.number = enrollment.section_number
INNER JOIN courses ON courses.number = sections.course_number
WHERE enrollment.student_cwid = ?
```