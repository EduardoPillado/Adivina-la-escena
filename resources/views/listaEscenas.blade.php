<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="{{ asset('img/LOGOTIPO.ico') }}" rel="icon">
    <title>Escenas</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Comic+Sans+MS&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.9/css/responsive.dataTables.min.css">
    
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/paginationjs/2.1.5/pagination.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.6/api/fnMultiFilter.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>
    <style>
        .fondo-opaco-amarillo {
            background-image: linear-gradient(rgba(255, 255, 0, 0.5), rgba(255, 255, 0, 0.5)), url('/img/fondo.png');
            background-size: cover;
            background-position: center;
        }
        
        html, body {
            height: 100%;
            margin: 0;
        }

        td {
            padding: 0px 20px 10px 0px;
        }

        td a {
            margin: 0px 10px 0px 0px;
        }
        
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
        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing {
            color: inherit;
            margin-left: 3rem;
            display: none;
        }
        div#miTabla_info {
            display: none;
        }
        .dataTables_wrapper .dataTables_length, .dataTables_wrapper .dataTables_filter, .dataTables_wrapper .dataTables_info, .dataTables_wrapper .dataTables_processing, .dataTables_wrapper .dataTables_paginate {
            margin-bottom: 2rem;
            margin-top: 2rem;
        }

        #tabla-opciones {
            margin-top: 1.5% !important;
        }
    </style>
</head>
<body class="bg-cover pt-0 pb-0 bg-center bg-repeat font-comic-sans font-bold fondo-opaco-amarillo">

    @include('mensaje')
    @include('header')

    <div class="bg-yellow-100 p-6 rounded-lg mx-auto max-w-5xl">
        <h2 class="text-xl font-bold mb-4 text-center">Escenas registradas</h2>
        <div class="flex mb-4">
            <input id="busqueda" class="shadow appearance-none border rounded py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline mr-2 flex-grow" type="text" placeholder="Buscar" />
            <button class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded focus:outline-none focus:shadow-outline">
                Buscar
            </button>
        </div>
        <div class="bg-white shadow-md rounded-lg p-4">
            <table id="escenas" class="display nowrap">
                <thead>
                    <tr>
                        <th class="font-bold">Escena</th>
                        <th class="font-bold">Categoría</th>
                        <th class="font-bold">Opciones</th>
                        <th class="font-bold">Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($datosMultimedia as $dato)
                        <tr>
                            <td>
                                <video controls width="250">
                                    <source src="{{ asset('storage/'.$dato->nombreMultimedia) }}" type="video/mp4">
                                </video>
                            </td>
                            <td>{{$dato->categoria->nombreCategoria}}</td>

                            <td>
                                <table id="tabla-opciones">
                                    <thead>
                                        <tr>
                                            <th>Opción</th>
                                            <th>Tipo de opción</th>
                                        </tr>
                                    </thead>
                                    @foreach ($dato->opciones as $opcion)
                                        <tr>
                                            <td>{{$opcion->nombreOpcion}}</td>
                                            <td>
                                                @if($opcion->estatusOpcion == 1)
                                                    Correcta
                                                @elseif($opcion->estatusOpcion == 0)
                                                    Incorrecta
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </td>

                            <td class="flex justify-around">
                                <a title="Editar datos" href="{{ route('multimedia.mostrarPorId', $dato->pkMultimedia) }}" 
                                    class="bg-green-500 hover:bg-green-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                    <i class="bi bi-pencil-square"></i>
                                </a>
                                <a title="Dar de baja" href="{{ route('multimedia.baja', $dato->pkMultimedia) }}" onclick="confirmarBaja(event)" class="bg-yellow-500 hover:bg-yellow-700 text-white font-bold py-1 px-2 rounded focus:outline-none focus:shadow-outline">
                                    <svg class="flex-shrink-0 w-7 h-7 text-white transition duration-75 group-hover:text-yellow-" xmlns="http://www.w3.org/2000/svg" fill="currentColor" width="800px" height="800px" viewBox="0 0 24 24">
                                        <path d="M6 19c0 1.1.9 2 2 2h8c1.1 0 2-.9 2-2V7H6v12zm2.46-7.12l1.41-1.41L12 12.59l2.12-2.12 1.41 1.41L13.41 14l2.12 2.12-1.41 1.41L12 15.41l-2.12 2.12-1.41-1.41L10.59 14l-2.13-2.12zM15.5 4l-1-1h-5l-1 1H5v2h14V4z"/> 
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        $(document).ready(function () {
            var table = $('#escenas').DataTable({
                
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
                    }
            });

            $('#busqueda').on('keyup', function (e) {
                var filtroBusqueda = $('#busqueda').val();
                table.search(filtroBusqueda).draw();
            });
        });

        function confirmarBaja(event) {
            event.preventDefault();

            const link = event.target.closest('a');

            if (link) {
                Swal.fire({
                    title: '¿Seguro?',
                    text: '¿Desea dar de baja esta escena?',
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, dar de baja',
                    cancelButtonText: 'Cancelar',
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.location.href = link.href;
                    }
                });
            }
        }
    </script>

</body>
</html>