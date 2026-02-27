<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Gastos</title>

    <!-- 🔹 BOOTSTRAP 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<div class="container mt-4">

    <h1 class="mb-3">Registro de Gastos del Día</h1>

    <!-- 🔹 MENSAJES DE VALIDACIÓN -->
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <!-- 🔹 FORMULARIO DE REGISTRO -->
    <form class="row g-2 mb-3" action="{{ route('gastos.store') }}" method="POST">
        @csrf
        <div class="col-md-6">
            <input class="form-control" type="text" name="descripcion" placeholder="Descripción del gasto" required>
        </div>
        <div class="col-md-4">
            <input class="form-control" type="number" name="monto" step="0.01" placeholder="Monto" required>
        </div>
        <div class="col-md-2">
            <button class="btn btn-primary w-100">Agregar</button>
        </div>
    </form>

    <!-- 🔹 BOTÓN LIMPIAR -->
    <form action="{{ route('gastos.limpiar') }}" method="POST" class="mb-4">
        @csrf
        <button class="btn btn-danger">Limpiar gastos</button>
    </form>

    <!-- 🔹 TABLA DE GASTOS -->
    <h2 class="mb-3">Gastos Registrados</h2>

    <table class="table table-bordered table-striped">
        <thead class="table-light">
            <tr>
                <th>Descripción</th>
                <th>Monto</th>
                <th>Fecha</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($gastos as $gasto)
                <tr>
                    <td>{{ $gasto['descripcion'] }}</td>
                    <td>${{ number_format($gasto['monto'], 2) }}</td>
                    <td>{{ $gasto['fecha'] ?? '—' }}</td>
                </tr>
            @empty
                <tr>
                    <td colspan="3" class="text-center text-muted">
                        No hay gastos registrados
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <!-- 🔹 TOTAL -->
    <h4>Total del día: <strong>${{ number_format($total, 2) }}</strong></h4>

</div>

</body>
</html>
