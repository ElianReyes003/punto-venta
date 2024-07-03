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
                @if(session('fkTipoUsuario') == 1 || session('fkTipoUsuario') == 2 )		

            <li>
              <a  href="{{ url('/seleccionCompra') }}"   class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-blue-400">
                  <svg class="flex-shrink-0 w-10 h-5 text-gray-900 transition duration-75" version="1.1" id="Icons" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                  viewBox="0 0 32 32" xml:space="preserve">
              <style type="text/css">
                  .st0{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;}
                  
                      .st1{fill:none;stroke:#000000;stroke-width:2;stroke-linecap:round;stroke-linejoin:round;stroke-miterlimit:10;stroke-dasharray:3;}
                  .st2{fill:none;stroke:#000000;stroke-width:2;stroke-linejoin:round;stroke-miterlimit:10;}
                  .st3{fill:none;}
              </style>
              <path class="st0" d="M6,7L6,7c-1.7,0-3,1.3-3,3v16c0,1.7,1.3,3,3,3h10c1.7,0,3-1.3,3-3V10c0-1.7-1.3-3-3-3h0"/>
              <path class="st0" d="M6,5v12h10V5c0-1.1-0.9-2-2-2H4C5.1,3,6,3.9,6,5z"/>
              <line class="st0" x1="8" y1="25" x2="14" y2="25"/>
              <path class="st0" d="M19,10h8c1.1,0,2,0.9,2,2v10c0,1.1-0.9,2-2,2h-7"/>
              <line class="st0" x1="29" y1="14" x2="20" y2="14"/>
              <rect x="23" y="18" transform="matrix(-1.836970e-16 1 -1 -1.836970e-16 44 -4)" class="st0" width="2" height="4"/>
              <line class="st0" x1="11" y1="6" x2="11" y2="7"/>
              <line class="st0" x1="11" y1="13" x2="11" y2="14"/>
              <path class="st0" d="M12,7h-1.5C9.7,7,9,7.7,9,8.5v0C9,9.3,9.7,10,10.5,10h1c0.8,0,1.5,0.7,1.5,1.5v0c0,0.8-0.7,1.5-1.5,1.5H10"/>
              <rect x="-72" y="-432" class="st3" width="536" height="680"/>
              </svg>
                  <span class="flex-1 whitespace-nowrap">Venta</span>
              </a>
            </li>
@endif

                @if(session('fkTipoUsuario') == 1)	
            <li>
               <a href="{{ url('/allEmployees') }}"  class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-blue-400">
                    <svg class="flex-shrink-0 w-10 h-5 text-gray-900 transition duration-75" fill="#000000" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" 
                        viewBox="0 0 480.16 480.16" xml:space="preserve">
                    <g>
                        <g>
                            <g>
                                <rect x="221.837" y="383.75" width="58.118" height="20"/>
                                <path d="M394.438,330.221c-11.215-3.841-28.098-10.968-35.499-16.463v-18.566c25.231-14.443,42.65-39.743,48.906-70.967
                                    c16.126-3.851,27.455-19.682,27.455-34.038c0-13.424-9.503-22.888-24.922-25.686v-11.417c0.137-4.198,1.055-53.931-30.314-86.589
                                    c-17.506-18.226-41.394-27.467-71-27.467c-29.555,0-53.291,9.076-70.72,27.005c-17.404-17.926-41.069-27.005-70.538-27.005
                                    c-29.699,0-53.638,9.263-71.151,27.532c-31.279,32.627-30.31,82.223-30.163,86.527v11.414
                                    c-15.418,2.798-24.922,12.262-24.922,25.686c0,14.36,11.335,30.197,27.469,34.042c6.16,30.474,22.974,55.408,47.197,69.997
                                    v16.367c-7.242,6.294-22.037,15.04-31.184,19.878C1.877,357.64,0.039,407.985,0.002,410.122C0.001,410.18,0,410.239,0,410.297
                                    v20.835c0,5.523,4.478,10,10,10h460.16c5.522,0,10-4.477,10-10v-20.878C480.15,408.093,478.96,357.045,394.438,330.221z
                                    M410.379,185.053c2.727,0.945,4.922,2.516,4.922,5.134c0,3.149-1.92,7.183-4.954,10.267
                                    C410.356,199.823,410.379,185.053,410.379,185.053z M61.57,190.187c0-2.618,2.195-4.189,4.922-5.134
                                    c0,0,0.023,14.77,0.032,15.401C63.49,197.37,61.57,193.336,61.57,190.187z M390.38,198.56L390.38,198.56
                                    c-0.001,4.898-0.341,9.958-1.008,15.01c-4.116,30.462-20.451,54.744-44.813,66.618c-0.041,0.02-0.081,0.04-0.122,0.06
                                    c-10.527,5.309-22.428,8-35.372,8c-12.944,0-24.845-2.692-35.372-8c-0.051-0.025-0.102-0.05-0.153-0.075
                                    c-8.45-4.082-16.004-9.801-22.551-16.996c7.409-11.404,12.736-24.62,15.669-38.943c16.143-3.838,27.486-19.681,27.486-34.046
                                    c0-13.424-9.503-22.888-24.922-25.686v-8.265c15.191-3.265,31.633-8.48,40.026-18.001c14.767,8.324,44.369,22.158,81.132,24.366
                                    V198.56z M338.939,303.914v10.582c-2.238,2.308-6.475,6-12.619,8.487c-4.306,1.757-9.005,2.648-13.967,2.648
                                    c-6.421,0-13.067-1.467-19.722-4.347c-5.879-2.569-10.562-5.696-13.442-7.849v-9.521c9.386,2.874,19.38,4.333,29.875,4.333
                                    C319.56,308.247,329.553,306.788,338.939,303.914z M276.312,335.415l-1.506,4.419c-3.64-1.695-7.439-3.311-11.417-4.854
                                    c2.109-1.242,4.162-2.535,6.08-3.899C271.407,332.434,273.706,333.922,276.312,335.415z M259.189,295.196v18.616
                                    c-4.441,3.444-11.615,7.102-17.131,9.914c-0.605,0.309-1.202,0.613-1.789,0.914c-9.23-5.344-16.602-10.304-20.893-14.044v-16.361
                                    c7.002-4.205,13.374-9.28,19.061-15.18C244.666,285.465,251.608,290.862,259.189,295.196z M269.189,200.454
                                    c0.009-0.631,0.032-15.401,0.032-15.401c2.728,0.945,4.922,2.517,4.922,5.134C274.143,193.336,272.223,197.37,269.189,200.454z
                                    M309.064,59.028c23.905,0,42.913,7.145,56.495,21.237c18.603,19.301,23.31,47.435,24.472,62.253
                                    c-45.345-3.252-79.016-26.631-79.363-26.876c-3.051-2.166-7.056-2.45-10.379-0.733c-3.324,1.716-5.413,5.145-5.413,8.886
                                    c0,1.304-5.044,6.971-26.575,12.115c-1.556-14.247-5.868-35.021-17.517-53.846C264.553,66.787,284.117,59.028,309.064,59.028z
                                    M111.093,80.4c13.595-14.182,32.677-21.373,56.714-21.373c27.445,0,48.393,9.444,62.256,28.068
                                    c14.1,18.957,17.8,43.033,18.756,55.417c-45.338-3.267-79.07-26.633-79.417-26.878c-3.051-2.162-7.055-2.441-10.374-0.725
                                    c-3.322,1.717-5.408,5.144-5.408,8.883c0,1.444-6.275,8.482-35.269,14.045c-11.615,2.229-23.361,3.545-31.527,4.277
                                    C87.978,127.268,92.666,99.622,111.093,80.4z M87.503,213.599c-0.671-5.074-1.011-10.134-1.011-15.039v-36.332
                                    c8.608-0.722,21.951-2.134,35.44-4.712c9.744-1.862,34.666-6.624,45.964-19.345c14.751,8.315,44.457,22.215,81.324,24.429v35.959
                                    c0,4.898-0.34,9.958-1.001,14.972c-2.356,16.946-8.554,32.257-17.921,44.276c-0.038,0.049-0.075,0.098-0.112,0.147
                                    c-6.985,9.314-15.703,16.646-25.998,21.839c-10.858,5.61-23.099,8.454-36.382,8.454c-13.284,0-25.524-2.844-36.447-8.488
                                    C107.603,267.706,91.614,243.573,87.503,213.599z M199.376,303.399v7.46c-2.858,2.828-8.279,7.572-15.421,10.952
                                    c-10.683,5.07-21.608,5.073-32.307-0.004c-7.122-3.371-12.55-8.122-15.412-10.952v-7.461c9.905,3.221,20.469,4.854,31.571,4.854
                                    C178.918,308.248,189.491,306.612,199.376,303.399z M20,421.133v-10.61c0.071-1.069,0.909-10.065,9.313-21.672
                                    c15.131-20.899,63.773-40.009,64.274-40.271c2.436-1.273,20.149-10.647,32.291-20.075c2.527,2.197,5.662,4.641,9.306,6.977
                                    l-10.061,30.184c-0.684,2.051-0.684,4.269-0.001,6.32l16.356,49.147H20z M173.057,421.133h-10.5L145.15,368.83l8.376-25.127
                                    c9.448,2.506,19.118,2.505,28.561,0.001l8.376,25.126L173.057,421.133z M315.611,416.948l-1.395,4.184H194.135l16.356-49.147
                                    c0.683-2.051,0.683-4.269-0.002-6.32l-10.062-30.184c3.639-2.333,6.771-4.772,9.295-6.966
                                    c7.537,5.851,17.393,11.749,25.436,16.22c4.094,2.353,6.88,3.8,6.997,3.861c0.504,0.261,1.028,0.479,1.568,0.651
                                    c12.328,3.927,22.779,8.328,31.981,13.473c38.138,21.141,39.838,46.08,39.907,47.705V416.948z M326.849,383.369
                                    c-6.125-10.506-16.533-22.684-34.212-33.856l2.152-6.313c5.871,1.612,11.748,2.432,17.565,2.432c3.854,0,7.624-0.365,11.28-1.08
                                    l8.085,24.265L326.849,383.369z M460.16,421.132H335.612v-0.891L351.744,372c0.687-2.053,0.689-4.274,0.006-6.329l-9.455-28.441
                                    c2.96-1.82,5.486-3.73,7.554-5.525c13.23,8.686,33.465,15.851,38.227,17.476c0.07,0.024,48.005,18.605,62.989,39.514
                                    c8.438,11.773,9.056,20.895,9.095,21.738V421.132z"/>
                                <rect x="362.995" y="383.75" width="58.118" height="20"/>
                            </g>
                        </g>
                    </g>
                    </svg>
                  <span class="flex-1 whitespace-nowrap">Empleados</span>
                  <span class="inline-flex items-center justify-center px-2 ml-1 text-sm font-medium text-gray-800 bg-blue-100 rounded-full">Jefe</span>
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
                @if(session('fkTipoUsuario') == 1)		
			 <li>
                <a href="{{ url('/historialCompras') }}" class="flex items-center p-2 text-gray-900 rounded-lg hover:bg-blue-400">
                    <svg class="flex-shrink-0 w-10 h-5 text-gray-900 transition duration-75" width="800px" height="800px" viewBox="0 0 48 48" xmlns="http://www.w3.org/2000/svg">
                        <g id="Layer_2" data-name="Layer 2">
                          <g id="invisible_box" data-name="invisible box">
                            <rect width="48" height="48" fill="none"/>
                          </g>
                          <g id="Layer_7" data-name="Layer 7">
                            <g>
                              <path d="M34.3,20.1h0a6.7,6.7,0,0,1-4.1-1.3,2,2,0,0,0-2.8.6,1.8,1.8,0,0,0,.3,2.6A10.9,10.9,0,0,0,32,23.8V26a2,2,0,0,0,4,0V23.8a6.3,6.3,0,0,0,3-1.3,4.9,4.9,0,0,0,2-4h0c0-3.7-3.4-4.9-6.3-5.5s-3.5-1.3-3.5-1.8.2-.6.5-.9a3.4,3.4,0,0,1,1.8-.4,6.3,6.3,0,0,1,3.3.9,1.8,1.8,0,0,0,2.7-.5,1.9,1.9,0,0,0-.4-2.8A9.1,9.1,0,0,0,36,6.3V4a2,2,0,0,0-4,0V6.2c-3,.5-5,2.5-5,5.2s3.3,4.9,6.5,5.5,3.3,1.3,3.3,1.8S35.7,20.1,34.3,20.1Z"/>
                              <path d="M42.2,31.7a5.2,5.2,0,0,0-4-1.1l-9.9,1.8a4.5,4.5,0,0,0-1.4-3.3L19.8,22H5a2,2,0,0,0-2,2v9a2,2,0,0,0,2,2H8.3l11.2,9.1,20.4-3.7a5,5,0,0,0,2.3-8.7Zm-3,4.8L20.5,39.9,10,31.2V26h8.2l5.9,5.9a.8.8,0,0,1-1.2,1.2l-3.5-3.5a2,2,0,0,0-2.8,2.8l3.5,3.5a4.5,4.5,0,0,0,3.4,1.4,5.7,5.7,0,0,0,1.8-.3h0l13.6-2.4a1.1,1.1,0,0,1,.8.2.9.9,0,0,1,.3.7A1,1,0,0,1,39.2,36.5Z"/>
                            </g>
                          </g>
                        </g>
                      </svg>
                   <span class="flex-1 whitespace-nowrap">Historial Ventas </span>
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