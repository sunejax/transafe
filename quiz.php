<?php
include('login/server.php');


if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "You must log in first";
    header('location: login/login.php');

}


if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: login/login.php");
}
?>
<!DOCTYPE html>
<html>
   <head>
      <title>C Programming Language Output this code Quizzes 1</title>
    
                <link rel="stylesheet" type="text/css" href="./css/qstyle.css" />
                
 
    <script src="http://www.fastlearning.in/controller/js/jquery-1.9.1.min.js"></script>
    
     <script type="text/javascript">
	$(document).ready(function() {
    $('label').click(function() {
        $('label').removeClass('worngans');
        $(this).addClass('worngans');
    });
});
	</script>
   
    
   </head>
   <body >
<div class="scp-quizzes-main">
<div class="scp-quizzes-data">
  <h3>1. You are approaching a narrow bridge, another vehicle is about to enter the bridge from opposite side, you</h3>
<br/>
    <input type="radio" id="Fastlearning" name="question1">
       <label for="Fastlearning">1. Increase the speed and try to cross the bridge as fast as possible </label><br/>
    <input type="radio"  name="question1">
       <label>2. Put on the headlight and pass the bridge </label><br/>
    <input type="radio" name="question1">
       <label>3. Wait till the other vehicle crosses the bridge and then proceed</label> <br/>
 </div>
 <div class="scp-quizzes-data">
  <h3>2. Near a pedestrian crossing, when the pedestrians are waiting to cross the road, you should</h3>

<br/>
    <input type="radio" name="question2">
       <label>1. Sound horn and proceed.</label><br/>
    <input type="radio"  name="question2">
       <label>2. Slow down, sound horn and pass.</label><br/>
    <input type="radio" name="question2" id="inculdefile">
       <label for="inculdefile">3. Stop the vehicle and wait till the pedestrians cross the road and then proceed. </label> <br/>
 </div>
</div>


</body></html>