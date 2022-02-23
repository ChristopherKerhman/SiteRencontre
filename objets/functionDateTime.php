<?php
function brassageDate($data) {
$date = $data;
$year = substr($date,0,4);
$month = substr($date,5,2);
$day = substr($date,8,2);
$date = $day.'/'.$month.'/'.$year;
return $date;
}
function heure($data) {
  $time = $data;
  $heure = substr($time,0,2);
  $minute = substr($time,3,2);
  $data = $heure.'h'.$minute;
  return $data;
}
