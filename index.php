<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title></title>
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
                                    <div class="col-md-12">
                                        <form class="form-inline" role="form" id="professors-form" method="get">
                                            <div class="form-group">
                                                <label for="ssn">SSN:</label>
                                                <input type="text" class="form-control" id="ssn">
                                            </div>
                                            <button type="submit" class="btn btn-primary" id="professors-submit"><i class="fa fa-search"></i> Search</button>

                                            <table class="table table-striped table-bordered classes">
                                                <thead>
                                                    <tr>
                                                        <th>Title</th>
                                                        <th>Classrooms</th>
                                                        <th>Meeting Days</th>
                                                        <th>Meeting Time</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr></tr>
                                                </tbody>
                                            </table>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="tab-pane fade" id="students">
                            students...
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
