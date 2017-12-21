<!DOCTYPE html>
<html>
    <head>
        <title>Demo</title>
    </head>
    <body>
        <?php
            $a = 'Vienas';
            $$a = 'Du';
            echo $a.' '.$Vienas;
            
            echo '<hr>';

            //echo "${a}1";

            $a = 'Labas rytas';
            $$a = 'vakaras';
            echo ${'Labas' . ' ' . 'rytas'};

            echo '<hr>';

            function vienas() {
                echo 'vienas du trys';
            }
            $a = 'vienas';
            $a();

            echo '<hr>';

            echo 'faile: '.__FILE__.' eiluteje: '.__LINE__.' kazkas atsitiko';

            echo '<hr>';

            define ('LIBRARY_PATH', __DIR__.'/library/');
            echo LIBRARY_PATH;

            require_once LIBRARY_PATH.'manobilblioteka.php'

        ?>
    </body>
</html>
