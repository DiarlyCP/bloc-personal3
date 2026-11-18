<div class="toolbar">
    <div class="categories">
        <a href="?sec=inicio" class="cat-btn active">Todas</a>
        <a href="?sec=analisis-datos" class="cat-btn">Análisis de Datos</a>
        <a href="?sec=decimo-ciclo" class="cat-btn">Décimo Ciclo</a>
        <a href="?sec=tecnologia" class="cat-btn">Tecnología</a>
        <a href="?sec=personal" class="cat-btn">Personal</a>
    </div>
    <div class="view-switcher">
        <button class="view-btn active" onclick="cambiarVista('grid')">Cuadrícula</button>
        <button class="view-btn" onclick="cambiarVista('list')">Lista</button>
    </div>
</div>

<div class="posts-container view-grid" id="postsContainer">
    <?php foreach ($articulos as $art): ?>
        <article class="post-card">
            <div>
                <div class="post-meta">
                    <span class="badge"><?php echo htmlspecialchars($art['categoria']); ?></span>
                    <span><?php echo htmlspecialchars($art['fecha']); ?></span>
                    <span>• <?php echo htmlspecialchars($art['lectura']); ?></span>
                </div>
                <h2 class="post-title"><?php echo htmlspecialchars($art['titulo']); ?></h2>
                <p class="post-summary"><?php echo htmlspecialchars($art['resumen']); ?></p>
            </div>
            <div class="post-footer">
                <a href="?sec=<?php echo $art['slug']; ?>" class="btn-read">Leer nota completa →</a>
                <button class="like-btn" onclick="darLike(this)">♡ <span>0</span></button>
            </div>
        </article>
    <?php endforeach; ?>
</div>