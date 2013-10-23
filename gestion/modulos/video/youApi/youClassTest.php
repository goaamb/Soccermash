<?php
require_once('youClass.php');
/*
 * Name: Simple Class Info YouTube
 * Description: Get Information of video YouTube
 * Development: Chuecko
 * Site: http://www.zarpele.com.ar
 * License: GNU GENERAL PUBLIC LICENSE (http://www.gnu.org/licenses/gpl.html)
 * Version: 1.0
 */
/*
 * Tambien le pueden pasar como parametro solo el ID de youtube
 * $youtube = new youtube('59PyU_7iqaU');
 */
$youtube = new youtube('http://www.youtube.com/watch?v=CD2LRROpph0&feature=related');

//echo 'Titulo: '.$youtube->getTitle().'<br/>';
/*echo 'Publicado: '.$youtube->getPublished().'<br/>';
echo 'Descripcion: '.$youtube->getDescription().'<br/>';
echo 'Meta Tags: '.$youtube->getMetaTags().'<br/>';
echo 'Link: '.$youtube->getUrl().'<br/>';*/
echo 'a ver: ',$youtube->getUrlImage('default');

//echo $youtube->getEmbeb(640, 390);

?>