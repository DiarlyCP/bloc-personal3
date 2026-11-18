<?php
require_once 'datos_blog.php';

// Obtener la sección actual de la URL (?sec=nombre), por defecto 'inicio'
$sec = isset($_GET['sec']) ? $_GET['sec'] : 'inicio';

// Lista de páginas estáticas permitidas en la carpeta secciones/
$paginas_validas = ['inicio', 'analisis-datos', 'decimo-ciclo', 'tecnologia', 'personal', 'sobre-mi'];

$es_articulo = false;
$articulo_actual = null;
$archivo_seccion = "";

if (in_array($sec, $paginas_validas)) {
    $archivo_seccion = "secciones/{$sec}.php";
} else {
    // Si no es una página fija, buscamos si corresponde a un artículo completo
    foreach ($articulos as $art) {
        if ($art['slug'] === $sec) {
            $es_articulo = true;
            $articulo_actual = $art;
            break;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $es_articulo ? htmlspecialchars($articulo_actual['titulo']) : "Diarly Tatiana | Blog"; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&family=Lora:ital,wght@0,400..700;1,400..700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg-main: #f8fafc;
            --bg-card: #ffffff;
            --text-main: #0f172a;
            --text-muted: #475569;
            --accent: #2563eb;
            --border: #e2e8f0;
            --badge-bg: #eff6ff;
            --badge-text: #1d4ed8;
        }

        [data-theme="dark"] {
            --bg-main: #0f172a;
            --bg-card: #1e293b;
            --text-main: #f8fafc;
            --text-muted: #94a3b8;
            --accent: #3b82f6;
            --border: #334155;
            --badge-bg: #172554;
            --badge-text: #93c5fd;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            transition: background-color 0.3s ease, color 0.3s ease;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-main);
            color: var(--text-main);
            line-height: 1.6;
            padding: 2rem 1rem;
        }

        .container {
            max-width: 900px;
            margin: 0 auto;
        }

        header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2.5rem;
            border-bottom: 1px solid var(--border);
            padding-bottom: 1rem;
        }

        .logo {
            font-weight: 700;
            font-size: 1.25rem;
            text-decoration: none;
            color: var(--text-main);
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }

        .logo span {
            width: 10px;
            height: 10px;
            background-color: var(--accent);
            border-radius: 50%;
            display: inline-block;
        }

        .nav-links {
            display: flex;
            gap: 1rem;
            align-items: center;
        }

        .btn-nav, .theme-toggle {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid var(--border);
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        [data-theme="dark"] .btn-nav, [data-theme="dark"] .theme-toggle {
            background-color: #334155;
            color: #f8fafc;
        }

        .btn-nav:hover, .theme-toggle:hover {
            background-color: var(--accent);
            color: #ffffff;
            border-color: var(--accent);
        }

        /* Toolbar y Botones de Categorías */
        .toolbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 2rem;
            flex-wrap: wrap;
            gap: 1rem;
        }

        .categories {
            display: flex;
            gap: 0.5rem;
            flex-wrap: wrap;
        }

        .cat-btn {
            background-color: #e2e8f0;
            color: #334155;
            border: 1px solid #cbd5e1;
            padding: 0.5rem 1rem;
            border-radius: 9999px;
            font-size: 0.875rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
            text-decoration: none;
        }

        [data-theme="dark"] .cat-btn {
            background-color: #334155;
            color: #cbd5e1;
            border-color: #475569;
        }

        .cat-btn:hover {
            background-color: #cbd5e1;
            color: #0f172a;
        }

        .cat-btn.active {
            background-color: var(--text-main);
            color: var(--bg-main);
            border-color: var(--text-main);
        }

        .view-switcher {
            display: flex;
            gap: 0.5rem;
        }

        .view-btn, .btn-read {
            background-color: #f1f5f9;
            color: #334155;
            border: 1px solid #cbd5e1;
            padding: 0.5rem 1rem;
            border-radius: 0.5rem;
            font-size: 0.85rem;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s;
            text-decoration: none;
        }

        [data-theme="dark"] .view-btn, [data-theme="dark"] .btn-read {
            background-color: #1e293b;
            color: #cbd5e1;
            border-color: #475569;
        }

        .view-btn:hover, .btn-read:hover {
            background-color: var(--accent);
            color: #fff;
            border-color: var(--accent);
        }

        .view-btn.active {
            background-color: var(--accent);
            color: #ffffff;
            border-color: var(--accent);
        }

        /* Tarjetas de Posts */
        .posts-container {
            display: grid;
            gap: 1.5rem;
        }

        .view-grid {
            grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
        }

        .view-list {
            grid-template-columns: 1fr;
        }

        .post-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 1.5rem;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .post-meta {
            font-size: 0.8rem;
            color: var(--text-muted);
            margin-bottom: 0.75rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .badge {
            background-color: var(--badge-bg);
            color: var(--badge-text);
            padding: 0.2rem 0.6rem;
            border-radius: 9999px;
            font-weight: 600;
            font-size: 0.75rem;
        }

        .post-title {
            font-family: 'Lora', serif;
            font-size: 1.25rem;
            margin-bottom: 0.75rem;
            color: var(--text-main);
        }

        .post-summary {
            font-size: 0.95rem;
            color: var(--text-muted);
            margin-bottom: 1.5rem;
        }

        .post-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid var(--border);
            padding-top: 1rem;
        }

        .like-btn {
            background: none;
            border: 1px solid var(--border);
            padding: 0.3rem 0.7rem;
            border-radius: 9999px;
            cursor: pointer;
            color: var(--text-muted);
            font-size: 0.85rem;
            display: flex;
            align-items: center;
            gap: 0.3rem;
        }

        .like-btn:hover {
            border-color: #ef4444;
            color: #ef4444;
        }

        .hero-card {
            background-color: var(--bg-card);
            border: 1px solid var(--border);
            border-radius: 1rem;
            padding: 2.5rem;
            box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.05);
        }

        .avatar-wrapper {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            overflow: hidden;
            border: 3px solid var(--accent);
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    <div class="container">
        <header>
            <a href="?sec=inicio" class="logo"><span></span> Diarly Tatiana | Blog</a>
            <div class="nav-links">
                <a href="?sec=sobre-mi" class="btn-nav">Sobre mí</a>
                <button class="theme-toggle" onclick="toggleTheme()">Modo</button>
            </div>
        </header>

        <main>
            <?php
            if ($es_articulo) {
                ?>
                <article class="hero-card">
                    <div class="post-meta" style="margin-bottom: 1rem;">
                        <span class="badge"><?php echo htmlspecialchars($articulo_actual['categoria']); ?></span>
                        <span><?php echo htmlspecialchars($articulo_actual['fecha']); ?></span>
                        <span>• <?php echo htmlspecialchars($articulo_actual['lectura']); ?></span>
                    </div>
                    <h1 style="font-family: 'Lora', serif; font-size: 2rem; margin-bottom: 1.5rem;"><?php echo htmlspecialchars($articulo_actual['titulo']); ?></h1>
                    <div style="font-size: 1.05rem; color: var(--text-muted); line-height: 1.8; margin-bottom: 2rem;">
                        <p><?php echo nl2br(htmlspecialchars($articulo_actual['contenido'])); ?></p>
                    </div>
                    <a href="?sec=inicio" class="btn-nav">← Volver al inicio</a>
                </article>
                <?php
            } elseif (!empty($archivo_seccion) && file_exists($archivo_seccion)) {
                include $archivo_seccion;
            } else {
                echo '<div class="hero-card"><h2>Sección no encontrada</h2><p>La página que buscas no existe.</p><br><a href="?sec=inicio" class="btn-nav">Volver al inicio</a></div>';
            }
            ?>
        </main>
    </div>

    <script>
        function cambiarVista(vista) {
            const container = document.getElementById('postsContainer');
            if(!container) return;
            const botones = document.querySelectorAll('.view-switcher .view-btn');
            
            botones.forEach(b => b.classList.remove('active'));
            if(vista === 'grid') {
                container.className = 'posts-container view-grid';
                if(botones[0]) botones[0].classList.add('active');
            } else {
                container.className = 'posts-container view-list';
                if(botones[1]) botones[1].classList.add('active');
            }
        }

        function darLike(btn) {
            const span = btn.querySelector('span');
            let count = parseInt(span.textContent);
            span.textContent = count + 1;
            btn.style.borderColor = '#ef4444';
            btn.style.color = '#ef4444';
        }

        function toggleTheme() {
            const html = document.documentElement;
            if (html.getAttribute('data-theme') === 'dark') {
                html.removeAttribute('data-theme');
                localStorage.setItem('theme', 'light');
            } else {
                html.setAttribute('data-theme', 'dark');
                localStorage.setItem('theme', 'dark');
            }
        }

        // Cargar preferencia previa
        if (localStorage.getItem('theme') === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
        }
    </script>
</body>
</html>