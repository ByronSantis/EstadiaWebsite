<?php
    include 'components/connect.php';

    if (isset($_COOKIE['user_id'])) {
        $user_id = $_COOKIE['user_id'];
    }else{
        $user_id = '';
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>EstadiaChile</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">

    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

<!--header-->
<?php include 'components/user_header.php'; ?>

<div class="home">

   <section class="center">

      <form action="search.php" method="post">
         <h3>Encuentra tu estadia perfecta</h3>
         <div class="box">
            <p>Ingresa ubicacion<span>*</span></p>
            <input type="text" name="h_location" required maxlength="100" placeholder="Ingresa ciudad" class="input">
         </div>
         <div class="flex">
            <div class="box">
               <p>Tipo de vivienda<span>*</span></p>
               <select name="h_type" class="input" required>
                  <option value="flat">Casa un piso</option>
                  <option value="house">Casa dos o mas pisos</option>
                  <option value="shop">Departamento</option>
               </select>
            </div>
            <div class="box">
               <p>Tipo de oferta<span>*</span></p>
               <select name="h_offer" class="input" required>
                  <option value="sale">Vender</option>
                  <option value="resale">Re-vender</option>
                  <option value="rent">Arrendar</option>
               </select>
            </div>
            <div class="box">
               <p>presupuesto minimo<span>*</span></p>
               <select name="h_min" class="input" required>
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
               <p>Presupuesto maximo<span>*</span></p>
               <select name="h_max" class="input" required>
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
         </div>
         <input id="btnpro"  type="submit" value="Buscar propiedad" name="h_search" class="btn">
      </form>

   </section>

   </div>

   <section class="services">

   <h1 class="heading">Nuestros servicios</h1>

   <div class="box-container">

      <div class="box">
         <img src="images/icon-1.png" alt="">
         <h3>Comprar vivienda</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
      </div>

      <div class="box">
         <img src="images/icon-2.png" alt="">
         <h3>Arrendar vivienda</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
      </div>

      <div class="box">
         <img src="images/icon-3.png" alt="">
         <h3>Vender vivienda</h3>
         <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Doloremque, incidunt.</p>
      </div>

   </div>

</section>

<section class="listings">

   <h1 class="heading">Mis publicaciones</h1>

   <div class="box-container">
      <?php
         $total_images = 0;
         $select_properties = $conn->prepare("SELECT * FROM `property` ORDER BY date DESC LIMIT 6");
         $select_properties->execute();
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
            <div class="price"><i class="fas fa-coins"></i>$ <span> <?= $fetch_property['price']; ?> CLP</span></div>
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
         echo '<p class="empty">Aún no hay publicaciones <a href="post_property.php" style="margin-top:1.5rem;" class="btn">Agregar publicacion</a></p>';
      }
      ?>
      
   </div>

   <div style="margin-top: 2rem; text-align:center;">
      <a href="listings.php" class="inline-btn">Ver todas</a>
   </div>

</section>


<!--footer-->
<?php include 'components/footer.php'; ?>

<script src="js/main.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

</body>
</html>