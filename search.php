<?php  

include 'components/connect.php';

if(isset($_COOKIE['user_id'])){
   $user_id = $_COOKIE['user_id'];
}else{
   $user_id = '';
}

include 'components/save_send.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>EstadiaChil Search</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>

<!-- search filter section starts  -->

<section class="filters" style="padding-bottom: 0;">

   <form action="" method="post">
      <div id="close-filter"><i class="fas fa-times"></i></div>
      <h3>Busca tu vivienda ideal</h3>
         
         <div class="flex">
            <div class="box">
               <p>Ingresa ubicacion</p>
               <input type="text" name="location" required maxlength="50" placeholder="Ingresa la ubicacion" class="input">
            </div>
            <div class="box">
               <p>Tipo oferta</p>
               <select name="offer" class="input" required>
                  <option value="sale">Vender</option>
                  <option value="resale">Re-vender</option>
                  <option value="rent">Arrendar</option>
               </select>
            </div>
            <div class="box">
               <p>Tipo de propiedad</p>
               <select name="type" class="input" required>
                  <option value="flat">Casa un piso</option>
                  <option value="house">Casa dos o mas pisos</option>
                  <option value="shop">Departamento</option>
               </select>
            </div>
            <div class="box">
               <p>Presupuesto minimo</p>
               <select name="min" class="input" required>
               <option value="5000">100k</option>
                  <option value="10000">200k</option>
                  <option value="15000">300k</option>
                  <option value="20000">400k</option>
                  <option value="30000">500k</option>
                  <option value="40000">600k</option>
                  <option value="40000">700k</option>
                  <option value="50000">800k</option>
                  <option value="100000">1 M</option>
                  <option value="500000">5 M</option>
                  <option value="1000000">10 M</option>
                  <option value="2000000">20 M</option>
                  <option value="3000000">30 M</option>
                  <option value="4000000">40 M</option>
                  <option value="4000000">50 M</option>
                  <option value="5000000">60 M</option>
                  <option value="6000000">80 M</option>
                  <option value="7000000">90 M</option>
                  <option value="10000000">100 M</option>
                  <option value="20000000">200 M</option>
                  <option value="30000000">300 M</option>
                  <option value="40000000">400 M</option>
                  <option value="50000000">500 M</option>
                  <option value="60000000">600 M</option>
               </select>
            </div>
            <div class="box">
               <p>Presupuesto maximo</p>
               <select name="max" class="input" required>
               <option value="5000">100k</option>
               <option value="5000">100k</option>
                  <option value="10000">200k</option>
                  <option value="15000">300k</option>
                  <option value="20000">400k</option>
                  <option value="30000">500k</option>
                  <option value="40000">600k</option>
                  <option value="40000">700k</option>
                  <option value="50000">800k</option>
                  <option value="100000">1 M</option>
                  <option value="500000">5 M</option>
                  <option value="1000000">10 M</option>
                  <option value="2000000">20 M</option>
                  <option value="3000000">30 M</option>
                  <option value="4000000">40 M</option>
                  <option value="4000000">50 M</option>
                  <option value="5000000">60 M</option>
                  <option value="6000000">80 M</option>
                  <option value="7000000">90 M</option>
                  <option value="10000000">100 M</option>
                  <option value="20000000">200 M</option>
                  <option value="30000000">300 M</option>
                  <option value="40000000">400 M</option>
                  <option value="50000000">500 M</option>
                  <option value="60000000">600 M</option>
               </select>
            </div>
            <div class="box">
               <p>Estado amueblado</p>
               <select name="furnished" class="input" required>
                  <option value="unfurnished">Desamueblada</option>
                  <option value="furnished">Amueblada</option>
                  <option value="semi-furnished">Semi-amueblada</option>
               </select>
            </div>
         </div>
         <input type="submit" value="Buscar propiedad" name="filter_search" class="btn">
   </form>

</section>

<!-- search filter section ends -->

<div id="filter-btn" class="fas fa-filter"></div>

<?php

if(isset($_POST['h_search'])){

   $h_location = $_POST['h_location'];
   $h_location = filter_var($h_location, FILTER_SANITIZE_STRING);
   $h_type = $_POST['h_type'];
   $h_type = filter_var($h_type, FILTER_SANITIZE_STRING);
   $h_offer = $_POST['h_offer'];
   $h_offer = filter_var($h_offer, FILTER_SANITIZE_STRING);
   $h_min = $_POST['h_min'];
   $h_min = filter_var($h_min, FILTER_SANITIZE_STRING);
   $h_max = $_POST['h_max'];
   $h_max = filter_var($h_max, FILTER_SANITIZE_STRING);

   $select_properties = $conn->prepare("SELECT * FROM `property` WHERE address LIKE '%{$h_location}%' AND type LIKE '%{$h_type}%' AND offer LIKE '%{$h_offer}%' AND price BETWEEN $h_min AND $h_max ORDER BY date DESC");
   $select_properties->execute();

}elseif(isset($_POST['filter_search'])){

   $location = $_POST['location'];
   $location = filter_var($location, FILTER_SANITIZE_STRING);
   $type = $_POST['type'];
   $type = filter_var($type, FILTER_SANITIZE_STRING);
   $offer = $_POST['offer'];
   $offer = filter_var($offer, FILTER_SANITIZE_STRING);
   $min = $_POST['min'];
   $min = filter_var($min, FILTER_SANITIZE_STRING);
   $max = $_POST['max'];
   $max = filter_var($max, FILTER_SANITIZE_STRING);
   $furnished = $_POST['furnished'];
   $furnished = filter_var($furnished, FILTER_SANITIZE_STRING);

   $select_properties = $conn->prepare("SELECT * FROM `property` WHERE address LIKE '%{$location}%' AND type LIKE '%{$type}%' AND offer LIKE '%{$offer}%' AND furnished LIKE '%{$furnished}%' AND price BETWEEN $min AND $max ORDER BY date DESC");
   $select_properties->execute();

}else{
   $select_properties = $conn->prepare("SELECT * FROM `property` ORDER BY date DESC LIMIT 6");
   $select_properties->execute();
}

