<header>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary p-3">
        <a class="navbar-brand" href="index.php">Mi escuela</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown"
            aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Features</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Pricing</a>
                </li>
                <?php
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'encargado' || $_SESSION['user_role'] == 'admin'): ?>
                    <li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button'
                            data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Encargado
                        </a>
                        <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                            <a class='dropdown-item' href='listar_categorias.php'>Ver categorías
                            </a>
                            <a class='dropdown-item' href='crear_articulo.php'>Crear artículo
                            </a>
                            <a class='dropdown-item' href='ver_articulos.php'>Ver artículos
                            </a>
                        </div>
                    </li>
                <?php endif; ?>
                <?php
                if (isset($_SESSION['user_role']) && $_SESSION['user_role'] == 'admin'): ?>
                    <li class='nav-item dropdown'>
                        <a class='nav-link dropdown-toggle' href='#' id='navbarDropdownMenuLink' role='button'
                            data-toggle='dropdown' aria-haspopup='true' aria-expanded='false'>
                            Administrador
                        </a>
                        <div class='dropdown-menu' aria-labelledby='navbarDropdownMenuLink'>
                            <a class='dropdown-item' href='crear_categoria.php'>Crear categoría
                            </a>
                        </div>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </nav>
</header>