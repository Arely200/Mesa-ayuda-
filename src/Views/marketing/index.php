<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Mesa de Ayuda' ?></title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: 'Segoe UI', sans-serif; background: #f5f5f5; }
        .hero {
            background: linear-gradient(135deg, #0D47A1, #1E88E5);
            color: #fff;
            padding: 80px 20px;
            text-align: center;
        }
        .hero h1 { font-size: 48px; margin-bottom: 16px; }
        .hero p { font-size: 20px; opacity: 0.9; max-width: 600px; margin: 0 auto 32px; }
        .btn {
            display: inline-block;
            padding: 14px 40px;
            background: #fff;
            color: #0D47A1;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
            font-size: 16px;
        }
        .btn:hover { background: #f0f0f0; }
        .content { max-width: 1200px; margin: 0 auto; padding: 40px 20px; }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 24px;
            margin: 40px 0;
        }
        .feature {
            background: #fff;
            padding: 24px;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0,0,0,0.06);
            text-align: center;
        }
        .feature .icon { font-size: 40px; margin-bottom: 12px; }
        .feature h3 { color: #212121; margin-bottom: 8px; }
        .feature p { color: #757575; font-size: 14px; }
        .footer {
            background: #0D47A1;
            color: #fff;
            text-align: center;
            padding: 24px;
            margin-top: 40px;
        }
        .btn-login {
            display: inline-block;
            padding: 14px 40px;
            background: #1E88E5;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-weight: 600;
        }
        .btn-login:hover { background: #1565C0; }
    </style>
</head>
<body>

<div class="hero">
    <h1>🎯 Mesa de Ayuda</h1>
    <p>Gestión eficiente de tickets para tu organización</p>
    <a href="/login" class="btn-login">🔐 Iniciar Sesión</a>
</div>

<div class="content">
    <h2 style="text-align:center;color:#212121;">¿Por qué usar Mesa de Ayuda?</h2>
    <div class="features">
        <div class="feature">
            <div class="icon">⚡</div>
            <h3>Rápido</h3>
            <p>Resuelve tickets en minutos con nuestro sistema optimizado</p>
        </div>
        <div class="feature">
            <div class="icon">🔒</div>
            <h3>Seguro</h3>
            <p>Protege los datos sensibles con encriptación y autenticación</p>
        </div>
        <div class="feature">
            <div class="icon">📊</div>
            <h3>Reportes</h3>
            <p>Estadísticas en tiempo real y exportación a Excel</p>
        </div>
        <div class="feature">
            <div class="icon">📱</div>
            <h3>Acceso</h3>
            <p>Desde cualquier dispositivo, en cualquier lugar</p>
        </div>
    </div>
</div>

<div class="footer">
    <p>Sistema de Mesa de Ayuda v1.0 &copy; <?= date('Y') ?></p>
</div>

</body>
</html>
