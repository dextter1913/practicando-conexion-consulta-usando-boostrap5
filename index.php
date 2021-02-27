<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practicando consultas y ingreso a bases de datos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-BmbxuPwQa2lc/FVzBcNJ7UAyJxM6wuqIj61tLrc4wSX0szH/Ev+nYRRuWlolflfl" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta2/dist/js/bootstrap.bundle.min.js" integrity="sha384-b5kHyXgcpbZJO/tY9Ul7kGkf1S0CWuKcCD38l8YkeH8z8QjE0GmW1gYU5S9FOnJ0" crossorigin="anonymous"></script>
</head>
<body>
    <center><h1>Practica 5 ingresando datos y consulta bases de datos</h1></center>

    <div class="container">
  <div class="row row-cols-2">
    <div class="col">
        <center><h2>Registrando Datos</h2></center>
        <form action="index.php" method="post">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="id" id="id" placeholder="ID">
                <label for="id">ID</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="nombre" id="nombre" placeholder="Nombre">
                <label for="nombre">Nombre</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="apellido" id="apellido" placeholder="Apellido">
                <label for="apellido">Apellido</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="telefono" id="telefono" placeholder="Telefono">
                <label for="telefono">Telefono</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="correo" id="correo" placeholder="Correo">
                <label for="correo">Correo</label>
            </div>
            <div class="form-floating mb-3">
                <input type="text" class="form-control" name="usuario" id="usuario" placeholder="Usuario">
                <label for="usuario">Usuario</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="contraseña" id="contraseña" placeholder="Contraseña">
                <label for="contraseña">Contraseña</label>
            </div>
            <div class="form-floating mb-3">
                <input type="password" class="form-control" name="contraseña2" id="contraseña2" placeholder="Repita la contraseña">
                <label for="contraseña2">Repita la contraseña</label>
            </div>
            <input type="submit" value="Registrar" class="btn btn-secondary btn-lg" name="btnregistrar">
        </form>
    </div>
    <?php 
        if (isset($_POST['btnregistrar'])) {
            $_id = $_POST['id'];
            $_nombre = $_POST['nombre'];
            $_apellido = $_POST['apellido'];
            $_telefono = $_POST['telefono'];
            $_correo = $_POST['correo'];
            $_usuario = $_POST['usuario'];
            $_contraseña = $_POST['contraseña'];
            $_contraseña2 = $_POST['contraseña2'];

            if ($_contraseña === $_contraseña2) {
                
                include("./clases/conexionopen.php");
                $conexion->query("INSERT INTO $tb1(user, pass) VALUES('$_usuario','$_contraseña')");
                $conexion->query("INSERT INTO $tb2(id, nombre, apellido, telefono, correo, user) 
                VALUES('$_id','$_nombre','$_apellido','$_telefono','$_correo','$_usuario')");
                include("./clases/conexionclose.php");
                echo "Se a Registrado con ¡¡Exito!!";

            }
        }
    ?>
    <div class="col">
        <center><h2>Consultando Datos</h2></center>
        <form action="index.php" method="post">
            <div class="form-floating mb-3">
                    <input type="text" class="form-control" name="id" id="id" placeholder="Ingrese el ID a Buscar">
                    <label for="id">Ingrese el ID a Buscar</label><br>
                    <input type="submit" value="Buscar" class="btn btn-primary btn-lg" name="btnbuscar">
            </div>
        </form>
        <?php 
            if (isset($_POST['btnbuscar'])) {
                $_id = $_POST['id'];

                include("./clases/conexionopen.php");
                    $registros = mysqli_query($conexion, ("SELECT * FROM $tb2 WHERE id = $_id"));
                    
                    while ($consulta = mysqli_fetch_array($registros)) {
                        echo "
                        <table class=\"table table-striped\">
                        <tr>
                        <td><center><b>ID</b></center></td>
                        <td><center><b>Nombre</b></center></td>
                        <td><center><b>Apellido</b></center></td>
                        <td><center><b>Telefono</b></center></td>
                        <td><center><b>Correo</b></center></td>
                        <td><center><b>Usuario</b></center></td>
                        </tr>
                        <td><center>".$consulta['id']."</center></td>
                        <td><center>".$consulta['nombre']."</center></td>
                        <td><center>".$consulta['apellido']."</center></td>
                        <td><center>".$consulta['telefono']."</center></td>
                        <td><center>".$consulta['correo']."</center></td>
                        <td><center>".$consulta['user']."</center></td>
                        </table>
                        ";
                    }

                include("./clases/conexionclose.php");
    

            
            }
        ?>
    </div>
  </div>
</div>
</body>
</html>