<?php
/**
 * Created by PhpStorm.
 * User: py2211
 * Date: 8/4/17
 * Time: 2:16 PM
 */
use Symfony\Component\Routing\RouteCollection;
use Symfony\Component\Routing\Route;

$collection = new RouteCollection();
$collection->add('lucky_number', new Route('/lucky/number/{count}', array(
    '_controller' => 'AppBundle:Lucky:number',
)));

return $collection;