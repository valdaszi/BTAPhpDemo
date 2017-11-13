<?php
namespace Radarai;

use Mysqli;

include_once 'editRadarClass.php';
include_once 'editRadarClass2.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Edit entries.</title>
        <meta charset="UTF-8">
    </head>
<body style="margin-left:20%">
<!-- ############################# MENIU SARASAS, PASIRINKIMAI ##################################-->
            <form action="editRadar.php" method="get">
                <button name='menu' value='sarasas'>Sarasas</button>
                <button name='menu' value='autos'>Automobiliai</button>
                <button name='menu' value='menuo'>Menuo</button>
                <button name='menu' value='metai'>Metai</button>
                <button name='add' value='addEntry'>Prideti irasa</button>           
            </form>

<?php 
//var_dump($_REQUEST);


    $klass2 =new DateMethods();

if ($_GET['menu']=='autos') {
    

            (isset($_GET['offset']))? $offset=$_GET['offset'] :$offset=0;
            $valForMenu = $_GET['menu'];

     $klass2->onlyAutos($valForMenu, $offset);


    } elseif ($_GET['menu']=='menuo') {
    
    ?><form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method="get">
                <input type="hidden" name="menu" value="menuo">
            <input type="number" name="cntMonth" maxlength="2">
            <input type="submit" value"Pasirinkti menesi" >   
        </form>
        <?php
        (isset($_GET['cntMonth']))? $menuo = $_GET['cntMonth']: $menuo=5;

            (isset($_GET['offset']))? $offset=$_GET['offset'] :$offset=0;
            $valForMenu = $_GET['menu'];

        $klass2->monthAuto($menuo, $valForMenu, $offset);
    
    } elseif ($_GET['menu']=='metai' ) {
    
    ?><form action="editRadar.php" method="get">
            <input type="hidden" name="menu" value="metai">
            <input type="number" name="metai" maxlength="4">
            <input type="submit" value"Pasirinkti metus" >   
        </form>
<?php
 (isset($_GET['metai']))? $metai = $_GET['metai']: $metai=2017;

             (isset($_GET['offset']))? $offset=$_GET['offset'] :$offset=0;
            $valForMenu = $_GET['menu'];


    $klass2->yearAuto($metai, $valForMenu, $offset);

} else {

basicList();

}




?>
</body>
</html>