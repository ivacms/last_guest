<?php
/*
Name: Модуль последних записей компонента Phoca GuestBook.
Author: Иванов Алексей
Author Uri: https://ivacms.ru
Email: taganka@mail.ru
*/

defined( '_JEXEC' ) or die( 'Restricted access' );

include_once __DIR__.'/helper.php';

$last_guest=new ivacms_last_guest;

echo $last_guest->show($module,$params);	

?>