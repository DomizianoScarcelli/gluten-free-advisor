<?php
/**
 * Ritorna true se array1 è incluso in array2
 */
function subset($array1, $array2)
{
  foreach ($array1 as $item1) {
    if (!in_array($item1, $array2)) {
      return false;
    }
  }
  return true;
}

/**
 * Trasforma un array di arrays in un array monodimensionale.
 */
function parseQueryString($queryArray)
{
  $tagArray = array();
  foreach ($queryArray as $tag => $content) {
    if ($tag != 'query' && $tag != 'range') {
      foreach ($content as $inner) {
        array_push($tagArray, str_replace('-', ' ', $inner));
      }
    }
  }
  return $tagArray;
}

/**
 * Ritorna l'ip address dell'utente. 
 */
function get_ip_address()
{
  $externalContent = file_get_contents('http://checkip.dyndns.com/');
  preg_match('/Current IP Address: \[?([:.0-9a-fA-F]+)\]?/', $externalContent, $m);
  $ip = $m[1];
  return $ip;
}
/**
 * Ritorna la distanza tra due coordinate in chilometri
 */
function get_distance($lat1, $lon1, $lat2, $lon2)
{
  $theta = $lon1 - $lon2;
  $dist = sin(deg2rad($lat1)) * sin(deg2rad($lat2)) +  cos(deg2rad($lat1)) * cos(deg2rad($lat2)) * cos(deg2rad($theta));
  $dist = acos($dist);
  $dist = rad2deg($dist);
  $miles = $dist * 60 * 1.1515;
  return ($miles * 1.609344);
}


function getPriceSymbol($tagArray)
{
  if (in_array('Economico', $tagArray)) {
    return '$';
  } else if (in_array('Nella media', $tagArray)) {
    return '$$';
  } else if (in_array('Raffinato', $tagArray)) {
    return '$$$';
  } else {
    return '';
  }
}
