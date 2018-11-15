<!DOCTYPE html>
<html lang="en">
<head>
  <title>Event List</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body> 
<?php
session_start();
$a = "";
$url = "moud.in/beta/missioncoordination/events/getAllevents";
$ch = curl_init();
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_URL,$url);
$result=curl_exec($ch);
curl_close($ch);
$result = json_decode($result, true);

?>
<div class="container">

  <h2></h2>
  <div class="row">
    <div class="col-md-8">
     <div class="panel panel-primary">
      <div class="panel-heading">Event List</div>
      <div class="panel-body">
                <table class="table table-hover">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Event name</th>
                  <th>Organizar Name</th>
                  <th>Event date/time</th>
                  <th>Event Location</th>
                </tr>
              </thead>
              <tbody>
              <?php 
             
              if($result['status']=="1"){
                $sr=0;
                foreach ($result['data'] as $data) {
                  $sr++;
                 ?>
                    <tr>
                      <td><?php echo $sr; ?></td>
                      <td><?php echo $data['event_name']; ?></td>
                      <td><?php echo $data['org_name']; ?></td>
                      <td><?php echo $data['evnt_date']." ".$data['evnt_time']; ?></td>
                      <td><?php echo $data['location']; ?></td>
                    </tr>
              <?php 
                }
              }else{ 
                ?>
               <tr>
                  <td colspan="5s">No reord Found</td>
                </tr>
              <?php } ?>
              </tbody>
        </table>
 
      </div>
    </div>
    </div>


    <div class="col-md-8">
       <div class="panel panel-primary">
        <div class="panel-heading">Add Event</div>
        <div class="panel-body">

        <?php if(isset($_SESSION['add_res']['status']) && $_SESSION['add_res']['status']=="0"){ ?>
        <div class="alert alert-danger text-center"><?php echo $_SESSION['add_res']['response']; ?></div>
        <?php } ?>
         <?php if(isset($_SESSION['add_res']['status']) && $_SESSION['add_res']['status']=="1"){ ?>
        <div class="alert alert-success text-center"><?php echo $_SESSION['add_res']['response']; ?></div>
        <?php } ?>
              <form class="form-horizontal" method="post" action="post_event.php">
                <div class="form-group">
                  <label class="control-label col-sm-2" for="email">Event Name:</label>
                  <div class="col-sm-7">
                    <input type="text" class="form-control" id="email" placeholder="Event Name" name="event_name">
                  </div>
                </div>
                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">Organizer name:</label>
                  <div class="col-sm-7">          
                    <input type="text" class="form-control" id="pwd" placeholder="Organizar Name" name="org_name">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">Event Date:</label>
                  <div class="col-sm-7">          
                    <input type="date" class="form-control" id="pwd" placeholder="Event Date" name="evnt_date">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">Event Time:</label>
                  <div class="col-sm-7">          
                    <input type="time" class="form-control" id="pwd" placeholder="Event Time" name="evnt_time">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2" for="pwd">Event Location:</label>
                  <div class="col-sm-7">          
                    <input type="text" class="form-control" id="pwd" placeholder="Event Location" name="location">
                  </div>
                </div>

                <div class="form-group">        
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" name="event_post" class="btn btn-default">Submit</button>
                  </div>
                </div>
              </form>
        </div>
      </div>
    </div>

  </div> 

<?php session_destroy();  ?>
</div>

</body>
</html>
