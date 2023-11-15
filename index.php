<!-- Instruktion til webbrowser om at vi kører HTML5 -->
<!DOCTYPE html>

<!-- html starter og slutter hele dokumentet / lang=da: Fortæller siden er på dansk -->
<html lang="da">

<!-- I <head> har man opsætning - det ser brugeren ikke, men det fortæller noget om siden -->
<head>
    <!-- Sætter tegnsætning til utf-8 som bl.a. tillader danske bogstaver -->
    <meta charset="utf-8">

    <!-- Titel som ses oppe i browserens tab mv. -->
    <title>Zeeker - Koder</title>
    <meta name="description" content="Koder til Zeeker kunder">


    <!-- Metatags der fortæller at søgemaskiner er velkomne, hvem der udgiver siden og copyright information -->
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <?php include "include/head.php"; ?>

    <!-- Sikrer den vises korrekt på mobil, tablet mv. ved at tage ift. skærmstørrelse - bliver brugt til responsive websider -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<!-- i <body> har man alt indhold på siden som brugeren kan se -->
<body>

<?php include "include/navigation.php"; ?>

<!-- Her skal sidens indhold ligge -->
<!-- Header Sektion --------------------------------------------------------------------------------------------------->
<div class="hero text-white pt-lg-1">
    <div class="container-fluid p-lg-5 imageOverlay vh-100" style="background-image: url('images/zeeker.webp'); background-size: cover; background-repeat: no-repeat; background-position:top ; background-attachment: fixed">
        <div class="row align-items-center flex-md-row-reverse pt-2 p-md-5">
            <div class="col-md-6 d-flex justify-content-center">
                <!-- <img src="images/bogtest.webp" alt="Billede" class="img-fluid pt-5 pt-lg-0">  -->
            </div>
            <div class="col-md-6 ps-md-5 text-center align-self-start align-self-md-center text-md-start pb-5 pt-4 pt-lg-0">
                <h1 class="ps-md-4">Rabatkoder</h1>
                <p class="lead ps-md-4">Her kan du oprette unikke koder og ønsker du at redigere en kode, <br>så find koden via oversigten.</p>
                <div class="ps-md-4 pt-lg-3">
                    <a href="insert.php" class="btn btn-success btn-lg border-white text-white me-2 ">Opret ny kode</a>
                </div>
            </div>
        </div>
    </div>
</div>






<?php include "include/footer.php"; ?>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>


</body>
</html>


