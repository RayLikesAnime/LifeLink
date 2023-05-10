<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require '../vendor/autoload.php';
if(!isset($_SERVER['HTTP_REFERER'])){
    header("Location: ./Login.php");
    exit;
}
session_start();
if(isset($_SESSION['username']) =="") {
    setcookie(session_name(), '', 100);
    session_unset();
    session_destroy();
    header("Location: ./Login.php");
}
if(isset($_POST['logout'])){
    setcookie(session_name(), '', 100);
    session_unset();
    session_destroy();
    header("Location: ./Login.php");
}

$showAlert=false;
$showError=false;
$exists=false;

if($_SERVER["REQUEST_METHOD"]=="POST"){
    include "dbconnect.php";
    $username=$_POST["username"];
    $password=$_POST["password"];
    $cpassword=$_POST["cpassword"];
    $email=$_POST["email"];

    $sql="SELECT * FROM `login` where `Email`='$email'";
    $res=mysqli_query($conn,$sql);
    $num=mysqli_num_rows($res);

    if($num==0){
        //validate password atleast 6 characters
        if(strlen($password)<6){
            $showError="Password must be atleast 6 characters";
        }
        else{
            if(($password == $cpassword) && $exists==false){
                $hash=password_hash($password,PASSWORD_DEFAULT);
                $token = bin2hex(random_bytes(20)); // Generate a random token
                $sql="INSERT INTO `login` (`Email`,`username`, `password`, `login_lD`, `token`) VALUES ('$email','$username', '$password', NULL, '$token');";
                $result = mysqli_query($conn, $sql); 
                if ($result) {
                    // Send the token to the user's email
                    $mail = new PHPMailer();
                    $mail->isSMTP();
                    $mail->Host = 'smtp.gmail.com';
                    $mail->SMTPAuth = true;
                    $mail->Username = 'lifelinkiiita@gmail.com'; // Your gmail address
                    $mail->Password = 'nmqejgxnjkcssrqz'; // Your gmail password or app password
                    $mail->SMTPSecure = 'tls';
                    $mail->Port = 587;
                    $mail->setFrom('lifelinkiiita@gmail.com', 'LifeLink'); // Set your name and email address
                    $mail->addAddress($email); // Recipient's email address
                    $mail->isHTML(true);
                    $mail->Subject = 'Verification Token';
                    $mail->Body    = "Use this token to verify your account: $token";
                    if(!$mail->send()) {
                        $showError = 'Unable to send verification email.';
                    } else {
                        $showAlert = true;
                    }
                }
            }
            else { 
                $showError = "Passwords do not match"; 
            }
        } 
    } 
    if($num>0){
        $exists="Either username not available or you already have an account";
    }   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="index.css">
</head>
<body>
    <header>
        <nav class="bg-black text-white p-2 flex justify-between items-center sticky">
            <div class="ml-4 flex items-center">
                <img src="./images/logo.png" alt="">
                <h1 class="text-3xl ml-2 font-semibold">LifeLink</h1>
            </div>
            <ul class="flex justify-evenly mr-8">
                <li class="text-lg font-semibold px-4"><a href="./Userpage.php">Home</a></li>

                <li class="text-lg font-semibold px-4">
                   <form action="./Login.php" method="post">
                         <input type="submit" name="logout" value="Logout">
                    </form> 
                </li>
            </ul>
        </nav>
    </header>
    <main class="flex">
        <div class=" w-1/2 flex justify-center items-center h-screen">
            <div class="flex flex-col justify-center items-center">
                <img src="./images/signup.jpg" alt="">
            </div>
        </div>
         <div class=" w-1/2 flex justify-center items-center h-screen">
           <div class="flex flex-col justify-center items-center">
                <h1 class="font-semibold text-3xl">Enter the details of the new admin</h1>
                <form action="./Signup.php" method="post">
                    <div class="flex flex-col justify-center items-center">
                        <input type="text" id="username" name="username" placeholder="Username" class="border-2 border-black rounded-lg p-2 mt-4" required>
                        <input type="text" id="email" name="email" placeholder="Email ID" class="border-2 border-black rounded-lg p-2 mt-4" required>
                        <input type="password" id="password" name="password" placeholder="Password" class="border-2 border-black rounded-lg p-2 mt-4" required>
                        <input type="password" id="cpassword" name="cpassword" placeholder="Confirm Password" class="border-2 border-black rounded-lg p-2 mt-4" required>
                        <button class="bg-red-500 text-white px-4 py-2 rounded-lg mt-2">SignUp</button>
                    </div>
                    
                </form>
                <?php
                if($showAlert) {
                    $message = "Token Sent To Mail";
                    echo "<script type='text/javascript'>alert('$message');</script>";
                }
                if($showError){ 
                ?>
                    <div class="text-red-500 font-semibold text-xl text-center">
                       <?php echo $showError; ?>
                    </div>
                <?php
                } 
                if($exists){
                ?>
                    <div class="text-red-500 font-semibold text-xl text-center">
                        Account already exists or username not available!!
                    </div> 
                <?php
                } 
                ?>
            </div>  
        </div>
    </main>
</body>
</html>