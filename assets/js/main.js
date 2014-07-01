$('#professors-search-submit').click(function(event) {
    event.preventDefault();

    var ssn = $('form#professors-search-form input[name=ssn]').val();

    $.get(window.location.pathname + 'app/ajax.php', {
        type: 'professor',
        ssn: ssn
    },
    function(response) {
        $('#professors-search-form table').fadeIn();
        $('#professor-search-results').html(response);
    });
});

$('#professors-grade-submit').click(function(event) {
    event.preventDefault();

    var courseNumber = $('form#professors-grade-form input[name=course_number]').val();
    var sectionNumber = $('form#professors-grade-form input[name=section_number]').val();

    $.get(window.location.pathname + 'app/ajax.php', {
        type: 'professor',
        course_number: courseNumber,
        section_number: sectionNumber
    },
    function(response) {
        $('#professors-grade-form table').fadeIn();
        $('#professors-grade-results').html(response);

        var courseTitle = $('#professors-grade-form table tr[data-course-title]').attr('data-course-title');
        $('#professors-grade-course-title').html(courseTitle);
    });
});

$('#courses-search-submit').click(function(event) {
    event.preventDefault();

    var courseNumber = $('form#courses-search-form input[name=course_number]').val();

    $.get(window.location.pathname + 'app/ajax.php', {
        type: 'student',
        course_number: courseNumber
    },
    function(response) {
        $('#courses-search-form table').fadeIn();
        $('#courses-search-results').html(response);

        var courseTitle = $('#courses-search-form table tr[data-course-title]').attr('data-course-title');
        $('#courses-search-course-title').html(courseTitle);
    });
});

$('#student-search-submit').click(function(event) {
    event.preventDefault();

    var cwid = $('form#student-search-form input[name=cwid]').val();

    $.get(window.location.pathname + 'app/ajax.php', {
        type: 'student',
        cwid: cwid
    },
    function(response) {
        $('#student-search-form table').fadeIn();
        $('#student-search-results').html(response);

        var studentName = $('#student-search-form table tr[data-student-name]').attr('data-student-name');
        $('#student-search-student-name').html(studentName);
    });
});