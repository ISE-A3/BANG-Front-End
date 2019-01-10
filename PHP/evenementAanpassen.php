<?php

require_once "scripts/connect.php";

if (isset($_GET['evenement'])) {
    $evenement = $_GET['evenement'];
    $e_sql = "EXEC dbo.usp_Evenement_Select @EVENEMENT_NAAM = '$evenement'";
    $e_query = $conn->prepare($e_sql);
    $e_query->execute();
    $e_row = $e_query->fetch(PDO::FETCH_ASSOC);
    $e_naam = $e_row['EVENEMENT_NAAM'];
    $e_pubquiz = $e_row["PUBQUIZ_TITEL"];
    $e_naam_url = urlencode($e_naam);
    $e_datum = $e_row["EVENEMENT_DATUM"];
    $e_locatie = $e_row["LOCATIENAAM"];
    $e_plaats = $e_row["PLAATSNAAM"];
    $e_adres = $e_row["ADRES"];
    $e_huisnummer = $e_row["HUISNUMMER"];
    $e_huisnummer_toevoeging = $e_row["HUISNUMMER_TOEVOEGING"];
    $startdatum = $e_row["STARTDATUM"];
    $einddatum = $e_row["EINDDATUM"];
} else {
    $e_naam = NULL;
    $e_pubquiz = NULL;
    $e_datum = NULL;
    $e_locatie = NULL;
    $e_plaats = NULL;
    $e_adres = NULL;
    $e_huisnummer = NULL;
    $e_huisnummer_toevoeging = NULL;
    $startdatum = NULL;
    $einddatum = NULL;
}


if (isset($_POST['update'])){
    $evenementnaam = $_POST['E_NAAM'];
    $datum = $_POST['E_DATUM'];
    $locatie = $_POST['LOCATIENAAM'];
    $plaats = $_POST['PLAATSNAAM'];
    $adres = $_POST['ADRES'];
    $huisnummer = $_POST['HUISNUMMER'];
    $huisnummer_toevoeging = $_POST["HUISNUMMER_TOEVOEGING"]; 
    $e_sql = "EXEC usp_Evenement_Update @OLD_EVENEMENT_NAAM = '$e_naam', @NEW_EVENEMENT_NAAM = '$evenementnaam', @EVENEMENT_DATUM = '$datum', @LOCATIENAAM = '$locatie', @PLAATSNAAM = '$plaats', @ADRES = '$adres', @HUISNUMMER = $huisnummer".', @HUISNUMMER_TOEVOEGING = \'' . $_POST['HUISNUMMER_TOEVOEGING'].'\'';
    $e_query = $conn->prepare($e_sql);
    $e_query->execute();

    header('location: evenement.php?m=aangepast');
}


?>
<!DOCTYPE html>
<html lang="en">

<?php
$titel = 'Aanpassen Evenement';
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
                    <h1 style="margin-left: 17px;">Evenement aanpassen</h1>
                    <p style="margin-left: 16px; width:45%;">Geef hieronder de gegevens die gewijzigd moeten worden. Alle velden dienen ingevuld te worden</p>
                    <div class="col-lg-6">
                        <section class="panel">
                            <header class="panel-heading">
                                Evenement aanpassen
                            </header>
                            <div class="panel-body">
                                <form method="POST" action="" role="form">
                                    <div class="form-group">
                                        <label for="E_NAAM">Evenementnaam</label>
                                        <input type="text" class="form-control" id="E_NAAM" name="E_NAAM" value='<?php echo $e_naam;?>' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="E_DATUM">Evenementdatum</label>
                                        <input type="date" class="form-control" id="E_DATUM_" name="E_DATUM" value='<?php echo $e_datum;?>' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="LOCATIENAAM">Locatie</label>
                                        <input type="text" class="form-control" id="LOCATIENAAM" name="LOCATIENAAM" value='<?php echo $e_locatie;?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="PLAATSNAAM">Plaats</label>
                                        <input type="text" class="form-control" id="PLAATSNAAM" name="PLAATSNAAM" value='<?php echo $e_plaats;?>' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="ADRES">Straat</label>
                                        <input type="text" class="form-control" id="ADRES" name="ADRES" value='<?php echo $e_adres;?>' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="HUISNUMMER">Huisnummer</label>
                                        <input type="number" class="form-control" id="HUISNUMMER" name="HUISNUMMER" value='<?php echo $e_huisnummer;?>' required>
                                    </div>
                                    <div class="form-group">
                                        <label for="HUISNUMMER_TOEVOEGING">Huisnummer toevoeging</label>
                                        <input type="text" class="form-control" id="HUISNUMMER_TOEVOEGING" name="HUISNUMMER_TOEVOEGING" value='<?php echo $e_huisnummer_toevoeging;?>'>
                                    </div>
                                    <div class="form-group">
                                        <label for="HUISNUMMER_TOEVOEGING">Toevoeging</label>
                                        <input type="text" class="form-control" id="HUISNUMMER_TOEVOEGING" name="HUISNUMMER_TOEVOEGING" placeholder='<?php echo $e_huisnummer_tv;?>'>
                                    </div>
                                    <button type="submit" name="update" class="btn btn-primary">Aanpassen</button>
                                    <a class="btn btn-danger" href="evenement.php">Annuleer</a>
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

