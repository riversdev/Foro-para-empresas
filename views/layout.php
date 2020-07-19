<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro</title>
    <!-- jQuery -->
    <script src="views/static/js/jquery-3.5.1.min.js"></script>
    <!-- bootstrap-4.5.0-dist -->
    <link type="text/css" rel="stylesheet" href="views\static\bootstrap\css\bootstrap.min.css">
    <script type="text/javascript" src="views\static\bootstrap\js\bootstrap.min.js"></script>
    <!-- fontawesome-free-5.13.1-web -->
    <link rel="stylesheet" href="views/static/fontawesome/css/all.css">
    <script src="views/static/fontawesome/js/all.js"></script>
    <!-- DataTables-1.10.21 -->
    <link rel="stylesheet" href="views/static/datatables/datatables.min.css">
    <script src="views/static/datatables/datatables.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="views/static/css/main.css">
    <!-- Custom JS -->
    <script src="views/static/js/main.js"></script>
</head>

<body id="cuerpo">
    <?php
    require_once "./drivers/viewsDriver.php";
    $vt = new viewsDriver();
    $vistasR = $vt->obtenerVistasControlador();
    if ($vistasR == "welcome") {
        require_once "./views/templates/welcome.php";
    } else {
    ?>
        <script>
            document.getElementById('cuerpo').style.cssText = 'overflow-y: hidden;';
        </script>
        <!-- Vista solicitada -->
        <?php require_once $vistasR; ?>
    <?php
    }
    ?>

    <!-- VUE ALL -->
    <script src="views\static\js\vue\vue.js"></script>
    <script src="views\static\js\vue\vuex.js"></script>
    <script src="views\static\js\vue\vue-router.js"></script>
    <script src="views\static\js\vue\main.js"></script>
</body>

</html>