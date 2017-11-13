<?php

namespace Radarai;

use Mysqli;


/**
 * 
 */
class DateMethods extends Radar
{
    
//############################# ONLY AUTO, NUMBER SPEED ########################################################
    function onlyAutos($whichMenu, $page = 0)
{

$sql = "SELECT number, ROUND(MAX(distance/time), 2) AS speed, COUNT(number) AS entryCount
        FROM radars
        GROUP BY number
        ORDER BY speed DESC
        LIMIT 4 OFFSET $page;";


                $result = $this->dbLogin->query($sql);

                $this->dataCount = $result->num_rows;

                    if ($result->num_rows > 0):
            ?>
        <table bgcolor="lightgray" border="1px" style="border: 2px solid black;">
                <caption>Auto numeriai</caption>
                        <tr>
                            <th>Numeris</th>
                            <th>Irasu skaicius</th>
                            <th>MAX Greitis</th>
                        </tr>
                        <?php


                            while($row = $result->fetch_assoc()) {
                                    echo "<tr><td>{$row['number']}";
                                    echo "</td><td>{$row['entryCount']}";
                                    echo "</td><td>{$row['speed']}</td>";


                            }



                            echo '</table>';
                            echo $whichMenu, $page, $monthCheck;
                            $this->navigate($page, $whichMenu);
                    else:
                        echo 'nėra duomenų';
                    endif;               
}


//########################### MONTH DRIVER ######################################
function monthAuto($monthCheck, $whichMenu, $page = 0)
{
echo $monthCheck;
$sql ="SELECT MONTH(date) AS Month, number,COUNT(number) AS umount, ROUND(MAX(distance/time), 2) AS Maximum, ROUND(MIN(distance/time), 2) AS Minimum, ROUND(AVG(distance/time), 2) AS Averige
        FROM radars
        GROUP BY number
        HAVING Month= $monthCheck
        ORDER BY number DESC
        LIMIT 4 OFFSET $page;";

                      $result = $this->dbLogin->query($sql);

                $this->dataCount = $result->num_rows;

                    if ($result->num_rows > 0):
            ?>
        <table bgcolor="lightgray" border="1px" style="border: 2px solid black;">
                <caption>Auto numeriaipagal menesi</caption>
                        <tr>
                            <th>Numeris</th>
                            <th>Menuo</th>
                            <th>kiekis</th>
                            <th>max</th>
                            <th>min</th>
                            <th>Av</th>
                        </tr>
                        <?php


                            while($row = $result->fetch_assoc()) {
                                    echo "<tr><td>{$row['number']}";
                                    echo "</td><td>{$row['Month']}";
                                    echo "</td><td>{$row['umount']}</td>";
                                    echo "<td>{$row['Maximum']}";
                                    echo "</td><td>{$row['Minimum']}";
                                    echo "</td><td>{$row['Averige']}</td><tr>";

                            }



                            echo '</table>';
                            $this->navigate($page, $whichMenu);
                    else:
                        echo 'nėra duomenų';
                    endif;   

}


//################################# YEAR ##################################

function yearAuto($year, $whichMenu, $page = 0)
{

echo $year;

$sql ="SELECT YEAR(date) AS Monthly, number,COUNT(number) AS umount, ROUND(MAX(distance/time), 2) AS Maximum, ROUND(MIN(distance/time), 2) AS Minimum, ROUND(AVG(distance/time), 2) AS Averige
        FROM radars
        GROUP BY number
        HAVING Monthly = $year
        ORDER BY number DESC
        LIMIT 4 OFFSET $page;";

                      $result = $this->dbLogin->query($sql);

                $this->dataCount = $result->num_rows;

                    if ($result->num_rows > 0):
            ?>
        <table bgcolor="lightgray" border="1px" style="border: 2px solid black;">
                <caption>Auto numeriai pagal metus</caption>
                        <tr>
                            <th>Numeris</th>
                            <th>Metai</th>
                            <th>kiekis</th>
                            <th>max</th>
                            <th>min</th>
                            <th>Av</th>
                        </tr>
                        <?php


                            while($row = $result->fetch_assoc()) {
                                    echo "<tr><td>{$row['number']}";
                                    echo "</td><td>{$row['Monthly']}";
                                    echo "</td><td>{$row['umount']}</td>";
                                    echo "<td>{$row['Maximum']}";
                                    echo "</td><td>{$row['Minimum']}";
                                    echo "</td><td>{$row['Averige']}</td><tr>";

                            }



                            echo '</table>';
                            
                            $this->navigate($page, $whichMenu);
                    else:
                        echo 'nėra duomenų';
                    endif;   

}

}


function basicList()
{

    $klass =new Radar();

//#################### IRASO TRINIMAS #########################33
    if (isset($_POST['delete'])) {

        $klass->deleteEntry($_POST['delete']);
        }


//xxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxxx WALKING THROUGHT PAGES, GET OFFSET xxxxxxxxxxxxxxxxxxxxx

if (isset($_GET['offset'])) {
    $offset = addslashes($_GET['offset']);//negalimi simboliai
} else {
    $offset = 0;
}
 $offset = abs(intval($offset));//gaunamas teigiamas integer skaicius


//############################ IRASO PRIDEJIMAS ###############################################3 
?>


<?php

    if (isset($_GET['add'])) {//gaunama forma

        $klass->repairEntry();


    }

    if (isset($_POST['addEntry'])){ //saugojami duomenys


        $klass->addEntry($_POST['date'], $_POST['number'], $_POST['distance'], $_POST['time']);
        header("Location: {$_SERVER['SCRIPT_NAME']}");
    }



//####################### EDITING INFO ###############################

        if (isset($_POST['editEntry'])): //gaunama forma

        echo $klass->updateEntry($_POST['date'], $_POST['number'], $_POST['distance'], $_POST['time'], $_POST['id']);

        endif;


        if (isset($_POST['repare'])):// taisomi duomenys

            $numbRep = $_POST['repare'];

        $klass->repairEntry($numbRep);

        endif;


//###################### SHOW TABLE, NAVIGATION ###############################3

 $klass->getItems($offset); //show entries
echo $klass->navigate($offset);//navigation menu

}
?>