?>

<!-- listings section starts  -->

<section class="listings">

   <?php 
      if(isset($_POST['h_search']) or isset($_POST['filter_search'])){
         echo '<h1 class="heading">Resultados de busqueda</h1>';
      }else{
         echo '<h1 class="heading">Ultimos anuncios</h1>';
      }
   ?>

   <div class="box-container">
      <?php
         $total_images = 0;
         if($select_properties->rowCount() > 0){
            while($fetch_property = $select_properties->fetch(PDO::FETCH_ASSOC)){
            $select_user = $conn->prepare("SELECT * FROM `users` WHERE id = ?");
            $select_user->execute([$fetch_property['user_id']]);
            $fetch_user = $select_user->fetch(PDO::FETCH_ASSOC);

            if(!empty($fetch_property['image_02'])){
               $image_coutn_02 = 1;
            }else{
               $image_coutn_02 = 0;
            }
            if(!empty($fetch_property['image_03'])){
               $image_coutn_03 = 1;
            }else{
               $image_coutn_03 = 0;
            }
            if(!empty($fetch_property['image_04'])){
               $image_coutn_04 = 1;
            }else{
               $image_coutn_04 = 0;
            }
            if(!empty($fetch_property['image_05'])){
               $image_coutn_05 = 1;
            }else{
               $image_coutn_05 = 0;
            }

            $total_images = (1 + $image_coutn_02 + $image_coutn_03 + $image_coutn_04 + $image_coutn_05);

            $select_saved = $conn->prepare("SELECT * FROM `saved` WHERE property_id = ? and user_id = ?");
            $select_saved->execute([$fetch_property['id'], $user_id]);

      ?>
      <form action="" method="POST">
         <div class="box">
            <input type="hidden" name="property_id" value="<?= $fetch_property['id']; ?>">
            <?php
               if($select_saved->rowCount() > 0){
            ?>
            <button type="submit" name="save" class="save"><i class="fas fa-heart"></i><span>Guardado</span></button>
            <?php
               }else{ 
            ?>
            <button type="submit" name="save" class="save"><i class="far fa-heart"></i><span>Guardar</span></button>
            <?php
               }
            ?>
            <div class="thumb">
               <p class="total-images"><i class="far fa-image"></i><span><?= $total_images; ?></span></p> 
               <img src="uploaded_files/<?= $fetch_property['image_01']; ?>" alt="">
            </div>
            <div class="admin">
               <h3><?= substr($fetch_user['name'], 0, 1); ?></h3>
               <div>
                  <p><?= $fetch_user['name']; ?></p>
                  <span><?= $fetch_property['date']; ?></span>
               </div>
            </div>
         </div>
         <div class="box">
            <div class="price"><i class="fas fa-coins"></i>$ <span><?= $fetch_property['price']; ?> CLP</span></div>
            <h3 class="name"><?= $fetch_property['property_name']; ?></h3>
            <p class="location"><i class="fas fa-map-marker-alt"></i><span><?= $fetch_property['address']; ?></span></p>
            <div class="flex">
            <p><i class="fas fa-house"></i>Tipo de vivienda: <span id="listings"><?= $fetch_property['type']; ?></span></p>
               <p><i class="fas fa-tag"></i>Tipo oferta: <span id="listings"><?= $fetch_property['offer']; ?></span></p>
               <p><i class="fas fa-bed"></i>Habitacion: <span id="listings"><?= $fetch_property['bedroom']; ?></span></p>
               <p><i class="fas fa-bath"></i>Baño: <span id="listings"><?= $fetch_property['bathroom']; ?></span></p>
               <p><i class="fas fa-couch"></i>Amueblado: <span id="listings"><?= $fetch_property['furnished']; ?></span></p>
            </div>
            <div class="flex-btn">
               <a href="view_property.php?get_id=<?= $fetch_property['id']; ?>" class="btn">Ver vivienda</a>
               <input type="submit" value="Enviar mensaje" name="send" class="btn">
            </div>
         </div>
      </form>
      <?php
         }
      }else{
         echo '<p class="empty">No hay rersultados para la busqueda</p>';
      }
      ?>
      
   </div>

</section>

<!-- listings section ends -->











<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<?php include 'components/footer.php'; ?>

<!-- custom js file link  -->
<script src="js/main.js"></script>

<?php include 'components/message.php'; ?>

<script>

document.querySelector('#filter-btn').onclick = () =>{
   document.querySelector('.filters').classList.add('active');
}

document.querySelector('#close-filter').onclick = () =>{
   document.querySelector('.filters').classList.remove('active');
}

</script>

</body>
</html>