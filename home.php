<!DOCTYPE html>
<html lang="en">
<?php
session_start();
if(!isset($_SESSION['user'])){
    header("Location: ". "index.php");
    exit(0);
}
?>
<head>
    <title>Home Page</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link rel="stylesheet" href="css/style.css">
    <link href="css/jquery.dataTables.css" type="text/css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/jquery.dataTables.js"></script>

</head>
<body>
<nav class="navbar navbar-default no-margin" style="background-color: black">
    <div class="navbar-header fixed-brand" style="padding-left: 20px">
        <a class="navbar-brand" href="#" style="color: white"><i class="fa fa-bug" ></i> BugMe Issue Tracker</a>
    </div>
</nav>
<div id="wrapper">
    <!-- Sidebar -->
    <div id="sidebar-wrapper">
        <ul class="sidebar-nav nav-pills nav-stacked" id="menu">
            <li style="padding-top: 30px" class="active">
                <a href="#home" data-toggle="tab"  style="padding-left: 15px; font-size: 20px"><span class="fa fa-home">&nbsp;&nbsp; Home</span></a>
            </li>
            <?php
            if($_SESSION['user']['role']==2){
                echo '<li>';
                echo    '<a href="#user"  data-toggle="tab" onclick="javascript: document.getElementById(\'id1\').style.display=\'block\';document.getElementById(\'id2\').style.display=\'none\';" style="padding-left: 15px; font-size: 20px"><span class="fa fa-user">&nbsp;&nbsp; Add User</span></a>';
                echo '</li>';
            }

            ?>
            <li>
                <a href="#issue" data-toggle="tab" style="padding-left: 15px; font-size: 20px" onclick="javascript: document.getElementById('id1').style.display='none';document.getElementById('id2').style.display='block';"><span class="fa fa-plus-circle">&nbsp;&nbsp; New Issue</span></a>
            </li>
            <li>
                <a href="logout.php" style="padding-left: 15px; font-size: 20px"><span class="fa fa-power-off">&nbsp;&nbsp; Logout</span></a>
            </li>
        </ul>
    </div>
    <div id="page-content-wrapper">
        <div class="container-fluid">
            <br><br>
            <div class="row">
                <div id="id1" class="col-lg-12" style="display: none">
                    <div>
                        <div style="float: right">
                            <button type="button" class="btn btn-default" data-toggle="modal" data-target="#myModal">
                               + New User
                            </button>
                        </div>
                        <div class="modal fade" id="myModal">
                            <form  method="post" id="add_user">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-md-6">
                                                <h4 class="modal-title">NEW USER</h4>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <p>FirstName</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="firstName" placeholder="Enter FirstName" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <p>LastName</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="lastName" placeholder="Enter LastName" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <p>Email</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="email" placeholder="Enter Email" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <p>Password</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="password" class="form-control" name="password" placeholder="Enter Password" required>
                                                        <span style="color: greenyellow">*password have at least 8 letters with number, letter, capital letter</span>
                                                    </div>

                                                </div>
                                            </div>
                                            <br>
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="add_user" id="add_user" class="btn btn-group" value="Submit" style="background-color: #fcb3ff">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>
                        <br><br><br>
                        <table id="letterTable" class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th style="text-align: center"><i>N</i>0</th>
                                <th style="text-align: center">FIRSTNAME</th>
                                <th style="text-align: center">LASTNAME</th>
                                <th style="text-align: center">EMAIL</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname="tracker";
                            $conn=mysqli_connect($servername,$username,$password,$dbname);
                            $query = "SELECT * FROM `users`";
                            $results = mysqli_query($conn, $query);
                            $number=1;
                            while($row=mysqli_fetch_assoc($results)) {
                                echo '<tr id="tr-'.$row['id'].'">';
                                echo '<td class="col-lg-1" style="text-align: center">' . $number . '</td>';
                                echo '<td class="col-lg-3" style="text-align: center">' . $row['firstname'] . '</td>';
                                echo '<td class="col-lg-3" style="text-align: center">' . $row['lastname'] . '</td>';
                                echo '<td  class="col-lg-3" style="text-align: center">' . $row['email'] . '</td>';
                                echo '</tr>';
                                $number++;
                            }
                            ?>
                            <?php mysqli_close($conn);
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div id="id2" class="col-lg-12" style="display: none" >
                    <div>
                        <div class="row">
                            <div style="float: right">
                                <button type="button" class="btn btn-default" data-toggle="modal" data-target="#issueModal">
                                        + Create New Issue
                                </button>
                            </div>
                        </div>
                        <hr>
                        <div class="row" style="padding-bottom: 0; margin-bottom: 0">
                           <div class="col-md-offset-2 col-md-6">
                               <span><b>FILTER:</b></span>
                               <button class="btn btn-default btn-sm" onclick="filter_all();"    style="margin-left: 20px">ALL</button>
                               <button class="btn btn-default btn-sm" onclick="filter_open();"   style="margin-left: 20px">OPEN</button>
                               <button class="btn btn-default btn-sm" onclick="filter_ticket()" style="margin-left: 20px">MY TICKETS</button>

                           </div>
                        </div>
                        <div class="modal" id="issueModal">
                            <form method="post" id="add_issue">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <div class="col-md-6">
                                                <h4 class="modal-title">NEW ISSUE</h4>
                                            </div>
                                            <button type="button" class="close" data-dismiss="modal">&times;</button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <p>Title</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <input type="text" class="form-control" name="title" placeholder="Enter Title" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <p>Description</p>
                                                    </div>
                                                    <div class="col-md-9">
                                                        <textarea name="description" id="description" class="form-control" cols="53" rows="5"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <p>Assigned To</p>
                                                    </div>
                                                    <div class="col-md-9">
