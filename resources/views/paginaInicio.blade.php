<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <link href="{{ asset('images/Nebula.png') }}" rel="icon" type="image/x-icon">
    <title>Punto de venta</title>
</head>
<body>
  
@if(session('id'))
    @if(session('fkTipoUsuario')==1||session('fkTipoUsuario')==2)
        @include("sidebar")
        <!-- El resto de tu contenido aquí... -->
    @else
        <script>
            window.location.href="{{url('/')}}";
        </script>
    @endif
@else
    <script>
        window.location.href="{{url('/')}}";
    </script>
@endif

<div class="p-4 sm:ml-64 mt-16 md:mt-10">
        <!-- Guias del tamaño del contenedor -->
        <div class="p-4">
    <!-- PON EL CODIGO DEL MODULO AQUI-->
    <div class="bg-white rounded-lg shadow-lg p-4">
        <div class="flex justify-end mt-10">
        @if(session('fkTipoUsuario') == 1)
                            <button id="imprimir"class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
							    imprimir
                            </button>
        @endif
                          </div>
        <div class="flex justify-center">
            <h1 class="text-center font-bold text-2xl">Punto de venta</h1>
        </div>
                @php
            // Importar los modelos si no lo has hecho previamente
            use App\Models\Cliente;
            use App\Models\ComprasClientes; // Corregí el nombre del modelo
            use App\Models\Articulo; 
            

                $datosArticulos = Articulo::join('categoriaArticulo', 'articulo.fkCategoriaArticulo', '=', 'categoriaArticulo.pkCategoriaArticulo')
                ->select('categoriaArticulo.*', 'articulo.*', 'articulotipoventa.*','articulo.estatus as ESTATUSARTICULO')
                ->whereIn('articulo.estatus', [2, 0])
                ->count();


            // Consultar la cantidad de compras del día
            $comprasDia = ComprasClientes::whereDate('fecha', now()->toDateString())->count();
            $totalComprasDia = comprasClientes::whereDate('fecha', now()->toDateString())->sum('total');

            $ventas = ComprasClientes::whereDate('fecha', now()->toDateString())
                          ->where('fkEmpleado', session('id'))
                          ->count();

        @endphp


        <div class="grid grid-cols-1 md:grid-cols-2 ml-10 md:ml-0 p-5">
           
            <div class="flex p-5 md:justify-end">
                <h1 class="font-semibold">Articulos por Abastecer:</h1><p class="ml-1">{{$datosArticulos}}</p>
            </div>
            <div class="flex p-5">
                <h2 class="font-semibold">Ventas del día:</h2><p class="ml-1">{{$comprasDia}}</p>
            </div>
            <div class="flex p-5">
                <h2 class="font-semibold">Ventas de este usuario hoy:</h2><p class="ml-1">{{$ventas}}</p>
            </div>
            @if(session('fkTipoUsuario') == 1)
                <div class="flex p-5">
                    <h2 class="font-semibold">Dinero total de compras hoy:</h2>
                    <p class="ml-1">{{$totalComprasDia}}</p>
                </div>
            @endif
        </div>
    </div>
</div>
@if(session('fkTipoUsuario') == 1)

<div class="flex justify-center md:justify-normal items-center mt-10">
                    <form class="w-[13rem] md:w-[30rem]">   
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                </svg>
                            </div>
                            <input type="search"  id="busqueda" name="searchTermCliente" class="block w-full p-4 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-green-400 focus:border-green-400" placeholder="Buscar" required>
                        </div>
                    </form>
                 </div>

<table  id="tablaComprasDia" class="tablaCompras" class="w-full table-auto mt-[1rem]" id="miTabla" class="display nowrap" width="90%">
				<thead class="text-center">
					<tr class="h-24 text-center">
						<th>Articulo</th>
                        <th>Categoria Articulo</th>
                        <th>Unidad</th>
                        <th>Total Vendidos Hoy</th>
					</tr>
					<tbody>
                    @foreach ($arregloArticulos as $index => $dato)
                        <tr class="h-20">
                            <td>{{$dato->nombreArticulo}}</td>
                            <td>{{$dato->nombreCategoriaArticulo}}</td>
                            <td>{{$dato->nombreUnidad}}</td>
                            <td>{{$arregloSumas[$index]}}</td>
                        </tr>
                    @endforeach
					</tbody>
					</thead>
</table>

<div class="flex justify-center	mt-16">
					<div class="md:p-10 p-5">
						  <div class="flex">
							<!-- Previous Button -->
							<button id="previousBtn"class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
							  Anterior
							</button>
							<!-- Next Button -->
							<button id="nextBtn"  class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
							  Siguiente
							</button>

                            
						  </div>
					</div>
