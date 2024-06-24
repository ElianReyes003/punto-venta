<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>

    <title>Punto de venta</title>
    <link href="{{ asset('images/Nebula.png') }}" rel="icon" type="image/x-icon">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>

@include('mensaje')

<body background="/images/fondo.jpg" class="bg-no-repeat bg-cover w-screen">
    <div class="mt-10 md:mt-5">
        <div class="flex justify-center items-center">
            <div class="p-4 md:w-[30rem]">
                <!-- Guias del tamaño del contenedor -->
                <div class="p-4 ">
                    <!-- PON EL CODIGO DEL MODULO AQUI-->
                    <div class="bg-white rounded-lg shadow-lg p-4">
                        <!-- logo -->
                        <div>
                            <div class="flex justify-center">
                                <div class="items-center justify-center">
                                    <div class="md:w-[8rem] w-[5rem] flex">
                                        <img src="images/Nebula.png">
                                    </div>
                                </div>
                            </div>
                            <form id="formulario" action="{{ route('inicioSesion') }}" enctype="multipart/form-data" method="post">
                                @csrf
                                <!-- formulario iniciar sesion -->
                                <div>
                                    <div class="flex justify-center mt-10">
                                        <h1 class="text-center font-bold text-2xl">Inicio de sesion</h1>
                                    </div>
                                    <div class="grid grid-cols-1 mt-10">
                                        <form class="max-w-sm mx-auto">
                                            <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900">Usuario</label>
                                            <div class="flex">
                                                <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                                                    <svg class="w-4 h-4 text-gray-500" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm0 5a3 3 0 1 1 0 6 3 3 0 0 1 0-6Zm0 13a8.949 8.949 0 0 1-4.951-1.488A3.987 3.987 0 0 1 9 13h2a3.987 3.987 0 0 1 3.951 3.512A8.949 8.949 0 0 1 10 18Z" />
                                                    </svg>
                                                </span>
                                                <input type="text" name="nombreUsuario" id="website-admin" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-400 focus:border-blue-400 block flex-1 min-w-0 w-full text-sm p-2.5" placeholder="">
                                            </div>
                                            <!-- contra -->
                                            <div class="mt-5">
                                                <label for="website-admin" class="block mb-2 text-sm font-medium text-gray-900">Contraseña</label>
                                                <div class="flex">
                                                    <span class="inline-flex items-center px-3 text-sm text-gray-900 bg-gray-200 border border-e-0 border-gray-300 rounded-s-md">
                                                        <svg class="w-4 h-4 text-gray-500" fill="currentColor" width="800px" height="800px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                                                            <g id="Layer_2" data-name="Layer 2">
                                                                <g id="invisible_box" data-name="invisible box">
                                                                    <rect width="48" height="48" fill="none" />
                                                                </g>
                                                                <g id="Layer_7" data-name="Layer 7">
                                                                    <path fill="currentColor" d="M39,18H35V13A11,11,0,0,0,24,2H22A11,11,0,0,0,11,13v5H7a2,2,0,0,0-2,2V44a2,2,0,0,0,2,2H39a2,2,0,0,0,2-2V20A2,2,0,0,0,39,18ZM15,13a7,7,0,0,1,7-7h2a7,7,0,0,1,7,7v5H15ZM14,35a3,3,0,1,1,3-3A2.9,2.9,0,0,1,14,35Zm9,0a3,3,0,1,1,3-3A2.9,2.9,0,0,1,23,35Zm9,0a3,3,0,1,1,3-3A2.9,2.9,0,0,1,32,35Z" />
                                                                </g>
                                                            </g>
                                                        </svg>
                                                    </span>
                                                    <input type="password" name="contraseña" id="website-admin" class="rounded-none rounded-e-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-blue-400 focus:border-blue-400 block flex-1 min-w-0 w-full text-sm p-2.5" placeholder="">
                                                </div>
                                            </div>
                                        </form>
                                    </div>

                                    <div class="md:p-10 p-5 mt-5 flex justify-center">
                                        <div class="flex justify-center">
                                            <!-- boton iniciar sesion -->
                                            <button type="submit" class="flex items-center justify-center px-4 h-10 md:px-10 ms-3 text-base font-medium text-white bg-blue-500 border rounded-lg hover:bg-blue-400">
                                                Iniciar sesion
                                            </button>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </form>
</body>



</html>