<!-- Instruktion til webbrowser om at vi kører HTML5 -->
<!DOCTYPE html>

<!-- html starter og slutter hele dokumentet / lang=da: Fortæller siden er på dansk -->
<html lang="da">

<!-- I <head> har man opsætning - det ser brugeren ikke, men det fortæller noget om siden -->
<head>
    <!-- Sætter tegnsætning til utf-8 som bl.a. tillader danske bogstaver -->
    <meta charset="utf-8">

    <!-- Titel som ses oppe i browserens tab mv. -->
    <title>Kode oversigt</title>
    <meta name="description" content="Zeeker Kundeoversigt">


    <!-- Metatags der fortæller at søgemaskiner er velkomne, hvem der udgiver siden og copyright information -->
    <meta name="robots" content="All">
    <meta name="author" content="Udgiver">
    <meta name="copyright" content="Information om copyright">

    <?php include "include/head.php"; ?>

    <!-- Sikrer den vises korrekt på mobil, tablet mv. ved at tage ift. skærmstørrelse - bliver brugt til responsive websider -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
</head>

<!-- i <body> har man alt indhold på siden som brugeren kan se -->
<body class="bg-light">

<?php include "include/navigation.php"; ?>

<!-- Her skal sidens indhold ligge -->


<div class="container-fluid p-5 imageOverlay min-vh-100" style="background-image: url('images/zeeker.webp'); background-size: cover; background-repeat: no-repeat; background-position:bottom; background-attachment: fixed ">
    <div class="pb-5 pb-lg-0 px-lg-5">
        <div class="bogtabel pb-5 p-md-5">
            <div class="filter pt-3 py-lg-5">
                <div class="row">
                    <h1 class="text-primary text-center">Kode Oversigt</h1>
                    <div class="col-md-4 offset-md-4 pt-5 pt-md-0">
                        <input type="search" class="form-control nameSearch" placeholder="Søg på Unik kode, Kode navn eller CVR/SE nr.">
                    </div>
                </div>
            </div>

            <div class="items px-lg-4 pb-5">
                <!-- Her vises produkterne -->
            </div>
        </div>
    </div>
</div>



<?php include "include/footer.php"; ?>

<script src="node_modules/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script type="module">
    import BogTabel from "./js/oversigttabel.js";

    const bogtabel = new BogTabel();
    bogtabel.init();

</script>
</body>
</html>

