<?php

namespace KWTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class KWTController extends Controller
{
    public function indexAction()
    {
        return $this->render('KWTBundle:Site:index.html.twig');
    }

    public function membreAction()
    {
    	//Récupération de données via API Blizzard
        $url = "https://eu.api.battle.net/wow/guild/Hyjal/KWT?fields=members&locale=fr_FR&apikey=gdqbrkpkzk4sbrs7ku3h2gxqwrax22zg";
    	$raw = file_get_contents($url);
    	$response = json_decode($raw);
    	// foreach ($response->members as $members) 
    	// {
    	// 	$name[] = utf8_decode($members->character->name);
    	// 	$classe[] = utf8_decode($members->character->class);
    	// 	$role[] = utf8_decode($members->character->spec->role);
    	// 	$thumbnail[] = utf8_decode($members->character->thumbnail);
    	// }
        foreach ($response->members as $members) 
        {
            foreach ($members->character as $character) 
            {

                 $tab  = array('name'=> utf8_decode($character->name),
                                     'classe'=> utf8_decode($character->class),
                                     'role'=> utf8_decode($character->spec->role),
                                     'thumbnail'=>utf8_decode($character->thumbnail)

                        );
         

            }
                                
        }
        var_dump($tab);
        // $data = array("name"=>$name, "classe"=>$classe, "role"=>$role, "thumbnail"=>$thumbnail);

        return $this->render('KWTBundle:Site:membre.html.twig');
    }
}