<!--                                                        <input type="text" class="form-control" name="assigned_by" placeholder="Enter Assigned To" required>-->
                                                        <select name="assigned_by" id="assigned_by" class="form-control">
                                                         <option value="" disabled ></option>
                                                        <?php
                                                        $servername = "localhost";
                                                        $username = "root";
                                                        $password = "";
                                                        $dbname="tracker";
                                                        $conn=mysqli_connect($servername,$username,$password,$dbname);
                                                        $query = "SELECT * FROM `users`";
                                                        $results = mysqli_query($conn, $query);
                                                        while($row=mysqli_fetch_assoc($results)) {
                                                            echo '<option value="'.$row['firstname'] .'&nbsp;' .$row['lastname'].'">'.$row['firstname'] .'&nbsp;' .$row['lastname'].'</option>';
                                                        }
                                                        mysqli_close($conn);
                                                        ?>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <p>Type</p>
                                                    </div>
                                                    <div class="col-md-9">
<!--                                                        <input type="text" class="form-control" name="type" placeholder="Enter Type" required>-->
                                                        <select name="type" id="type" class="form-control">
                                                            <option value="" disabled ></option>
                                                            <option value="Type">Bug</option>
                                                            <option value="Type">Proposal</option>
                                                            <option value="Type">Task</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <br>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="col-md-3">
                                                        <p>Priority</p>
                                                    </div>
                                                    <div class="col-md-9">
