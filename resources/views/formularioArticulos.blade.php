

<!doctype html>
<html>
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="../css/input.css" rel="stylesheet">
  <link href="../dist/output.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
  <link href="{{ asset('images/Nebula.png') }}" rel="icon" type="image/x-icon">
  <title>Punto de venta</title>
  
</head>
<body class="bg-gray-50">
@if(session('id'))
    @if(session('fkTipoUsuario')==1)
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
		   <!-- Codigo del formulario -->
		   <div class="bg-white rounded-lg shadow-lg p-4">
			<div class="flex">
				<a href="{{ url()->previous() }}" class="flex items-center bg-blue-500 p-2 text-base font-medium text-white rounded-lg hover:bg-blue-400">
					Regresar
                </a>
			</div>		
				<h1 class="text-center font-bold text-2xl md:mt-5 mt-10">Agregue un nuevo articulo</h1>
			<form id="formulario"  action="{{ route('articulo.insertar') }}" enctype="multipart/form-data"  method="post" >
			@csrf   	
            <div class="grid gap-6 mb-6 md:grid-cols-2 mt-10">
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Nombre del articulo</label>
						<input  name="nombreArticulo" type="text" id="" class="bg-blue-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5" placeholder="" required>
					</div>
					<div>
						<label for="countries" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Categoria Articulo</label>
						
                        <select name="fkCategoriaArticulo"  id="fkCategoriaArticul"id="countries" class="bg-blue-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5"required>
                                    @php
                        use App\Models\categoriaArticulo;
                        $datosCategorias=categoriaArticulo::where('estatus', 1)->get();
                    @endphp
                    <option value="">Selecciona Categoria</option>
                    @foreach ($datosCategorias as $dato)
                        <option value="{{$dato->pkCategoriaArticulo}}">{{$dato->nombreCategoriaArticulo}}</option>
                    @endforeach
						</select>
					</div> 
					<select name="fkUnidad"  id="fkUnidad"id="countries" class="bg-blue-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5" required>
                                    @php
                        use App\Models\Unidad;
                        $datosUnidad=Unidad::where('estatus', 1)->get();
                    @endphp
                    <option value="">Selecciona Unidad</option>
                    @foreach ($datosUnidad as $dato)
                        <option value="{{$dato->pkUnidad}}">{{$dato->nombreUnidad}}</option>
                    @endforeach
						</select>
					</div> 
				
					<div>		
						<label class="block mb-2 text-sm font-medium text-gray-900" for="file_input">Sube un archivo</label>
						<input id="imagenArticulo" name="imagenArticulo" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-blue-50 focus:outline-none" aria-describedby="file_input_help" id="" type="file">
						<p class="mt-1 text-sm text-gray-500" id="file_input_help">PNG, JPG</p>
					</div>

					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">precio</label>
						<input type="text" name="precio" id="" class="bg-blue-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5" placeholder="" required>
					</div>
					
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">costo</label>
						<input type="text" name="costo" id="" class="bg-blue-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5" placeholder="" required>
					</div>
					
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad minima</label>
						<input type="text" name="cantidadMinima" id="" class="bg-blue-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5" placeholder="" required>
					</div>
					
					
					<div>
						<label for="" class="block mb-2 text-sm font-medium text-gray-900">Cantidad actual</label>
						<input type="text"   name="cantidadActual" id="" class="bg-blue-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5" placeholder="" required>
					</div>

				
				</div>
			
		   </div>
	
			<div class="flex justify-center	mt-16">
				<div class="md:p-10 p-5">
					  <div class="flex">
						<!-- Previous Button -->
						<a href="{{ url()->previous() }}" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
						  Cancelar
						</a>
						<!-- Next Button -->
						<input type="submit" id="completar"  href="#" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
					
						</input>
					  </div>
				</div>
			</div>
		   </div>
        </div>
     </div>
     </form>
	 <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
</body>
</html>
