<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Foro</title>
    <!-- jQuery -->
    <script src="views/static/js/jquery-3.5.1.min.js"></script>
    <!-- Bootswatch LUX -->
    <link type="text/css" rel="stylesheet" href="views\static\bootswatch\bootswatch-lux.css">
    <!-- bootstrap-4.5.0-dist 
    <link type="text/css" rel="stylesheet" href="views\static\bootstrap\css\bootstrap.min.css">-->
    <script type="text/javascript" src="views\static\bootstrap\js\bootstrap.min.js"></script>
    <script src="views\static\bootstrap\js\bootstrap.bundle.min.js"></script>
    <!-- fontawesome-free-5.13.1-web -->
    <link rel="stylesheet" href="views/static/fontawesome/css/all.css">
    <script src="views/static/fontawesome/js/all.js"></script>
    <!-- DataTables-1.10.21 -->
    <link rel="stylesheet" href="views/static/datatables/datatables.min.css">
    <script src="views/static/datatables/datatables.min.js"></script>
    <!-- fullcalendar-5.1.0 -->
    <link rel="stylesheet" href="views\static\fullcalendar\css\fullcalendar.css">
    <script src="views\static\fullcalendar\js\moment.min.js"></script>
    <script src="views\static\fullcalendar\js\fullcalendar.js"></script>
    <script src="views\static\fullcalendar\js\es.js"></script>
    <!-- Alertify JS 1.13.1 -->
    <link rel="stylesheet" href="views\static\alertify\css\alertify.css">
    <link rel="stylesheet" href="views\static\alertify\css\themes\default.css">
    <script src="views\static\alertify\js\alertify.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="views/static/css/main.css">
</head>

<body id="cuerpo">
    <?php
    require_once "./drivers/viewsDriver.php";
    $vt = new viewsDriver();
    $vistasR = $vt->obtenerVistasControlador();
    if ($vistasR == "welcome") {
        require_once "./views/templates/welcome.php";
    ?>
        <script>
            document.getElementById('cuerpo').style.cssText = 'overflow: hidden;height:100vh;';
        </script>
    <?php
    } else {
        require_once $vistasR;
    }
    ?>
</body>

</html>