$(document).ready(function() {
  $('#resultados').DataTable({
    "language": {
        "url" : "http://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Spanish.json"
    },
    "destroy": true,
    "ordering": false,
    "paging": true,
    "pageLength":15,
    "lengthMenu": [ [15, 25, 50,100, -1], [15, 25, 50,100, "Todos"] ],
    "info": true,
    "processing": false,
		"serverSide": false,
    "ajax": {
              "url": "php/server_side_historico.php",
          },
        "columns": [
          { "data": "busqueda" },
          { "data": "resultados" },
          { "data": "fecha" },
      ]

  });
});
