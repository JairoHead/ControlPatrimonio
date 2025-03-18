<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Historial</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #444; padding: 4px; text-align: center; }
        th { background-color: #eee; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Historial de Reportes (Filtro: {{ $search }})</h1>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Código Bien</th>
                <th>Acción</th>
                <th>Fecha</th>
                <th>Detalle</th>
                <th>Descripción</th>
                <th>Color</th>
                <th>Estado</th>
                <th>Marca</th>
                <th>Modelo</th>
                <th>Serie</th>
                <th>Fecha Registro</th>
                <th>Inventariado</th>
                <th>Ubicación</th>
                <th>Responsable</th>
            </tr>
        </thead>
        <tbody>
            @foreach($historial as $h)
                <tr>
                    <td>{{ $h->id }}</td>
                    <td>{{ $h->codigo }}</td>
                    <td>{{ $h->accion }}</td>
                    <td>{{ $h->fecha }}</td>
                    <td>{{ $h->detalle }}</td>
                    <td>{{ $h->migData->descripcio }}</td>
                    <td>{{ $h->migData->color }}</td>
                    <td>{{ $h->migData->est_bien }}</td>
                    <td>{{ $h->migData->marca }}</td>
                    <td>{{ $h->migData->modelo }}</td>
                    <td>{{ $h->migData->serie }}</td>  
                    <td>{{ $h->migData->fec_reg }}</td>
                    <td>{{ $h->migData->inventariado }}</td>
                    <td>{{ $h->migData->ubicacioncompleta }}</td>
                    <td>{{ $h->migData->nombrecompleto }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
