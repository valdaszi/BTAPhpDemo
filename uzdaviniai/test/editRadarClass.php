<?php

namespace Radarai;

use Mysqli;

class Radar
{

protected $dbLogin;// prisijungimas prie RDBMS
public $dataCount;


function __construct()
{
        $servername = 'localhost';
        $dbname = 'Auto';
        $username = 'Auto';
        $password = 'LabaiSlaptas123';

        // Create connection
        $dbLogin = new mysqli($servername, $username, $password, $dbname);
        
        if ($dbLogin->connect_error) die('Nepavyko prisjungti: ' . $dbLogin->connect_error);

        $this->dbLogin = $dbLogin;
}

function __destruct()
{

$this->dbLogin->close();
}

//############################# DUOMENU VAIZDAVIMAS ##################################
function getItems($offset)
{
        $sql = "SELECT id, `number`, ROUND(distance/time, 2) as `speed`, `date` 
                FROM radars 
                ORDER BY `number`, `date` DESC 
                LIMIT 4 OFFSET $offset";

                $result = $this->dbLogin->query($sql);

                $this->dataCount = $result->num_rows;

                    if ($result->num_rows > 0):
            ?>
        <table bgcolor="lightgray" border="1px" style="border: 2px solid black;">
                <caption>Auto numeriai</caption>
                        <tr>
                            <th>Numeris</th>
                            <th>Data</th>
                            <th>Greitis</th>
                            <th>Taisyti</th>
                        </tr>
                        <?php


                            while($row = $result->fetch_assoc()) {
                                    echo "<tr><td>{$row['number']}";
                                    echo "</td><td>{$row['date']}";
                                    echo "</td><td>{$row['speed']}</td>";
                                    echo '<td><form action='. $_SERVER["SCRIPT_NAME"] .' method="post">';
                                    echo "<button name='repare' value='{$row['id']}'>Taisyti</button>";
                                    echo "<button name='delete' value='{$row['id']}'>Trinti</button></form></td></tr>";

                            }



                            echo '</table>';
                    else:
                        echo 'nėra duomenų';
                    endif;               
    return 'funkcija veikia';
//    return $duomArr;

}
//########################## RETURN ARRAY OF VALUES ############################

function getTables($offset, $whichData ='')
{
            $sql = "SELECT id, `number`, `distance`/`time` as `speed`, `date` 
                FROM radars 
                ORDER BY `number`, `date` DESC 
                LIMIT 4 OFFSET $offset";

                $result = $this->dbLogin->query($sql);

                $this->dataCount = $result->num_rows;
}

//############################### MENU BACKWARDS, FORWARDS #######################################
function navigate($index, $menuFor ='list')
{

    ?><form action='<?= $_SERVER['HTTP_REFERER'] ?>' method='get'>
                    <input type="hidden" name="menu" value="<?=$menuFor?>">

    <?php
        if($index>=4):
        $back = $index -4;
            echo "<button name='offset' value='{$back}'>Atgal</button>";      
        endif;
        if($this->dataCount>=4):
            $further = $index+4;
            echo "<button name='offset' value='{$further}'>Pirmyn</button>";
        endif;

    echo '</form>';
}

//########################## SUBMIT UPDATED ENTRy #########################################
function updateEntry($data, $number, $distance, $time, $id)
{

        $updateStm="UPDATE radars
                    Set date = ?, number = ?, distance = ?, time = ?
                    WHERE id=? ;";

        $stmt = $this->dbLogin->prepare($updateStm);

        $stmt->bind_param('ssssi', $data, $number, $distance, $time, $id);

        $stmt->execute();
        $stmt->close();
        return '<b>Irasas pakeistas</b>';
}

//################## ADD AND EDIT FORM ########################################
function repairEntry($autNumb ='#')
{       
    
    if ($autNumb != '#') {
        $ats= $this->dbLogin->query("SELECT id, date, number, distance, time FROM radars WHERE id='$autNumb';");

        $ats2 = $ats->fetch_array();

        $addMethod ='editEntry';
        } else {
            $addMethod = 'addEntry';
        }
        ?>
           <form action="<?= $_SERVER['SCRIPT_NAME'] ?>" method='post'>
            <input type='hidden' name="<?=$addMethod?>" value='addEdit' >
            <input type='hidden' name='id' value='<?= $ats2['id'] ?>' >
            Data :<input type='text' name='date' value="<?= $ats2['date']?>" required><br>
            Auto nr.<input type='text' name='number' value="<?= $ats2['number'] ?>" required><br>
            Atstumas m/s<input type='number' name='distance' value="<?= $ats2['distance'] ?>" required><br>
            Laikas:<input type='number' name='time' value='<?= $ats2['time'] ?>' required><br>
            <input type='submit' value='Issaugoti'>
            </form>
           
        <?php
}

//############################### SUBMIT ADD'ed ENTRy ###############################################
function addEntry($data, $number, $distance, $time){

    $sql ="INSERT INTO radars(date, number, distance, time)
            VALUES (?, ?, ?, ?);";

            $stmt = $this->dbLogin->prepare($sql);

        $stmt->bind_param('ssss', $data, $number, $distance, $time);

        $stmt->execute();
        $stmt->close();
        return '<b>Irasas pakeistas</b>';
}


//############################### DELETE ENTRIES ###############################################
function deleteEntry(int $delRecord)
{


   // echo "trinamas irasas: ".$delRecord;
    
$deletSql = "DELETE FROM radars WHERE id=?";


            $stmt = $this->dbLogin->prepare($deletSql);

        $stmt->bind_param('i', $delRecord);

        $stmt->execute();
        $stmt->close();
        return "<b>Irasas istrintas{$delRecord}</b>";


}



}


?>