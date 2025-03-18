<!DOCTYPE html>
<html>
<head>
    <title>Bienes de {{ $area->nombre }}</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
    </style>
</head>
<body>
    <h1>Bienes de {{ $area->nombre }}</h1>

    <h2>Resumen de Bienes</h2>
    <table>
        <thead>
            <tr>
                <th>Oficina</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($resumenBienes as $grupo)
                <tr>
                    <td>{{ $grupo->ubicacioncompleta }}</td>
                    <td>{{ $grupo->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div style="page-break-after: always;"></div>

    <h2>Lista de Bienes</h2>
    <table>
        <thead>
            <tr>
                <th>Oficina</th>
                <th>Responsable</th>
                <th>Cod Bien</th>
                <th>Descripción</th>
                <th>Color</th>
                <th>Estado</th>
                <th>Marca</th>
                <th>Modelo</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($bienes as $bien)
                <tr>
                    <td>{{ $bien->ubicacioncompleta }}</td>
                    <td>{{ $bien->nombrecompleto }}</td>
                    <td>{{ $bien->codbien }}</td>
                    <td>{{ $bien->descripcio }}</td>
                    <td>{{ $bien->color }}</td>
                    <td>{{ $bien->est_bien }}</td>
                    <td>{{ $bien->marca }}</td>
                    <td>{{ $bien->modelo }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>