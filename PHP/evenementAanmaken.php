<?php
require_once "scripts/connect.php";



if (isset($_POST['E_NAAM'])) {
    $e_sql = 'EXEC dbo.usp_Evenement_Insert @EVENEMENT_NAAM = \'' . $_POST['E_NAAM'] . '\', @EVENEMENT_DATUM = \'' . $_POST['E_DATUM'] . '\', @LOCATIENAAM = \'' . $_POST['LOCATIENAAM'] . '\', @PLAATSNAAM = \'' . $_POST['PLAATSNAAM'] . '\', ' . '@ADRES = \'' . $_POST['ADRES'] . '\', @HUISNUMMER = ' . $_POST['HUISNUMMER'].', @HUISNUMMER_TOEVOEGING = \'' . $_POST['HUISNUMMER_TOEVOEGING'].'\'';

    echo $e_sql;
    $e_query = $conn->prepare($e_sql);
    $e_query->execute();

    $error = $e_query->errorCode();
    if (empty($error) || 00000 == $error){
        header("Location:evenement.php?beheerder=1&result=evenementaddsuccess");
    }
    else {
        header("Location:evenement.php?beheerder=1&result=evenementadderror");
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<?php
$titel = 'Aanmaken Evenement';
include_once "header.php";
?>

<body>
<!-- container section start -->
<section id="container" class="">
    <!--header start-->
    <header class="header dark-bg" style="border-bottom: none;">
        <div class="toggle-nav">
            <button id="openNav" onclick="w3_open()" style="background-color: rgba(0,0,0,0.0000001); border-color: rgba(0,0,0,0.0000001);color: whitesmoke;">
                <!-- de kleur voor de headerbackground = rgba(0,0,0,0.0000001)-->
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="icon_menu" style="font-size: 40px;                         margin-top: 0px;"></i></div>
            </button>
            <button id="closeNav" onclick="w3_close()" style="display: none; background-color: rgba(0,0,0,0.0000001); border-color: rgba(0,0,0,0.0000001);color: whitesmoke;">
                <div class="icon-reorder tooltips" data-original-title="Toggle Navigation" data-placement="bottom"><i class="arrow_left_alt" style="font-size: 40px;                         margin-top: 0px;"></i></div>
            </button>
        </div>

    </header>
    <!--header end-->

    <!--sidebar start-->
    <?php
    include_once "sidebar.php";
    ?>
    <!--sidebar end-->
    <div class="w3-overlay w3-animate-opacity" onclick="w3_close()" style="cursor:pointer" id="myOverlay"></div>
    <!--main content start-->
    <section id="main-content" style="margin-right: 10%;">
        <section class="wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <!--
                    <ol class="breadcrumb">
                        <li><i class="fa fa-home"></i><a href="index.php">Home</a></li>
                        <li><i class="fa fa-bars"></i>Pages</li>
                        <li><i class="fa fa-square-o"></i>Pages</li>
                    </ol>
                    Hierboven staat een breadcrumb, moeilijk te implementeren. Voor nu nog disabled
                    -->
                </div>
            </div>

            <!-- page start-->

            <div id="main">
                <div class="w3-container">
                    <h1 style="margin-left: 17px;">Evenement toevoegen</h1>
                    <p style="margin-left: 16px;">Via onderstaand formulier kan een evenement worden aangemaakt</p>
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Evenement aanmaken
                            </header>
                            <div class="panel-body">
                                <form method="POST" action="" role="form">
                                    <div class="form-group">
                                        <label for="E_NAAM">Evenementnaam</label>
                                        <input type="text" class="form-control" id="E_NAAM" name="E_NAAM" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="E_DATUM">Evenementdatum</label>
                                        <input type="date" class="form-control" id="E_DATUM_" name="E_DATUM" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="LOCATIENAAM">Locatie</label>
                                        <input type="text" class="form-control" id="LOCATIENAAM" name="LOCATIENAAM">
                                    </div>
                                    <div class="form-group">
                                        <label for="PLAATSNAAM">Plaats</label>
                                        <input type="text" class="form-control" id="PLAATSNAAM" name="PLAATSNAAM" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ADRES">Adres</label>
                                        <input type="text" class="form-control" id="ADRES" name="ADRES" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="HUISNUMMER">Huisnummer</label>
                                        <input type="number" class="form-control" id="HUISNUMMER" name="HUISNUMMER" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="HUISNUMMER_TOEVOEGING">Huisnummer toevoeging</label>
                                        <input type="text" class="form-control" id="HUISNUMMER_TOEVOEGING" name="HUISNUMMER_TOEVOEGING">
                                    </div>
                                    <button type="submit" class="btn btn-primary">Aanmaken</button>
                                    <a class="btn btn-danger" href="evenement.php?beheerder=1">Annuleer</a>
                                </form>

                            </div>
                        </section>
                    </div>
                </div>
            </div>
            <!-- page end-->
        </section>
    </section>
    <!--main content end-->
    <div class="text-right">
        <div class="credits">

        </div>
    </div>
</section>

</body>

</html>

