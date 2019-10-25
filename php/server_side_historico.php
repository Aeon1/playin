<?php
  include_once('db_config.php');
  #obtener todos los registro historicos
  $datos = mysqli_query($db,"select busqueda,resultados,fecha from historico");
  while ($resultados = mysqli_fetch_assoc ($datos)) {
    $output['data'][] = $resultados;
  }
 $check_result =  $output ?? ['data' => [] ]; ### en caso que la consulta no regrese resultados evitar error
  echo json_encode( $check_result , true);

?>
