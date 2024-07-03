<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Punto de venta</title>
    <link href="{{ asset('images/Nebula.png') }}" rel="icon" type="image/x-icon">

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
			<div class="flex justify-center">
                    <h1 class="text-center font-bold text-2xl">Venta</h1>
			</div>
            <div class="flex justify-center mt-5">
                <h1 class="text-center font-semibold text-xl">Seleccione si el cliente exite o es nuevo</h1>
        </div>
    
        <div class="md:p-10 p-5 mt-5 flex justify-center">
            <div class="flex">
              <!-- Previous Button -->
              <a href="/compraNewClient" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
                Cliente Nuevo
              </a>
              <!-- Next Button -->
              <a href="/compraClient" class="flex items-center justify-center px-4 h-10 md:px-10 md:mr-20 mr-10 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
                Cliente Existente
              </a>
            </div>
      </div>
   <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
   <script src="../node_modules/flowbite/dist/datepicker.js"></script>
</body>
</html>