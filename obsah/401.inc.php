<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 07.12.2016
 * Time: 10:50
 */
$cont = new control();
    echo"<div class=\"container\">
    <div class=\"row\">
        <div class=\"span12\">
            <div class=\"hero-unit center\">
                <h1>Stránka nenalezena <small><font face=\"Tahoma\" color=\"red\">Error 401</font></small></h1>
                <br />
                <p>Na tuhle stránku nemáte dostatečné oprávnění. <b>Zpátky na úvod</b> </p>
                <a href=\"". $cont->makeUrl('uvod')."\" class=\"btn btn-large btn-info\"><i class=\"icon-home icon-white\"></i> Zpátky na úvod</a>
            </div>

            <!-- By ConnerT HTML & CSS Enthusiast -->
        </div>
    </div>
</div>";