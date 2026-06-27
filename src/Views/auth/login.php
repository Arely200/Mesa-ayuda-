<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $titulo ?? 'Iniciar Sesion' ?> - Mesa de Ayuda</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body {
            font-family: 'Segoe UI', sans-serif;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #0D47A1, #1E88E5);
            padding: 20px;
        }
        .login-container {
            background: #fff;
            border-radius: 16px;
            padding: 48px 40px;
            width: 100%;
            max-width: 420px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
        }
        .logo { text-align: center; margin-bottom: 32px; }
        .logo h1 { font-size: 24px; color: #0D47A1; }
        .logo p { font-size: 14px; color: #757575; }
        .alert {
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 14px;
        }
        .alert-error { background: #FFEBEE; color: #C62828; border: 1px solid #FFCDD2; }
        .alert-success { background: #E8F5E9; color: #2E7D32; border: 1px solid #C8E6C9; }
        .form-group { margin-bottom: 20px; }
        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #212121;
            margin-bottom: 6px;
        }
        .form-group input {
            width: 100%;
            padding: 12px 16px;
            border: 2px solid #E0E0E0;
            border-radius: 8px;
            font-size: 15px;
            transition: border-color 0.3s;
        }
        .form-group input:focus {
            outline: none;
            border-color: #1E88E5;
            box-shadow: 0 0 0 4px rgba(30,136,229,0.1);
        }
        .btn-primary {
            width: 100%;
            padding: 14px;
            background: #1E88E5;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: background 0.3s;
        }
        .btn-primary:hover { background: #1565C0; }
        .login-footer { text-align: center; margin-top: 20px; font-size: 14px; color: #757575; }
        .login-footer a { color: #1E88E5; text-decoration: none; }
        .version { text-align: center; margin-top: 24px; font-size: 12px; color: #BDBDBD; }
    </style>
</head>
<body>
<div class="login-container">
    <div class="logo">
        <h1>Mesa de Ayuda</h1>
        <p>Sistema de Gestion de Tickets</p>
    </div>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-error"><?= htmlspecialchars($_SESSION['error']) ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (isset($_SESSION['success'])): ?>
        <div class="alert alert-success"><?= htmlspecialchars($_SESSION['success']) ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>

    <form method="POST" action="/login">
        <input type="hidden" name="csrf_token" value="<?= $csrf_token ?? '' ?>">
        <div class="form-group">
            <label for="email">Correo Electronico</label>
            <input type="email" id="email" name="email" placeholder="admin@mesaayuda.com" required autofocus>
        </div>
        <div class="form-group">
            <label for="password">Contrasena</label>
            <input type="password" id="password" name="password" placeholder="********" required minlength="8" maxlength="12">
            <small style="color:#757575;font-size:12px;">La contrasena debe tener entre 8 y 12 caracteres</small>
        </div>
        <button type="submit" class="btn-primary">Iniciar Sesion</button>
    </form>
    <div class="login-footer">
        <a href="/recuperar-password">Olvidaste tu contrasena?</a>
    </div>
    <div class="version">Sistema de Mesa de Ayuda v1.0</div>
</div>
<script>
    document.querySelector('form').addEventListener('submit', function(e) {
        const p = document.getElementById('password');
        if (p.value.length < 8 || p.value.length > 12) {
            e.preventDefault();
            alert('La contrasena debe tener entre 8 y 12 caracteres');
        }
    });
</script>
</body>
</html>
