<?php
$filtrados = array_filter($articulos, fn($a) => $a['categoria'] === 'Tecnología y Web');
?>
<div class="toolbar">
    <a href="?sec=inicio" class="btn-nav">← Volver a todas las notas</a>
    <h3 style="font-size: 1.1rem; color: var(--accent);">Categoría: Tecnología y Web</h3>
</div>
<div class="posts-container view-grid">
    <?php if (count($filtrados) > 0): ?>
        <?php foreach ($filtrados as $art): ?>
            <article class="post-card">
                <div class="post-meta">
                    <span class="badge"><?php echo htmlspecialchars($art['categoria']); ?></span>
                    <span><?php echo htmlspecialchars($art['fecha']); ?></span>
                </div>
                <h2 class="post-title"><?php echo htmlspecialchars($art['titulo']); ?></h2>
                <p class="post-summary"><?php echo htmlspecialchars($art['resumen']); ?></p>
                <div class="post-footer">
                    <a href="?sec=<?php echo $art['slug']; ?>" class="btn-read">Leer nota completa →</a>
                    <button class="like-btn" onclick="darLike(this)">♡ <span>0</span></button>
                </div>
            </article>
        <?php endforeach; ?>
    <?php else: ?>
        <p style="color: var(--text-muted);">No hay publicaciones en esta categoría todavía.</p>
    <?php endif; ?>
</div>