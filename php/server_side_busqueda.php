<?php
  $campos = $_POST;
  $params = [
    'term' => $campos['buscar'],
    'entity' => 'musicTrack',
    'limit' => 1000
  ];
  ### obtener los resultados de la busqueda y mostrar campso deseados
  $ch = curl_init('https://itunes.apple.com/search');
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  curl_setopt($ch, CURLOPT_POST, true);
  curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
  $result = json_decode(curl_exec($ch));
  curl_close($ch);
  $resultados = $result->resultCount;
  guardar($campos['buscar'],$resultados);
  $datos_campos = [];
  ### generar json con los campos deseados
  foreach($result->results as $value){
    $datos_campos['artistName'] = $value->artistName ?? "";
    $datos_campos['primaryGenreName'] = $value->primaryGenreName ?? "";
    $datos_campos['trackName'] = $value->trackName ?? "";
    $datos_campos['previewUrl'] ="<audio src='$value->previewUrl' controls='controls' type='audio/mpeg' preload='none'></audio>" ;
    $output['data'][] = $datos_campos;
  }
  $check_result =  $output ?? ['data' => [] ]; ### en caso que la consulta no regrese resultados evitar error
  echo json_encode( $check_result , true);

  ###funcion para guardar en la base de datos la busqueda y resultados
  function guardar(...$d){
    include_once("db_config.php");
    if(!mysqli_query($db,"insert into historico (busqueda,resultados) values('$d[0]',$d[1])")){
      echo mysqli_errno($db);
    }
  }
?>
