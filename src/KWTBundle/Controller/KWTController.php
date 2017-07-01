<?php

namespace KWTBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;



class KWTController extends Controller
{
    public function indexAction()
    {
    	$active = "Accueil";
        return $this->render('KWTBundle:Site:index.html.twig',array ('active'=>$active));
    }

    public function membreAction()
    {
    	$active = "Membres";
    	//Récupération de données via API Blizzard
        $url = "https://eu.api.battle.net/wow/guild/Hyjal/KWT?fields=members&locale=fr_FR&apikey=gdqbrkpkzk4sbrs7ku3h2gxqwrax22zg";
    	$raw = file_get_contents($url);
    	$response = json_decode($raw);

    	$i =0;
    	foreach ($response->members as $members) 
    	{
    		$characters[$i]['name'] = $members->character->name;
    		$characters[$i]['class'] = $members->character->class;
    		$characters[$i]['role'] = $members->character->spec->role;
    		$characters[$i]['rank'] = $members->rank;
    		$characters[$i]['thumbnail'] = $members->character->thumbnail;
    		$i++;
    	}
        return $this->render('KWTBundle:Site:membre.html.twig',array ('characters'=>$characters , 'active'=>$active));
    }

    public function characterAction($character)
    {
    	$active = "Personnage";
    	//Récupération de données via API Blizzard
    	$url = "https://eu.api.battle.net/wow/character/Hyjal/".$character."?fields=items&locale=fr_FR&apikey=gdqbrkpkzk4sbrs7ku3h2gxqwrax22zg";
    	$raw = file_get_contents($url);
    	$response = json_decode($raw);
    	$description = array(
    		'name' => utf8_decode($response->name),
    		'class' => $response->class, 
    		'gender' => $response->gender,
    		'level' => $response->level,
    		'thumbnail' => $response->thumbnail,
    		'ilvl' => $response->items->averageItemLevelEquipped,
    		);
		$items = array(
    		array ('name' => utf8_decode($response->items->head->name), 'id' => $response->items->head->id) ,
    		array ('name' => utf8_decode($response->items->neck->name), 'id' => $response->items->neck->id ),
    		array ('name' => utf8_decode($response->items->shoulder->name), 'id' => $response->items->shoulder->id ),
    		array ('name' => utf8_decode($response->items->back->name), 'id' => $response->items->back->id ),
    		array ('name' => utf8_decode($response->items->chest->name), 'id' => $response->items->chest->id ),
    		array ('name' => utf8_decode($response->items->wrist->name), 'id' => $response->items->wrist->id ),
    		array ('name' => utf8_decode($response->items->hands->name), 'id' => $response->items->hands->id ),
    		array ('name' => utf8_decode($response->items->waist->name), 'id' => $response->items->waist->id ),
    		array ('name' => utf8_decode($response->items->legs->name), 'id' => $response->items->legs->id ),
    		array ('name' => utf8_decode($response->items->feet->name), 'id' => $response->items->feet->id ),
    		array ('name' => utf8_decode($response->items->finger1->name), 'id' => $response->items->finger1->id ),
    		array ('name' => utf8_decode($response->items->finger2->name), 'id' => $response->items->finger2->id ),
    		array ('name' => utf8_decode($response->items->trinket1->name), 'id' => $response->items->trinket1->id ),
    		array ('name' => utf8_decode($response->items->trinket2->name), 'id' => $response->items->trinket2->id )
    		);
		$url = "https://eu.api.battle.net/wow/character/Hyjal/".$character."?fields=stats&locale=fr_FR&apikey=gdqbrkpkzk4sbrs7ku3h2gxqwrax22zg";
    	$raw = file_get_contents($url);
    	$response = json_decode($raw);
 		$stats = array(
    		'health' => $response->stats->health,
    		'power' => $response->stats->power, 
    		'str' => $response->stats->str,
    		'agi' => $response->stats->agi,
    		'int' => $response->stats->int,
    		'crit' => $response->stats->crit,
    		'haste' => $response->stats->haste,
    		'mastery' => $response->stats->mastery,
    		'versatility' => $response->stats->versatilityDamageDoneBonus
    		);

		var_dump($description);
    	var_dump($items);
    	var_dump($stats);
        return $this->render('KWTBundle:Site:character.html.twig',array ('active'=>$active));
    }

}
