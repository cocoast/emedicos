<!DOCTYPE html>
<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> @yield('title')</title>
    <link rel="stylesheet" href="{{ base_path('public/vendor/adminlte/dist/css/adminlte.min.css') }}">
    <style>
        .table-striped>tbody>tr {
            color: #538135;

        }

        .table-striped>tbody>tr>td,
        .table-striped>tbody>tr>th {
            border: 1px solid green;
        }

        .table-striped>tbody>tr:nth-child(odd)>td,
        .table-striped>tbody>tr:nth-child(odd)>th {
            background-color: #e2efd9;
        }

        @yield('style') @media print {
            footer {
                page-break-after: always;
            }
        }
    </style>
</head>

<body>

    <!--  Content Header -->
    <div class="container" id="widget">

        <div class="d-flex justify-content-between text-center">
            <table>
                <tr>
                    <td>
                        <img id="ministerio" src="{{ base_path('public/img/ministerio.png') }}" width="150" alt="Logo">
                    </td>
                    <td>
                        <h3 class="p-2">

                            @yield('content_header')

                        </h3>
                    </td>
                    <td style="vertical-align:top">
                        <img src="{{ base_path('public/img/hpm.jpg') }}" width="200" alt="">
                    </td>
                </tr>
            </table>
        </div>

        <!--  Subtitle Document -->
        @yield('subtitle')


        <!--  Body Document -->

        @yield('body')


    </div>

</body>

</html>