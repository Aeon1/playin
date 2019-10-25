$(document).ready(function() {
  $("form").submit(function(e){
    e.preventDefault();
    let buscar = $("input[name=buscar]").val();
    if(buscar != ""){
      cargar_tabla(buscar);
    }
  })
} );
function cargar_tabla(buscar){
  $('#resultados').DataTable({
    "language": {
        "url" : "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    "destroy": true,
    "ordering": true,
    "paging": true,
    "pageLength":15,
    "lengthMenu": [ [15, 25, 50,100, -1], [15, 25, 50,100, "Todos"] ],
    "info": true,
    "processing": false,
		"serverSide": false,
    "ajax": {
              "url": "php/server_side_busqueda.php",
              "type": "POST",
              "data": function (d) {
                    d.buscar = buscar;
                }
          },
        "columns": [
          { "data": "artistName" },
          { "data": "primaryGenreName" },
          { "data": "trackName" },
          { "data": "previewUrl" }
      ]

  });
}