</div>
@endif

    </div> 
  
        
        

    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
   <script src="../node_modules/flowbite/dist/datepicker.js"></script>
   <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        $('#imprimir').on('click', function() {

          
          
          var printWindow = window.open('', '_blank'); // Abre una nueva ventana para imprimir

        // Escribe el HTML necesario en la nueva ventana
        printWindow.document.write('<!DOCTYPE html>');
        printWindow.document.write('<html><head>');
        printWindow.document.write('<title>Imprimir</title>');
        printWindow.document.write('<style>');
        // Estilos generales
        printWindow.document.write('body { font-family: Arial, sans-serif; color: #333; }');
        printWindow.document.write('.container { max-width: 800px; margin: 0 auto; padding: 20px; border: 2px solid blue; border-radius: 10px; background-color: #f9f9f9; }');
        printWindow.document.write('.header { text-align: center; font-size: 10px; margin-bottom: 10px; color: black; }');
        printWindow.document.write('.info { border: 2px solid blue; padding: 10px; margin-bottom: 20px; border-radius: 10px; background-color: #fff; }');
        printWindow.document.write('.info p { margin: 5px 0; }');
        printWindow.document.write('table { width: 100%; border-collapse: collapse; border: 2px solid blue; border-radius: 10px; background-color: #fff; }');
        printWindow.document.write('table, th, td { border: 1px solid #ddd; padding: 8px; }');
        printWindow.document.write('th, td { text-align: left; }');
        // Estilos específicos
        printWindow.document.write('.highlight { color: black; }');
        printWindow.document.write('.svg-container { position: absolute; top: 20px; left: 20px; }');
        printWindow.document.write('</style>');
        printWindow.document.write('</head><body>');
        printWindow.document.write('<div class="container">');

        // Espacio para el SVG
       

        // Encabezado con los datos de la empresa
        printWindow.document.write('<div class="header">');
        printWindow.document.write('<h2>Punto de venta</h2>');
        printWindow.document.write('<p>Elian Christopher Reyes Estrada | Kevin Omar Llamas Lopez</p>');
        printWindow.document.write('<p>Tel. 6951197968 | Cel. 6941197826</p>');
        printWindow.document.write('<p>Escuinapa Sinaloa, Mexico</p>');
        printWindow.document.write('</div>');

    
            printWindow.document.write('<h2 style="text-align: center; margin-bottom: 20px;">Total de vendidos articulos </h2>');

            // Obtiene la fecha actual
            var currentDate = new Date();
            // Formatea la fecha con dos dígitos para el día y el mes
            var formattedDate = currentDate.getDate().toString().padStart(2, '0') + '/' + (currentDate.getMonth() + 1).toString().padStart(2, '0') + '/' + currentDate.getFullYear();

            // Luego, puedes insertarla en el HTML generado
            printWindow.document.write('<h2 style="text-align: center; margin-bottom: 20px;">Fecha: ' + formattedDate + '</h2>');
            printWindow.document.write('<h3 style="text-align: center; margin-bottom: 20px;">Dinero total de compras hoy: ${{$totalComprasDia}} </h3>');       
            // Tabla de compras
            printWindow.document.write('<table style="width: 100%; border-collapse: collapse; margin-bottom: 20px;">');
            printWindow.document.write('<thead class="text-center">');
            printWindow.document.write('<tr class="h-24 text-center">');
            printWindow.document.write('<th>Articulo</th>');
            printWindow.document.write('<th>Categoria Articulo</th>');
            printWindow.document.write('<th>Unidad</th>');
            printWindow.document.write('<th>Total Vendidos Hoy</th>');
            printWindow.document.write('</tr>');
            printWindow.document.write('</thead>');
            printWindow.document.write('<tbody>');

            // Recorrer cada página de la tabla y extraer los datos
            var table = $('#tablaComprasDia').DataTable();
            for (var i = 0; i < table.page.info().pages; i++) {
                table.page(i).draw('page');
                var tableRows = table.rows({ search: 'applied' }).nodes();
                tableRows.each(function (row, idx) {
                    printWindow.document.write('<tr>');
                    $(row).find('td').each(function() {
                        printWindow.document.write('<td style="border: 1px solid #ddd; padding: 8px;">' + $(this).html() + '</td>');
                    });
                    printWindow.document.write('</tr>');
                });
            }

            printWindow.document.write('</tbody>');
            printWindow.document.write('</table>');

            printWindow.document.write('</div>');

            // Cierra la escritura del documento y llama al método print para imprimir
            printWindow.document.close();
            printWindow.print();
        });
    });
</script>


   
    
    <script>




$(document).ready(function () {
    var table = $('#tablaComprasDia').DataTable({
        responsive: true,
            "language": {
                "sProcessing":     "Procesando...",
                "sLengthMenu":     "Mostrar _MENU_ registros",
                "sZeroRecords":    "No se encontraron resultados",
                "sEmptyTable":     "Ningún dato disponible en esta tabla",
                "sInfo":           "Mostrando registros del _START_ al _END_ de un total de _TOTAL_ registros",
                "sInfoEmpty":      "Mostrando registros del 0 al 0 de un total de 0 registros",
                "sInfoFiltered":   "(filtrado de un total de _MAX_ registros)",
                "sInfoPostFix":    "",
                "sSearch":         "Buscar:",
                "sUrl":            "",
                "sInfoThousands":  ",",
                "sLoadingRecords": "Cargando...",
                "oPaginate": {
                    "sFirst":    "Primero",
                    "sLast":     "Último",
                    "sNext":     "Siguiente",
                    "sPrevious": "Anterior"
                },
                "oAria": {
                    "sSortAscending":  ": Activar para ordenar la columna de manera ascendente",
                    "sSortDescending": ": Activar para ordenar la columna de manera descendente"
                }
            },
    });

     // Agrega evento de clic al botón Previous
     $('#previousBtn').on('click', function(e) {
        e.preventDefault();
        table.page('previous').draw(false);
        });

        // Agrega evento de clic al botón Next
        $('#nextBtn').on('click', function(e) {
        e.preventDefault();
        table.page('next').draw(false);
        });

    $('#busqueda').on('keyup', function (e) {
        var filtroBusqueda = $('#busqueda').val();
        table.search(filtroBusqueda).draw();
    });

    // Limpiar los filtros al hacer clic en el botón "Limpiar Filtros"
    $('#limpiarFiltros').on('click', function () {
        $('#busqueda').val('');
        table.search('').columns().search('').draw();
    });
});
</script>

   
</body>
</html>
