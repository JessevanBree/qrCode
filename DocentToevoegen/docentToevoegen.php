<?php
    //Verbinding maken met de datababase
    include_once("DB.php");
    include_once ("FotoUp.php");
?>

<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="icon" href="../Afbeeldingen/login.png">

        <title>Docent Toevoegen</title>

        <!-- Bootstrap core CSS -->
        <link href="Bootstrap/css/bootstrap.css" rel="stylesheet">
        <link href="style.css" rel="stylesheet">
    </head>

    <body>
    <nav class="navbar navbar-default">
        <div class="container-fluid">
            <!-- Brand and toggle get grouped for better mobile display -->
            <div class="navbar-header">
                <a class="navbar-brand" href="#">QR-Code</a>
                <p class="navbar-text">Docent toevoegen</p>
            </div>
        </div>
    </nav>

    <form action="" method="post">
        <div class="col-md-3 col-md-offset-1">
            <label for="Naam Docent">Naam Docent:</label>
                <input type="text" name="naamDocent" placeholder="Naam Docent" class="form-control" value="<?php echo isset($_POST['naamDocent']) ? $_POST['naamDocent'] : '' ?>">
            <label for="Leeftijd">Leeftijd:</label>
                <input type="number" name="leeftijd" placeholder="Leeftijd" class="form-control" min="0" max="99" value="<?php echo isset($_POST['leeftijd']) ? $_POST['leeftijd'] : '' ?>">
            <label for="vak">Lesvak:</label>
                <select class="form-control" name="lesVak">
                    <?php
                    //Maakt een query om de vakken op te halen
                    $sqliLesVak = "SELECT vakid,vaknaam FROM vakken";
                    $sqliLesVakUitkomst = mysqli_query($connectie, $sqliLesVak);

                    echo "<option value='0'>Lesvak</option>";

                    while($row = mysqli_fetch_array($sqliLesVakUitkomst)){
                        echo "<option value='" . $row["vakid"] . "'>" . $row["vaknaam"] . "</option>";
                    }
                    ?>
                </select>
        </div>

        <div class="col-md-3">
            <label for="Opleiding">Opleiding:</label>
                <input type="text" name="opleiding" placeholder="Opleiding" class="form-control" value="<?php echo isset($_POST['opleiding']) ? $_POST['opleiding'] : '' ?>" >
            <label for="Favoriete vak">Favoriete vak:</label>
                <select class="form-control" name="favvak">
                    <?php
                    //Maakt een query om de vakken op te halen uit de database
                    $sqliFavVak = "SELECT vakid,vaknaam FROM vakken";
                    $sqliFavVakUitkomst = mysqli_query($connectie, $sqliFavVak);

                    echo "<option value='0'>Favoriete vak</option>";

                    while($row = mysqli_fetch_array($sqliFavVakUitkomst)){
                        echo "<option value='" . $row["vakid"] . "'>" . $row["vaknaam"] . "</option>";
                    }
                    ?>
                </select>
            <label for="FotoUploaden:">Foto uploaden:</label></br>
                <input type="file" naam="FotoUp" placeholder="Uploaden" value="fotoUploaden" class="btn btn-primary">
        </div>

        <div class="col-md-3">
            <label for="beschrijving">beschrijving:</label>
                <textarea name="beschrijving" class="form-control" rows="5" id="comment"></textarea>
        </div>

        </br>
        <input class="col-md-offset-2  btn-verzend btn btn-default btn-verzend" type="submit" value="submit" name="submit">
    </form>
    <?php
    if (isset($_POST["submit"])){
        if (isset($_POST["naamDocent"]) && ($_POST["leeftijd"]) && ($_POST["FotoUp"]) && ($_POST["lesVak"]) && ($_POST["opleiding"]) && ($_POST["favvak"]) && ($_POST["beschrijving"])){
            $sqlDocentToevoegen = "INSERT INTO docenten (docentid, Naam, Opleiding, Beschrijving, Leeftijd, Afbeeldingspad) VALUES (DEFAULT, '".$_POST["naamDocent"]."', '".$_POST["opleiding"]."', '".$_POST["beschrijving"]."', '".$_POST["leeftijd"]."', '".$_POST["FotoUp"]."')";
            mysqli_query($connectie, $sqlDocentToevoegen);

            $sqlDocentOphalen = "SELECT docentid FROM `docenten` WHERE 'Naam'='".$_POST["naamDocent"]."'";
            $sqliDocentID = mysqli_query($connectie, $sqlDocentOphalen);
            $row = mysqli_fetch_array($sqliDocentID);
            $sqliFavVakInvoegen = "INSERT INTO fav_vak (docid, vakid) VALUES ('".$row["docentid"]."', '".$_POST["favvak"]."')";
            $sqliLesVakInv = "INSERT INTO lesvak (docid, vakid) VALUES  ('".$row["docentid"]."', '".$_POST["lesVak"]."')";
            if(mysqli_query($connectie, $sqliFavVakInvoegen) /*&& mysqli_query($connectie, $sqliLesVakInv)*/)
            {
                echo "<h4 class='text-center'>er is iets goed gegaan</h4>";
            }
            else {
                echo "<h4 class='text-center'>er is iets fout gegaan</h4>";
            }
       }
        else {
            echo "<h4 class='text-center'>Niet alle invulvakken zijn ingevuld</h4>";
        }
    }
    ?>

        <div class="footer navbar-fixed-bottom">
            Docent informatie 2016.
            </br>
            &copy; Koen van Kralingen, Paul Backs, Mike de Decker en Jesse van Bree.
        </div>
    </body>
</html>

