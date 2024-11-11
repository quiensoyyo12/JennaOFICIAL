<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="login/styleB.css">
    <link rel="stylesheet" href="css/css/bootstrap.css">
    <link rel="stylesheet" href="styleCon2.css">
    <title>Lista de venta</title>

</head>

<body>
    <header>
        <div class="logo">logo</div>
        <div class="bars">
            <div class="line"></div>
            <div class="line"></div>
            <div class="line"></div>
        </div>
        <nav class="nav-bar">
            <ul>
                <li>
                    <a href="" class="active">inicio</a>
                </li>
                <li>
                    <a href="" class="">Blog</a>
                </li>
                <li>
                    <a href="" class="">Portafolio</a>
                </li>
                <li>
                    <a href="" class="">Contacto</a>
                </li>
            </ul>
        </nav>
    </header>
    <script src="script2.js"></script>

    <center>
        <div class="container text-center">
            <div class="row">
                <div class="col">
                    &nbsp;
                </div>
                <div class="col-6">
                    <br>
                    <h2>Lista de ventas</h2>
                    <table class="table table-success table-striped table-bordered table-hover">
                        <tr>
                            <th>
                                *idDetalle_venta
                            </th>
                            <th>
                                idVentas
                            </th>
                            <th>
                                idProductos
                            </th>
                            <th>
                                *Cantidad
                            </th>
                        </tr>
                        <?php
                        $conexion =
                            mysqli_connect(
                                "localhost",
                                "root",
                                "",
                                "jennawork"
                            )
                            or die("Error de conexión de BD");
                        $consulta =
                            "SELECT * FROM detalle_venta";
                        $resultado = mysqli_query($conexion, $consulta);
                        while ($row = mysqli_fetch_row($resultado)) {
                            echo "<tr><td>" . $row[0] . "</td>";
                            echo "<td>" . $row[1] . "</td>";
                            echo "<td>" . $row[2] . "</td>";
                            echo "<td>" . $row[3] . "</td></tr>";
                        }
                        ?>
                    </table>
                </div>
                <div class="col">
                    &nbsp;
                </div>
            </div>
        </div>
    </center>
</body>

</html>