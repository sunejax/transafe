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
  <h3>1. What is the output of the below c code?</h3>
    <pre>#include&lt;stdio.h>	
main() 
{
   int x = 5;
   
   if(x=5)
   {	
      if(x=5) printf("Fast");
   } 
   printf("learning");
}</pre>
<br/>
    <input type="radio" id="Fastlearning" name="question1">
       <label for="Fastlearning">1. Fastlearning</label><br/>
    <input type="radio"  name="question1">
       <label>2. learning</label><br/>
    <input type="radio" name="question1">
       <label>3. learningFast</label> <br/>
    <input type="radio" name="question1">
     <label>4. Fast</label> 
 </div>
 <div class="scp-quizzes-data">
  <h3>2. How would you insert pre-written code into a current program ?</h3>
    <pre>#include&lt;stdio.h>	
main() 
{
   int x = 5;
   
   if(x=5)
   {	
      if(x=5) printf("Fast");
   } 
   printf("learning");
}</pre>
<br/>
    <input type="radio" name="question2">
       <label>1. #read&lt;file></label><br/>
    <input type="radio"  name="question2">
       <label>2. #get &lt;file></label><br/>
    <input type="radio" name="question2" id="inculdefile">
       <label for="inculdefile">3. #include &lt;file></label> <br/>
    <input type="radio" name="question2">
     <label>4. #pre &lt;file></label> 
 </div>
</div>


</body></html>