<header class="header">
    <div class="nav nav-1">
        <section class="flex">
            <a href="home.php" class="logo"><i class="fas fa-house"></i>EstadiaChile</a>
            <ul>
                <li><a id="btnpro" href="post_property.php">Publicar propiedad<i class="fas 
                fa-paper-plane"></i></a></li>
            </ul>
        </section>
    <div>


    <div class="nav nav-2">
        <section class="flex">
            <div id="menu-btn" class="fas fa-bars"></div>

            <div class="menu">
                <ul>
                    <li><a href="#">Anuncios <i class="fas fa-angle-down"></i>
                    </a>
                        <ul>
                            <li><a href="dashboard.php">Panel</a></li>
                            <li><a href="post_property.php">Publicar propiedad</a></li>
                            <li><a href="my_listings.php">Mis publicaciones</a></li>
                        </ul>
                    </li>
                    <li><a href="#">Opciones<i class="fas fa-angle-down"></i></a>
                        <ul>
                            <li><a href="search.php">Buscar filtros</a></li>
                            <li><a href="listings.php">Mostrar todo</a></li>                        
                        </ul>
                    </li>
                    <li><a href="#">Ayuda<i class="fas fa-angle-down"></i></a>
                        <ul>
                            <li><a href="about.php">Sobre nosotros</a></li>
                            <li><a href="contact.php">Contacto</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
            
            <ul>
                <li><a href="saved.php">Guardados<i class="fas fa-heart"></i></a></li>
                <li><a href="#">Cuenta <i class="fas fa-angle-down"></i></a>
                    <ul>
                        <li><a href="login.php">Iniciar sesion</a></li>
                        <li><a href="register.php">Registro</a></li>
                        <?php if($user_id != ''){ ?>
                        <li><a href="update.php">Actualizar perfil</a></li>
                        <li><a href="components/user_logout.php" onclick="return confirm('¿Seguro que quieres cerrar tu sesion?');">Cerrar sesion</a>
                        <?php } ?></li>
                    </ul>
                </li>
            </ul>
        </section>
    </div>
</header>