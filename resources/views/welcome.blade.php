<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Talleres - Hilari Web</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" ><i class="fas fa-car text-info"></i> SIS Taller <i class="fas fa-tools text-info"></i></a>
            <div class="ms-auto">
                <a href="{{ url('/login') }}" class="btn btn-warning"><i class="fas fa-sign-in-alt"></i> Iniciar Sesión</a>
            </div>
        </div>
    </nav>

    <!-- Carrusel -->
    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="https://images.unsplash.com/photo-1640291167497-d9e994ad2b52?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8OHx8bWVjaGFuaWMlMjB0YWxsZXJ8ZW58MHx8MHx8fDA%3D" class="d-block w-100" alt="Taller 1">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1640291168317-9d962e809022?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8M3x8bWVjaGFuaWMlMjB0YWxsZXJ8ZW58MHx8MHx8fDA%3D" class="d-block w-100" alt="Taller 2">
            </div>
            <div class="carousel-item">
                <img src="https://images.unsplash.com/photo-1640291168314-8869c50909ef?w=500&auto=format&fit=crop&q=60&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxzZWFyY2h8N3x8bWVjaGFuaWMlMjB0YWxsZXJ8ZW58MHx8MHx8fDI%3D" class="d-block w-100" alt="Taller 3">
            </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample" data-bs-slide="prev">
            <span class="carousel-control-prev-icon"></span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample" data-bs-slide="next">
            <span class="carousel-control-next-icon"></span>
        </button>
    </div>

    <!-- Sobre Nosotros -->
    <section class="py-5 bg-light text-center">
        <div class="container">
            <h2 class="mb-4">Sobre Nosotros</h2>
            <p>En nuestro taller, no solo reparamos vehículos: restauramos confianza, devolvemos tranquilidad y cuidamos de lo que te mueve cada día. Somos un equipo de técnicos apasionados por la mecánica y comprometidos con hacer bien cada trabajo desde el primer tornillo hasta el último detalle. <br>

Con años de experiencia en el rubro automotriz, ofrecemos un servicio honesto, transparente y con atención personalizada. Sabemos que dejar tu vehículo en manos de alguien más no es fácil, por eso tratamos cada auto como si fuera nuestro. <br>

Realizamos diagnósticos precisos, explicamos cada reparación con claridad y cumplimos con los tiempos establecidos. Ya sea una simple revisión, un mantenimiento completo o una reparación mayor, nos esforzamos para que vuelvas a la carretera con total seguridad. <br>

Nuestro compromiso no termina cuando el vehículo sale del taller. Queremos que nuestros clientes regresen, no por una falla, sino porque confían en nosotros. Por eso, más que un servicio, ofrecemos una relación basada en responsabilidad, calidad y respeto.

Bienvenido a nuestro taller, donde la mecánica es nuestro oficio y tu satisfacción, nuestra prioridad.</p>
        </div>
    </section>
    <!-- Buscar Trabajo por Código -->
    <section class="py-5 text-center" id="buscar">
        <div class="container">
            <h2 class="mb-4"><i class="fas fa-cogs"></i> Consultar Trabajo</h2>
            @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
            @endif
            <form action="{{ url('/buscar-trabajo') }}" method="GET" class="d-flex justify-content-center">
                <input type="text" name="codigo" placeholder="Ingrese código de seguimiento" class="form-control w-25 me-2" required>
                <button type="submit" class="btn btn-primary"><i class="fas fa-search"></i> Buscar</button>
            </form>
        </div>
    </section>

    <!-- Contacto -->
    <section class="py-5 bg-dark text-white text-center">
        <div class="container">
            <h2>Contáctanos</h2>
            <p>Email: contacto@sistaller.com | Tel: 123-456-789</p>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
