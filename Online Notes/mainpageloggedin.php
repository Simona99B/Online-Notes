<?php
session_start();
if(!isset($_SESSION['user_id'])){
    header("location: index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Notes</title>
    <link rel="preconnect" href="https://fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css2?family=Arvo&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
    
    <link href="styling.css" rel="stylesheet">
    <style>
        #container{
            margin-top: 120px;
        }
        
        #notePad, #allNotes, #done, .delete{
            display: none;
        }
        
        .buttons{
            margin-bottom: 20px;
        }
        
        textarea{
            width: 100%;
            max-width: 100%;
            font-size: 16px;
            line-height: 1.5em;
            border-left-width: 20px;
            border-color: #D553E0;
            color: #D553E0;
            background-color: #FDF1FF;
            padding: 10px;
            
        }
        
        .noteheader{
            border: : 1px solid grey;
            border-radius: 10px;
            margin-bottom: 10px;
            cursor: pointer;
            padding: 0 10px;
            background: linear-gradient(#FFFFFF, #ECE9E6)
        }
        
        .text{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
          
        .timetext{
            font-size: 20px;
            overflow: hidden;
            white-space: nowrap;
            text-overflow: ellipsis;
        }
        
    </style>
    
  </head>
  <body>
    <!--Navigation Bar -->
      <nav role="navigation" class="navbar navbar-custom navbar-fixed-top">
          
          <div class="container-fluid">
              
              <div class="navbar-header">
                  <a class="navbar-brand">Online Notes</a>
                  <button type="button" class="navbar-toggle" data-target="#navbarCollapse" data-toggle="collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                  </button>
                  
              </div>
              <div class="navbar-collapse collapse" id="navbarCollapse">
                    <ul class="nav navbar-nav">
                        <li><a href="profile.php">Profile</a></li>
                        
                        <li><a href="#">Help</a></li>
                        
                        <li><a href="#">Contact Us</a></li>
                        
                        <li class="active"><a href="#">My Notes</a></li>
                    </ul>
                    <ul class="nav navbar-nav navbar-right"> 
                        <li><a href="#">Logged in as <b><?php echo $_SESSION['username']?></b></a></li>
                        <li><a href="index.php?logout=1">Log out</a></li>
                    </ul>
              </div>
              
          </div>
          
      </nav>
      
    <!--Container-->  
        <div class="container" id="container">
            <!-- Alert Message --->
            <div id="alert" class="alert alert-danger collapse">
                <a class="close" data-dismiss="alert">
                    &times;
                </a>
                
                <p id="alertContent"></p>
            </div>
            <div class="row">
                <div class="col-md-offset-3 col-md-6">
                    <div class="buttons">
                        <button id="addNote" type="button" class="btn btn-info btn-lg">Add Note</button>
                        
                        <button id="edit" type="button" class="btn btn-info btn-lg pull-right">Edit</button>
                        
                        <button id="done" type="button" class="btn green btn-lg pull-right">Done</button>
                        
                        <button id="allNotes" type="button" class="btn btn-info btn-lg">All Notes</button>
                    </div>
                    
                    <div>
                    <div id="notePad">
                        <textarea rows="10"></textarea>
                    </div>
                        
                    <div id="notes" class="notes">
                        <!--Ajax call to a php file-->
                    </div>
                    </div>
                </div>
            </div>
        </div>
      
      
    <!--Footer -->
        <div class="footer">
            <div class="container">
                <p>DevemopmentIsland.com Copyright &copy; 2015-<?php $today = date("Y"); echo $today?>.</p>
            </div>
        </div>

    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://code.jquery.com/jquery-1.12.4.min.js" integrity="sha384-nvAa0+6Qg9clwYCGGPpDQLVpLNn0fRaROjHqs13t4Ggj3Ez50XnGQqc/r8MhnRDZ" crossorigin="anonymous"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>
    <script src="mynotes.js"></script>
  </body>
</html>