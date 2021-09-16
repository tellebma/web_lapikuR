<?php

class PathologiesCriteresController { // FAUT FAIRE FETCHALL PARCE QUE CE FDP DE QUERY RENVOIE UN PDOSTATEMENT ET ON PEUT ITERER QUE UNE FOIS DESSUS SAMERE
    function routing($router){
        $router->get('/pathologies_C', function(){
            $symptomes = (new DataBaseService())->query(("SELECT symptPatho.idP, symptome.desc FROM patho JOIN symptPatho ON patho.idP = symptPatho.idP JOIN symptome ON symptPatho.idS = symptome.idS"));
            //var_dump($symptomes->fetchAll());
            echo $GLOBALS['twig']->render('pathologies_C.twig', ['pathologies' => ((Object)new DataBaseService())->query(("SELECT * FROM patho"))->fetchAll(),
                                                                'symptomes' => ((Object)new DataBaseService())->query(("SELECT symptPatho.idP, symptome.desc FROM patho JOIN symptPatho ON patho.idP = symptPatho.idP JOIN symptome ON symptPatho.idS = symptome.idS"))->fetchAll()]);
        });      
    }
}

?>

