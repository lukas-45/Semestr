<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 05.12.2016
 * Time: 9:57
 */
$cont = new control();
unset($_SESSION['uzivatel']);
$_SESSION['uzivatel'] = null;
header('Location: ' .$cont->makeUrl('uvod'));