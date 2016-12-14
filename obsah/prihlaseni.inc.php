<?php

global $subpage;
// nacteni souboru
    include_once("inc/db_pdo.class.php");
    include_once("inc/DBUzivatele.class.php");
    include_once("inc/settings.inc.php");
    include_once("inc/functions.inc.php");
    include_once("Controller/control_login.class.php");

/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 02.12.2016
 * Time: 14:42
 */
    /**
     * prihlasi uzivatele
     */
        $cont = new control_login();
        $cont->getSign();
        $cont->getVypis();

    echo "<div class=\"container\" >    
        
    <div id=\"loginbox\" class=\"mainbox col-md-6 col-md-offset-3 col-sm-6 col-sm-offset-3\"> 
        
        
        
        <div class=\"panel panel-default\" >
            <div class=\"panel-heading\">
                <div class=\"panel-title text-center\">Přihlášení</div>
            </div>     

            <div class=\"panel-body\" >

                <form name=\"form\" id=\"form\" class=\"form-horizontal\" enctype=\"multipart/form-data\" method=\"POST\">
                   
                    <div class=\"input-group\">
                        <span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-user\"></i></span>
                        <input id=\"user\" type=\"text\" class=\"form-control\" name=\"user\" value=\"\" placeholder=\"Username or email\">                                        
                    </div>
                    
                    <div class=\"input-group\">
                        <span class=\"input-group-addon\"><i class=\"glyphicon glyphicon-lock\"></i></span>
                        <input id=\"password\" type=\"password\" class=\"form-control\" name=\"password\" placeholder=\"Password\">
                    </div>                                                                  

                    <div class=\"form-group\">
                        <!-- Button -->
                        <div class=\"col-sm-12 controls\">
                            <button type=\"submit\" href=\"\" name = \"submit\" class=\"btn btn-primary pull-right\"><i class=\"glyphicon glyphicon-log-in\"></i> Přihlásit</button>                          
                        </div>
                    </div>

                </form>     

            </div>                     
        </div>  
    </div>
</div>";

