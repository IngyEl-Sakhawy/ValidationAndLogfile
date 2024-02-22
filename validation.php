<?php
//session_start ();
require_once("vendor/autoload.php");

$desired_view = isset($_GET["view"])? $_GET["view"] : DEFAULT_VIEW;
$first_request_time = date("Y-m-d H:i:s");
echo "Hello this visit started at $first_request_time <br/>";


$Flag=0; 
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    foreach ($_POST as $x => $y) {
        
            if (empty($y)) {
                echo "$x is empty";
                echo "<br>";
                $Flag=1;
            } elseif ($x=="name" && strlen($y) > MAX_LENGTH_NAME ){
                echo "**Name is not valid";
                echo "<br>";
                $Flag=1;
            }elseif ($x=="email" && ! filter_var($y, FILTER_VALIDATE_EMAIL) ){
                echo "**Email is not valid";
                echo "<br>";
                $Flag=1;
            }elseif ($x=="message" && strlen($y) > MAX_LENGTH_MESSAGE ){
                echo "**Message is not valid";
                echo "<br>";
                $Flag=1;
            }    
}
if($Flag == 0)
    {
        $name = $_POST["name"];
        $email = $_POST["email"];
        $message = $_POST["message"];
        echo THANK_YOU_MESSAGE;
        echo "<br>";
        echo "Name: $name";
        echo "<br>";
        echo "Email: $email";
        echo "<br>";
        echo "Message: $message";
        echo "<br>";
    }
}
if ($desired_view == "display"){
    display_submit();
    die("<br/> To add a new submit <a href='validation.php?view=add'>click here</a>");
    
} else{
    if(isset($_POST["submit"]) && $flag == 0) {
    // store_submit("Ingy","ingy@gmail.com");
    store_submit($name,$email);

    die("Contact saved successfully"."</br> To visit all contacts <a href='validation.php?view=display'>click here</a>");
    }
}



?>


<html>
    <head>
        <title> contact form </title>


    </head>

    <body>
        <h3> Contact Form </h3>
        <div id="after_submit">
            
        </div>
        <form id="contact_form" action="#" method="POST" enctype="multipart/form-data">


            <div class="row">
                <label class="required" for="name">Your name:</label><br />
                <input id="name" class="input" name="name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : '';?>" type="text" value="" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="email">Your email:</label><br />
                <input id="email" class="input" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '';?>" type="text" value="" size="30" /><br />

            </div>
            <div class="row">
                <label class="required" for="message">Your message:</label><br />
                <textarea id="message" class="input" name="message"  rows="7" cols="30"><?php echo isset($_POST['message']) ? htmlspecialchars($_POST['message']) : '';?></textarea><br />

            </div>

            <input id="submit" name="submit" type="submit" value="Send email" />
            <input id="clear" name="clear" type="reset" value="clear form" />

        </form>
    </body>

</html>