<!--                                                        <input type="text" class="form-control" name="priority" placeholder="Enter Priority" required>-->
                                                        <select name="priority" id="priority" class="form-control">
                                                            <option value="" disabled></option>
                                                            <option value="Minor">Minor</option>
                                                            <option value="Major">Major</option>
                                                            <option value="Critical">Critical</option>
                                                    </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <input type="hidden" name="userId" id="userId" value="<?php echo $_SESSION['user']['id']?>">
                                        </div>
                                        <div class="modal-footer">
                                            <input type="submit" name="add_issue" id="add_issue" class="btn btn-group" value="Submit" style="background-color: #fcb3ff">
                                            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                        <table id="issueTable" class="table table-bordered table-responsive">
                            <thead>
                            <tr>
                                <th style="text-align: center"><i>N</i>0</th>
                                <th style="text-align: center">TITLE</th>
                                <th style="text-align: center">TYPE</th>
                                <th style="text-align: center">STATUS</th>
                                <th style="text-align: center">ASSIGNED TO</th>
                                <th style="text-align: center">CREATED</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $servername = "localhost";
                            $username = "root";
                            $password = "";
                            $dbname="tracker";
                            $conn=mysqli_connect($servername,$username,$password,$dbname);
                            $query = "SELECT * FROM `issues`";
                            $results = mysqli_query($conn, $query);
                            $number=1;
                            while($row=mysqli_fetch_assoc($results)) {
                                $userId= $row['user_id'];
                                $user_query="SELECT * FROM `users` where id='$userId'";
                                $user_result = mysqli_query($conn, $user_query);
                                if ($user_result->num_rows > 0){
                                    $user_row=mysqli_fetch_assoc($user_result);
                                    $userName=$user_row['firstname'].'&nbsp;'. $user_row['lastname'];
                                }
                                else{
                                    $userName = 'user deleted';
                                }
                                echo '<tr id="tr-'.$row['id'].'">';
                                echo '<td class="col-lg-1" style="text-align: center">' . $number . '</td>';
                                echo '<td class="col-lg-4" style="text-align: center"><a data-target="#issueDetailModal_'.$row['id'].'" style="text-decoration: none" data-toggle="modal" class="MainNavText" id="MainNavHelp" href="#issueDetailModal_'.$row['id'].'">' . $row['title'] . '</a></td>';
                                echo '<td class="col-lg-2" style="text-align: center">' . $row['type'] . '</td>';
                                if($row['status']==1){
                                    echo '<td  class="col-lg-1" style="text-align: center"><label for="status" class="label label-primary">OPEN</label></td>';
                                }
                                if($row['status']==2){
                                    echo '<td  class="col-lg-1" style="text-align: center"><label for="status" class="label label-danger">CLOSED</label></td>';
                                }
                                if($row['status']==3){
                                    echo '<td  class="col-lg-1" style="text-align: center"><label for="status" class="label label-success">IN PROGRESS</label></td>';
                                }
                                echo '<td  class="col-lg-2" style="text-align: center">' . $row['assigned_by'] . '</td>';
                                echo '<td  class="col-lg-1" style="text-align: center">' . $row['created'] . '</td>';
                                echo '<div class="modal" id="issueDetailModal_'.$row['id'].'"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><div class="col-md-11">';
                                echo '<h3 class="modal-title">'.$row['title'].'</h3><h6>Issue #'.$row['id'].'</h6></div><button type="button" style="float: right" class="close" data-dismiss="modal">&times;</button></div><div class="modal-body"><div class="row"><div class="col-md-8"><p>'.$row['description']. '</p><br><p>> Issue Created On '.$row['created'].'&nbsp; by '.$userName.'</p><p>> Last updated on '.$row['updated'].'</p></div><div class="col-md-4"><div style="height: 230px; width: 150px; border: 1px solid #ffd8ff; background-color: #b7fff0"> <div class="col-md-12" style="padding: 20px 10px 0px 10px; margin: 0"><b>Assigned To:</b></div> <span class="col-md-12" style="padding: 0px 0px 0px 10px">' .$row['assigned_by'].'</span>  <span class="col-md-12" style="padding: 15px 10px 0px 10px"><b>Type:</b></span> <span class="col-md-12" style="padding: 0px 0px 0px 10px">'.$row['type'].'</span><span class="col-md-12" style="padding: 15px 10px 0px 10px"><b>Priority:</b></span> <br><span class="col-md-12" style="padding: 0px 0px 0px 10px">'.$row['priority'].'</span> <br>';
                                if($row['status']==1){
                                    echo '<span class="col-md-12" style="padding: 15px 10px 0px 10px"><b>Status:</b></span> <span class="col-md-12" style="padding: 0px 0px 0px 10px">Open</span>';
                                }
                                elseif ($row['status']==2){
                                    echo '<span class="col-md-12" style="padding: 15px 10px 0px 10px"><b>Status:</b></span> <span class="col-md-12" style="padding: 0px 0px 0px 10px">Closed</span>';
                                }
                                elseif ($row['status']==3){
                                    echo '<span class="col-md-12" style="padding: 15px 10px 0px 10px"><b>Status:</b></span> <span class="col-md-12" style="padding: 0px 0px 0px 10px">In Progress</span>';
                                }

                                echo '</div></p>';
                                if($row['status']==1 && $_SESSION['user']['role']==2){
                                    echo '<button onclick="closed_col('.$row['id'].');" class="btn btn-sm btn-success" style="background-color: blueviolet ">Mark  as  Closed &nbsp;</button></p><p><button  onclick="progress_col('.$row['id'].');"class="btn btn-sm btn-success">Mark In Progress</button></p>';
                                }
                                else if($row['status']==2 && $_SESSION['user']['role']==2){
                                    echo '<button onclick="open_col('.$row['id'].');" class="btn btn-sm btn-success" style="background-color: blueviolet "> &nbsp; Mark as Open &nbsp;&nbsp;</button></p><p><button onclick="progress_col('.$row['id'].');" class="btn btn-sm btn-success">Mark In Progress</button></p>';
                                }
                                else if($row['status']==3 && $_SESSION['user']['role']==2) {
                                    echo '<button onclick="closed_col('.$row['id'].');" class="btn btn-sm btn-success" style="background-color: blueviolet ">Mark  as  Closed</button></p><p><button onclick="open_col('.$row['id'].');" class="btn btn-sm btn-success">Mark In OPEN &nbsp;</button></p>';
                                }

                                echo '</div></div><div class="modal-footer"><button type="button" class="btn btn-danger" data-dismiss="modal">Close</button></div></div></div></div>';
                                echo '</tr>';
                                $number++;


                            }
                            ?>
                            <?php mysqli_close($conn);
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script>
    $(document).ready(function () {
        var table = $('#letterTable').DataTable({
            responsive: true
        });
    });
    $(document).ready(function () {
        var table = $('#issueTable').DataTable({
            responsive: true
        });
    });
