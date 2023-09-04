<?php

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

if(isset($_POST['submit'])){

   $id = create_unique_id();
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING); 
   $number = $_POST['number'];
   $number = filter_var($number, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING); 
   $c_pass = sha1($_POST['c_pass']);
   $c_pass = filter_var($c_pass, FILTER_SANITIZE_STRING);   

   $select_users = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_users->execute([$email]);

   if($select_users->rowCount() > 0){
      $warning_msg[] = 'email already taken!';
   }else{
      if($pass != $c_pass){
         $warning_msg[] = 'Password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(id, name, number, email, password) VALUES(?,?,?,?,?)");
         $insert_user->execute([$id, $name, $number, $email, $c_pass]);
         
         if($insert_user){
            $verify_users = $conn->prepare("SELECT * FROM `users` WHERE email = ? AND password = ? LIMIT 1");
            $verify_users->execute([$email, $c_pass]);
            $row = $verify_users->fetch(PDO::FETCH_ASSOC);
         
            if($verify_users->rowCount() > 0){
               setcookie('user_id', $row['id'], time() + 60*60*24*30, '/');
               header('location:home.php');
            }else{
               $error_msg[] = 'something went wrong!';
            }
         }

      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EstadiaChile Registro</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<!--header-->
<?php include 'components/user_header.php'; ?>


<section class="form-container">

    <form action="" method="POST">
        <h3>Crea una cuenta</h3>
        <input type="text" name="name"  onkeypress="return nombre(event);"  required maxlength="50"
        placeholder="Ingresa tu nombre" class="box">
        <input type="email" name="email" required maxlength="50"
        placeholder="Ingresa tu email" class="box">
        <input type="text" name="number"  onkeypress="return numb(event);"  required maxlength="10"
        placeholder="Ingresa tu numero telefonico" min="0" max="9999999999" class="box">
        <input type="password" name="pass" required maxlength="50"
        placeholder="Crea una contraseña" class="box">
        <input type="password" name="c_pass" required maxlength="50"
        placeholder="Confirma tu contraseña" class="box">
        <p>¿Ya tienes una cuenta? <a href="login.php">Iniciar sesion</a></p>
        <input type="submit" value="Registrame" name="submit" class="btn">
    </form>
</section>





<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>
<?php include 'components/message.php'; ?>

</body>
</html>