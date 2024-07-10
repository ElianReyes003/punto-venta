<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="{{ asset('images/Nebula.png') }}" rel="icon" type="image/x-icon">

    @vite(['resources/css/app.css','resources/js/app.js'])
    <title>Maderas Y Tarimas Del Bosque</title>
</head>
<body>
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
		   <div class="flex justify-center">
            <form action="{{ route('unidad.actualizar', $datosUnidad->pkUnidad) }}" method="post"class="bg-white rounded-lg shadow-lg p-4 md:w-[50rem]">
            @csrf    
            <h1 class="text-center font-bold text-2xl p-5">Editar Unidad</h1>
                  
                <div class="gap-6 p-5">
                    
                    <div>
                        <label for="" class="block mb-2 text-sm font-medium text-gray-900">Unidad</label>
                        <input   type="text" name="nombreUnidad" id="nombreUnidad" value="{{$datosUnidad->nombreUnidad}}" required id="" class="bg-blue-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-400 focus:border-blue-400 block w-full p-2.5" placeholder="" required>
                    </div>
                   
                </div>
                <div class="flex justify-center">
                    <div class="md:p-10 p-5 mt-5">
                          <div class="flex">
                            <!-- Previous Button -->
                            <a  href="{{ url()->previous() }}" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
                              Cancelar
                            </a>
                            <!-- Next Button -->
                            <button type="submit" class="flex items-center justify-center px-4 h-10 md:px-10 md:ml-20 ml-10 ms-3 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
                              Guardar
                            </button>
                          </div>
                    </div>
                </div>	
           </form>
        </div>
     </div>
   <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>



</body>
</html>