</script>
<script>
    $("#add_user").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = 'add_user.php';
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(result){
                    if (result == 1){
                        alert('Email existed Already, Please Try again');
                    }
                    else if(result == 2){
                        alert("Invalid Email format");
                    }
                    else if(result ==3){
                        alert("Please Input Correct Password Again");
                    }
                    else{
                        $("#letterTable tr:last").after($(result));
                    }
                    $("#myModal").modal('toggle');
                }
            });
            e.preventDefault();
        });

        $("#add_issue").submit(function(e) {
            e.preventDefault();
            var form = $(this);
            var url = 'add_issue.php';
            $.ajax({
                type: "POST",
                url: url,
                data: form.serialize(),
                success: function(result){
                    $("#issueTable tr:last").after($(result));
                    $("#issueModal").modal('toggle');
                }
            });
            e.preventDefault();
        });
        function closed_col(id){
            var status_action=2;
            if(window.confirm('Are you really sure you want to do this?')){
                jQuery.ajax({
                    url: "status_action.php",
                    method: "post",
                    data:{
                        id: id,
                        status_action: status_action
                    },
                    success: function(result){
                        if(result= "success"){
                            var obj_tr = $('#tr-'+id).children().eq(3);
                            obj = $(obj_tr).children().eq(0);
                            $(obj).text('CLOSED');
                            $(obj).removeClass('label-primary');
                            $(obj).removeClass('label-success');
                            $(obj).addClass('label-danger');
                            $("#issueDetailModal_"+id).modal('toggle');
                        }
                    }

                });
            }
        }
        function open_col(id){
            var status_action=1;
            if(window.confirm('Are you really sure you want to do this?')){
                jQuery.ajax({
                    url: "status_action.php",
                    method: "post",
                    data:{
                        id: id,
                        status_action: status_action

                    },
                    success: function(result){
                        if(result= "success"){
                            var obj_tr = $('#tr-'+id).children().eq(3);
                            obj = $(obj_tr).children().eq(0);
                            $(obj).text('OPEN');
                            $(obj).removeClass('label-danger');
                            $(obj).removeClass('label-success');
                            $(obj).addClass('label-primary');
                            $("#issueDetailModal_"+id).modal('toggle');
                        }
                    }

                });
            }
        }
        function progress_col(id){
            var status_action=3;
            if(window.confirm('Are you really sure you want to do this?')){
                jQuery.ajax({
                    url: "status_action.php",
                    method: "post",
                    data:{
                        id: id,
                        status_action: status_action

                    },
                    success: function(result){
                        if(result= "success"){
                            var obj_tr = $('#tr-'+id).children().eq(3);
                            obj = $(obj_tr).children().eq(0);
                            $(obj).text('IN PROGRESS');
                            $(obj).removeClass('label-danger');
                            $(obj).removeClass('label-primary');
                            $(obj).addClass('label-success');
                            $("#issueDetailModal_"+id).modal('toggle');
                        }
                    }

                });
            }
        }
</script>
<script>

    function filter_all() {
        var table = $("#issueTable").DataTable();
        var filter_value='';
        var filteredData = table
            .column( 3 )
            .data()
            .search(filter_value)
            .draw();
    };

    function filter_open() {
        var table = $("#issueTable").DataTable();
        var filter_value='OPEN';
        var filteredData = table
            .column( 5 )
            .data()
            .search(filter_value)
            .draw();

    };

    function filter_ticket() {
        var table = $("#issueTable").DataTable();
        var filter_value="<?php echo $_SESSION['user']['firstname'] ?>";
        var filteredData = table
            .column( 4 )
            .data()
            .search(filter_value)
            .draw();

    }
</script>
</html>
