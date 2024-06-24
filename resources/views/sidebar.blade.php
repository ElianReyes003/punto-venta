<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>


    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css">
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.1/flowbite.min.js"></script>
    {{-- SweetAlert2 --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link href="{{ asset('images/Nebula.png') }}" rel="icon" type="image/x-icon">

</head>

<body>
    @include('mensaje')
    <style>
        /* Estilos personalizados */
        div.container {
            max-width: 1200px
        }

        .dataTables_wrapper .dataTables_filter {
            display: none;
        }

        .dataTables_wrapper .dataTables_length select {
            border: 1px solid #aaa;
            border-radius: 3px;
            padding: 5px;
            background-color: transparent;
            color: inherit;
            padding: 4px;
            width: 60px;
            margin-bottom: 20px;
            display: none;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            color: inherit;
            margin-left: 3rem;
            display: none;
        }

        div#miTabla_info {
            display: none;
        }

        .dataTables_wrapper .dataTables_length,
        .dataTables_wrapper .dataTables_filter,
        .dataTables_wrapper .dataTables_info,
        .dataTables_wrapper .dataTables_processing,
        .dataTables_wrapper .dataTables_paginate {
            margin-bottom: 2rem;
            margin-top: 2rem;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            box-sizing: border-box;
            display: inline-block;
            min-width: 1.5em;
            padding: .5em 1em;
            margin-left: 2px;
            text-align: center;
            text-decoration: none !important;
            cursor: pointer;
            color: inherit !important;
            border: 1px solid transparent;
            border-radius: 2px;
            background: transparent;
        }

        /* Cambia el color de fondo al pasar el ratón sobre los botones */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background-color: red;
        }

        /* Cambia el color del texto al pasar el ratón sobre los botones */
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover a {
            color: white;
        }
    </style>

    <nav class="fixed top-0 z-50 w-full border-b border-gray-200 bg-gray-50">
        <div class="px-3 py-3 sm:py-0 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button data-drawer-target="logo-sidebar" data-drawer-toggle="logo-sidebar" aria-controls="logo-sidebar" type="button" class="inline-flex items-center p-2 text-sm rounded-lg sm:hidden hover:bg- focus:outline-none focus:ring-2 bg-gray-50 border border-gray-200 text-gray-900 focus:bg-blue-400">
                        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
                        </svg>
                    </button>
                    <div class="flex ml-2 md:mr-24">
                        <!--Puede ir otra imagen aqui-->
                    </div>
                </div>
                <div class="flex items-center">
                    <div class="flex items-center">
                        <div class="flex ml-2 md:mr-23">
                            <!--<img src="/images/logo.png" class="h-12 mr-3 md:h-20" />-->
                        </div>
                    </div>
                </div>
            </div>
    </nav>


    <aside id="logo-sidebar" class="fixed overflow-y-auto top-0 left-0 z-40 w-64 h-screen pt-24 md:pt-10 transition-transform -translate-x-full bg-white border-r border-gray-200 sm:translate-x-0" aria-label="Sidebar">
        <div class="md:w-[8rem] w-[5rem] mb-[2rem] ml-[5rem] flex md:ml-[4rem]">
            <a href="">
                <img src="{{ asset('images/Nebula.png') }}" />
            </a>
        </div>
        <div class="h-full md:mt-10 px-3 pb-4 bg-white">
            <ul class="space-y-7 md:space-y-5 font-medium">
                @if(session('fkTipoUsuario') == 1||session('fkTipoUsuario') == 2)
                <li>
                    <a href="{{ url('/tuInicio') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-blue-400">
                        <svg class="flex-shrink-0 w-10 h-5 text-gray-900 transition duration-75" width="800px" height="800px" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g id="Navigation / House_01">
                                <path id="Vector" d="M20 17.0002V11.4522C20 10.9179 19.9995 10.6506 19.9346 10.4019C19.877 10.1816 19.7825 9.97307 19.6546 9.78464C19.5102 9.57201 19.3096 9.39569 18.9074 9.04383L14.1074 4.84383C13.3608 4.19054 12.9875 3.86406 12.5674 3.73982C12.1972 3.63035 11.8026 3.63035 11.4324 3.73982C11.0126 3.86397 10.6398 4.19014 9.89436 4.84244L5.09277 9.04383C4.69064 9.39569 4.49004 9.57201 4.3457 9.78464C4.21779 9.97307 4.12255 10.1816 4.06497 10.4019C4 10.6506 4 10.9179 4 11.4522V17.0002C4 17.932 4 18.3978 4.15224 18.7654C4.35523 19.2554 4.74432 19.6452 5.23438 19.8482C5.60192 20.0005 6.06786 20.0005 6.99974 20.0005C7.93163 20.0005 8.39808 20.0005 8.76562 19.8482C9.25568 19.6452 9.64467 19.2555 9.84766 18.7654C9.9999 18.3979 10 17.932 10 17.0001V16.0001C10 14.8955 10.8954 14.0001 12 14.0001C13.1046 14.0001 14 14.8955 14 16.0001V17.0001C14 17.932 14 18.3979 14.1522 18.7654C14.3552 19.2555 14.7443 19.6452 15.2344 19.8482C15.6019 20.0005 16.0679 20.0005 16.9997 20.0005C17.9316 20.0005 18.3981 20.0005 18.7656 19.8482C19.2557 19.6452 19.6447 19.2554 19.8477 18.7654C19.9999 18.3978 20 17.932 20 17.0002Z" stroke="#000000" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </g>
                        </svg>
                        <span class="flex-1 whitespace-nowrap">Inicio</span>
                    </a>
                </li>
                @endif


                @if(session('fkTipoUsuario') == 1 || session('fkTipoUsuario') == 2)
                <li>
                    <a href="{{ url('/articulesList') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-blue-400">
                        <svg class="flex-shrink-0 w-10 h-5 text-gray-900 transition duration-75" width="800px" height="800px" viewBox="0 0 24 24" id="meteor-icon-kit__regular-inventory" fill="currentColor" xmlns="http://www.w3.org/2000/svg">

                            <g clip-path="url(#clip0_525_147)">

                                <path fill-rule="evenodd" clip-rule="evenodd" d="M2 1C2 0.447715 1.55228 0 1 0C0.447715 0 0 0.447715 0 1V23C0 23.5523 0.447715 24 1 24C1.55228 24 2 23.5523 2 23V22H22V23C22 23.5523 22.4477 24 23 24C23.5523 24 24 23.5523 24 23V1C24 0.447715 23.5523 0 23 0C22.4477 0 22 0.447715 22 1V8H20V3C20 2.44772 19.5523 2 19 2H11C10.4477 2 10 2.44772 10 3V4H5C4.44772 4 4 4.44772 4 5V8H2V1ZM10 6H6V8H10V6ZM2 10V20H4V13C4 12.4477 4.44772 12 5 12H13C13.5523 12 14 12.4477 14 13V14H19C19.5523 14 20 14.4477 20 15V20H22V10H2ZM18 8V4H12V8H18ZM12 20H6V14H12V20ZM14 20V16H18V20H14Z" fill="currentColor" />

                            </g>

                            <defs>

                                <clipPath id="clip0_525_147">

                                    <rect width="24" height="24" fill="white" />

                                </clipPath>

                            </defs>

                        </svg>
                        <span class="flex-1 whitespace-nowrap">Inventario</span>
                    </a>
                </li>

                @endif





                <!-- divisor sidebar -->
                <ul class="pt-4 mt-4 space-y-2 font-medium border-t border-gray-200">
                    <li>
                        <a href="{{ route('logout') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-blue-400">
                            <svg class="flex-shrink-0 w-8 h-5 text-gray-900 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 16">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 8h11m0 0L8 4m4 4-4 4m4-11h3a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-3" />
                            </svg>
                            <span class="flex-1 ml-3 whitespace-nowrap">Cerrar sesión</span>
                        </a>
                    </li>
                </ul>
        </div>
    </aside>
    <script src="../node_modules/flowbite/dist/flowbite.min.js"></script>
    <script src="../node_modules/flowbite/dist/datepicker.js"></script>
</body>

</html>