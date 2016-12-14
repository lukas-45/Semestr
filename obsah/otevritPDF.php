<?php
/**
 * Created by PhpStorm.
 * User: Lukáš
 * Date: 13.12.2016
 * Time: 11:05
 */
    /**
     * otevre pdf soubor (priloha v prispevku)
     */
    $subpage = $_REQUEST["subpage"];
    $file = "public/pdf/$subpage.pdf";
    header('Content-Description: File Transfer');
    header('Content-Type: application/octet-stream');
    header('Content-Disposition: attachment; filename='.basename($file));
    header('Content-Transfer-Encoding: binary');
    header('Expires: 0');
    header('Cache-Control: must-revalidate');
    header('Pragma: public');
    header('Content-Length: ' . filesize($file));
    ob_clean();
    ob_end_flush();
    readfile($file);