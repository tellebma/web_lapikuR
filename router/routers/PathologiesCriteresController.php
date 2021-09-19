<?php

require_once 'services/DataBaseService.php';

require_once 'services/Api/PathologieServices.php';

class PathologiesCriteresController { // FAUT FAIRE FETCHALL PARCE QUE CE FDP DE QUERY RENVOIE UN PDOSTATEMENT ET ON PEUT ITERER QUE UNE FOIS DESSUS SAMERE
    function routing($router){
        $router->get('/pathologies_C', function(){
            echo $GLOBALS['twig']->render('pathologies_C.twig', [
                                                        'symptomesByPathologie' => (new PathologieServices())->getSymptomesByPathologie(),
                                                        'keywordsBySymptome' => (new SymptomeServices())->getKeywordsBySymptome(),
                                                        'meridiens' => (new MeridienServices())->listAll(),
                                                        'pathologies' => (new PathologieServices())->listAll(),
                                                        'keywords' => (new KeywordServices())->listAll(),
                                                        'symptomes' => (new SymptomeServices())->listAll()
                                                    ]);
        });      
    }
}

?>

