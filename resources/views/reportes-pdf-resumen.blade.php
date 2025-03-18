<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Reporte Resumen</title>
    <style>
        body { font-family: sans-serif; font-size: 12px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        th, td { border: 1px solid #444; padding: 4px; text-align: center; }
        th { background-color: #eee; }
        h1 { text-align: center; }
    </style>
</head>
<body>
    <h1>Resumen de Bienes (Filtro: {{ $search }})</h1>
    <table>
        <thead>
            <tr>
                <th>Área</th>
                <th>Ubicación</th>
                <th>Responsable</th>
                <th>Cantidad</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resumen as $r)
                <tr>
                    <td>{{ $r->codarea }}</td>
                    <td>{{ $r->ubicacioncompleta }}</td>
                    <td>{{ $r->nombrecompleto }}</td>
                    <td>{{ $r->total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
