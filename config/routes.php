<?php

$routes = array(
    array('home','default','index'),
    array('contact','default','contact'),
    array('single','default','single',array('id')),
    array('single2','default','single2',array('id','slug')),

    // abonnes
    array('abonnes','abonne','index'),
    array('detailabonne','abonne','single',array('id')),
    array('addabonne','abonne','add'),
    array('updateabonne','abonne','update',array('id')),
    array('deleteabonne','abonne','delete',array('id')),

);
