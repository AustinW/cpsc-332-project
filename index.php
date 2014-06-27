<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>CSUF</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
        <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap-theme.min.css">
        <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
        <link rel="stylesheet" href="assets/css/main.css">
    </head>
    <body>
        
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h1>California State University, Fullerton</h1>

                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#professors" data-toggle="tab">Professors</a></li>
                        <li><a href="#students" data-toggle="tab">Students</a></li>
                    </ul>

                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div class="tab-pane fade in active" id="professors">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4>Search Professors:</h4>
                                        <hr>
                                        <form class="form-inline" role="form" id="professors-search-form" method="get">
                                            <div class="form-group">
                                                <label for="professors-search-ssn">SSN:</label>
                                                <input type="text" class="form-control" name="ssn" id="professors-search-ssn">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="professors-search-submit"><i class="fa fa-search"></i> Search</button>

                                            <table class="table table-striped table-bordered classes">
                                                <thead>
                                                    <tr>
                                                        <th>Name</th>
                                                        <th>Title</th>
                                                        <th>Classrooms</th>
                                                        <th>Meeting Days</th>
                                                        <th>Meeting Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="professor-search-results">
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:50px">
                                    <div class="col-md-8">
                                        <h4>Search Grades:</h4>
                                        <hr>
                                        <form class="form-inline" role="form" id="professors-grade-form" method="get">
                                            <div class="form-group">
                                                <label for="professors-grade-course-number">Course Number:</label>
                                                <input type="text" class="form-control" name="course_number" id="professors-grade-course-number">

                                                <label for="professors-grade-section-number">Section Number:</label>
                                                <input type="text" class="form-control" name="section_number" id="professors-grade-section-number">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="professors-grade-submit"><i class="fa fa-search"></i> Search</button>

                                            <table class="table table-striped table-bordered classes">
                                                <thead>
                                                    <tr>
                                                        <th>A</th>
                                                        <th>A-</th>
                                                        <th>B+</th>
                                                        <th>B</th>
                                                        <th>B-</th>
                                                        <th>C+</th>
                                                        <th>C</th>
                                                        <th>C-</th>
                                                        <th>D+</th>
                                                        <th>D</th>
                                                        <th>D-</th>
                                                        <th>F</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="professors-grade-results">
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="students">
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h4>Search Courses:</h4>
                                        <hr>
                                        <form class="form-inline" role="form" id="courses-search-form" method="get">
                                            <div class="form-group">
                                                <label for="courses-search-course-number">Course Number:</label>
                                                <input type="text" class="form-control" name="course_number" id="courses-search-course-number">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="courses-search-submit"><i class="fa fa-search"></i> Search</button>

                                            <table class="table table-striped table-bordered classes">
                                                <thead>
                                                    <tr>
                                                        <th>Section #</th>
                                                        <th>Classroom</th>
                                                        <th>Meeting Days</th>
                                                        <th>Meeting Time</th>
                                                        <th>Students Enrolled</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="courses-search-results">
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>

                                <div class="row" style="margin-top:50px">
                                    <div class="col-md-8">
                                        <h4>Search Student:</h4>
                                        <hr>
                                        <form class="form-inline" role="form" id="student-search-form" method="get">
                                            <div class="form-group">
                                                <label for="student-search-cwid">CWID:</label>
                                                <input type="text" class="form-control" name="cwid" id="student-search-cwid">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="student-search-submit"><i class="fa fa-search"></i> Search</button>

                                            <table class="table table-striped table-bordered classes">
                                                <thead>
                                                    <tr>
                                                        <th>Course</th>
                                                        <th>Grade</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="student-search-results">
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <script src="bower_components/jquery/dist/jquery.min.js"></script>
        <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
        
        <script src="assets/js/main.js"></script>
    </body>
</html>
