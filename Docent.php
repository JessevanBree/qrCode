<?php
//Kijken of waardes numeriek zijn
if (is_numeric($_GET['id'])) {
  //Rond nummer af
  $id = round($_GET['id']);

  //verbinding maken met Database
  include_once("Functions\database.php");

  //Query's decladeren
  $sqlAantalDocent = "SELECT `Naam`, `Beschrijving`, `Leeftijd`, `Afbeeldingspad` FROM `docenten`";
  $sqldocentinfo = "SELECT `Naam`, `Beschrijving`, `Leeftijd`, `Afbeeldingspad` FROM `docenten` WHERE `docentid` =". $id;
  $sqlvakken = "SELECT `vaknaam` FROM vakken JOIN koppeltabel ON vakken.vakid = koppeltabel.vakid WHERE koppeltabel.docid =". $id;

  //Database tellen aantal reccords aantal docenten
  $query = mysql_query($sqlAantalDocent);
  $sqlAantalDocentTeller = mysql_num_rows($query);


  //Als het buiten de waarde is van alle docenten
  if ($id > 0 && $id <= $sqlAantalDocentTeller) {

    //Query's uitvoeren
    $query = mysql_query($sqldocentinfo);
    while ($row = mysql_fetch_assoc($query)){
      //Gegevens laden van docent
      $naam = $row['Naam'];
      $Beschrijving = $row['Beschrijving'];
      $Leeftijd = $row['Leeftijd'];

    }
    //Vakken weergeven
    $query = mysql_query($sqlvakken);
    $Count = mysql_num_rows($query);

  }else {
    header("location: Docent.php?id=1");
  }

}else{
  header("location: Docent.php?id=1");
}
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Docenten informatie</title>
    <link rel="stylesheet" href="Style\Styles.css">

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">

    <!-- Optional theme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">

    <!-- Latest compiled and minified JavaScript -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
  </head>
  <body>
    <nav class="navbar">
      <header>
        <img src="https://www.onderwijsgroepnwh.nl/portal-over-het-bedrijf/home/rocnh_5Flogo.png" alt="schoollogo" class="img-responsive img-rounded">
      </header>

        <div class="row">
          <div class="text-wit border-black">
            <!-- Docentnaam weergeven -->
            <center>
              <h1><?php echo $naam; ?></h1>
            </center>
            <!-- END Docentnaam weergeven -->
          </div>

        </div>
      </nav>
        <hr>
        <div class="container-fluid">
          <article class="">


          <div class="row">
            <h3>


            <div class="col-sm-12 col-lg-8 col-md-8   padding-down">
              <div class="border text-responsive">



                <table border="0" width=100%>
                  <thead>
                    <td colspan=2><center>Docent informatie</center></td>
                  </thead>
                  <tbody>
                    <tr>
                      <td><br></td>
                    </tr>
                    <tr>
                      <td>Leeftijd</td>
                      <td><?php echo $Leeftijd ?></td>
                    </tr>
                    <tr>
                      <td><br></td>
                    </tr>
                    <tr>
                      <td>Vakken</td>
                      <td>
                        <?php
                        //Teller (Voor beter taalgebruik)
                        $Teller = 0;
                        //Laat alle vakken zien die docent geeft
                        while($row = mysql_fetch_assoc($query)){
                            //Eerste komt dit
                            if ($Teller == 0) {
                              echo ($row['vaknaam']);
                            //Laaste komt dit
                            }elseif ($Teller+1 == $Count) {
                              echo (" en ". $row['vaknaam']. ".");
                            //Al het andere
                            }else {
                              echo (" ,". $row['vaknaam']);
                            }
                            $Teller++;
                        }
                        ?>
                      </td>
                    </tr>
                    <tr>
                      <td><br></td>
                    </tr>
                    <tr>
                      <td>favoriete vak</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td><br></td>
                    </tr>
                    <tr>
                      <td>Opleidingen</td>
                      <td></td>
                    </tr>
                    <tr>
                      <td colspan=2><hr></td>
                    </tr>
                    <tr>
                      <td colspan=2 class="border">
                        <?php
                        echo $Beschrijving;
                        ?>
                      </td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>


            <div class="col-lg-4 col-sm-12 col-md-4" >
              <div class=" profilepicture">
                <center>
                  <img src="http://vignette2.wikia.nocookie.net/naginoasukara/images/8/86/Placeholder_person.png/revision/latest?cb=20130924151342" alt="Afbeelding docent" class="img-responsive">
                </center>
              </div>

            </div>
          </div>
        </div>

      </h3>

    </article>
  </body>
</html>
