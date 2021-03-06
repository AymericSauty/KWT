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

    	$i =0;
    	foreach ($response->members as $members) 
    	{
    		$characters[$i]['name'] = $members->character->name;
    		$characters[$i]['classe'] = $members->character->class;
    		$characters[$i]['role'] = $members->character->spec->role;
    		$characters[$i]['rank'] = $members->rank;
    		$characters[$i]['thumbnail'] = $members->character->thumbnail;
    		$i++;
    	}
        return $this->render('KWTBundle:Site:membre.html.twig',array ('characters'=>$characters));
    }
}
