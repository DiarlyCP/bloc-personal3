<div class="hero-card" style="display: flex; flex-direction: column; gap: 1.5rem;">
    <div style="display: flex; align-items: center; gap: 1.5rem; flex-wrap: wrap;">
        <div class="avatar-wrapper">
            <img src="<?php echo htmlspecialchars($perfil['foto']); ?>" alt="Foto de perfil" style="width: 100%; height: 100%; object-fit: cover; object-position: top;">
        </div>
        <div>
            <span class="badge" style="margin-bottom: 0.4rem; display: inline-block;">Perfil de Autora</span>
            <h2 style="font-family: 'Lora', serif; font-size: 1.6rem; color: var(--text-main);"><?php echo htmlspecialchars($perfil['nombre']); ?></h2>
            <p style="color: var(--text-muted); font-size: 0.9rem; margin-top: 0.2rem;"><?php echo htmlspecialchars($perfil['ciclo']); ?></p>
        </div>
    </div>
    
    <div style="color: var(--text-muted); font-size: 0.95rem; line-height: 1.7; border-top: 1px solid var(--border); padding-top: 1.2rem;">
        <p style="margin-bottom: 1rem;"><?php echo htmlspecialchars($perfil['bio']); ?></p>
        <p style="margin-bottom: 0.5rem;"><strong>Áreas de interés principal:</strong> Gestión y análisis de datos, desarrollo web modular y tecnologías en la nube.</p>
        <p style="margin-bottom: 0.5rem;"><strong>Contacto institucional:</strong> <a href="mailto:<?php echo htmlspecialchars($perfil['correo']); ?>" style="color: var(--accent); text-decoration: none;"><?php echo htmlspecialchars($perfil['correo']); ?></a></p>
        <p><strong>GitHub:</strong> <a href="<?php echo htmlspecialchars($perfil['github']); ?>" target="_blank" style="color: var(--accent); text-decoration: none;"><?php echo htmlspecialchars($perfil['github']); ?></a></p>
    </div>

    <div style="margin-top: 0.5rem;">
        <a href="?sec=inicio" class="btn-nav">← Volver al inicio del blog</a>
    </div>
</div>