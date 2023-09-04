<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }

    if(isset($_POST['submit'])){
        $email = $_POST['email'];
        $email = filter_var($email, FILTER_SANITIZE_STRING);
        $pass = sha1($_POST['pass']);
        $pass = filter_var($pass, FILTER_SANITIZE_STRING);
     
        $verify_users = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
        $verify_users->execute([$email, $pass]);
        $row = $verify_users->fetch(PDO::FETCH_ASSOC);
         
        if($verify_users->rowCount() > 0){
               setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
               header('location:home.php');
        }else{
               $warning_msg[] = 'Email o contraseña incorrectos';
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EstadiaChile Login</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<!--header-->
<?php include 'components/user_header.php'; ?>


<section class="form-container">

    <form action="" method="POST">
        <h3>Iniciar Sesion</h3>
        <input type="email" name="email" required maxlength="50"
        placeholder="Ingresa tu email" class="box">
        <input type="password" name="pass" required maxlength="50"
        placeholder="Crea una contraseña" class="box">
        <p>¿No tienes cuenta? <a href="register.php">Registrarme</a></p>
        <input type="submit" value="Iniciar sesion" name="submit" class="btn">
    </form>
</section>




<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/message.php'; ?>

</body>
</html> 