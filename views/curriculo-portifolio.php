<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="curriculo-portifolio" style="max-width:1200px;margin:0 auto;font-family:Arial,sans-serif;padding:12px;">
    <?php if (empty($portifolio)): ?>
        <p style="background:#f3f4f6;color:#6b7280;padding:16px;border-radius:10px;text-align:center;">Nenhum projeto encontrado.</p>
    <?php else: ?>
        <style>
            .gs-grid { display:grid; grid-template-columns:repeat(4,1fr); gap:20px; }
            .gs-card { background:#fff;border:1px solid #e5e7eb;border-radius:12px;padding:16px;display:flex;flex-direction:column;gap:12px;min-height:250px; }
            .gs-thumb { width:100%;height:140px;overflow:hidden;border-radius:8px;background:#f3f4f6;display:flex;align-items:center;justify-content:center; }
            .gs-thumb img { width:100%;height:100%;object-fit:cover;display:block; }
            .gs-title { font-weight:700;font-size:1rem;color:#111827; }
            .gs-desc { margin:0;color:#4b5563;line-height:1.5;flex:1; }
            .gs-actions { display:flex;gap:10px;align-items:center; }
            .gs-action-btn { width:36px;height:36px;border-radius:8px;background:#f9fafb;border:1px solid #e6e7eb;display:inline-flex;align-items:center;justify-content:center;text-decoration:none;color:#374151 }
            @media (max-width:1000px){ .gs-grid{grid-template-columns:repeat(2,1fr);} }
            @media (max-width:600px){ .gs-grid{grid-template-columns:repeat(1,1fr);} }
        </style>

        <div class="gs-grid">
            <?php foreach ($portifolio as $projeto): ?>
                <?php
                    $titulo = isset($projeto['titulo']) ? $projeto['titulo'] : '';
                    $descricao = isset($projeto['descricao']) ? $projeto['descricao'] : '';
                    $link_projeto = isset($projeto['link_projeto']) ? $projeto['link_projeto'] : '';
                    $link_github = isset($projeto['link_github']) ? $projeto['link_github'] : '';
                    $imagem = '';
                    if (!empty($projeto['imagem'])) { $imagem = $projeto['imagem']; }
                    elseif (!empty($projeto['image'])) { $imagem = $projeto['image']; }
                ?>

                <article class="gs-card" aria-labelledby="proj-<?php echo esc_attr(md5($titulo)); ?>">
                    <div class="gs-thumb">
                        <?php if (!empty($imagem)): ?>
                            <img src="<?php echo esc_url($imagem); ?>" alt="<?php echo esc_attr($titulo); ?>">
                        <?php else: ?>
                            <span style="color:#9ca3af;font-size:14px;">Sem imagem</span>
                        <?php endif; ?>
                    </div>

                    <div>
                        <div id="proj-<?php echo esc_attr(md5($titulo)); ?>" class="gs-title"><?php echo esc_html($titulo); ?></div>
                        <p class="gs-desc"><?php echo esc_html($descricao); ?></p>
                    </div>

                    <div class="gs-actions">
                        <?php if (!empty($link_projeto)): ?>
                            <a class="gs-action-btn" href="<?php echo esc_url($link_projeto); ?>" target="_blank" rel="noopener noreferrer nofollow" title="Abrir projeto">
                                <!-- external link SVG -->
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M14 3H21V10" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M10 14L21 3" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M21 21H3V3H12" stroke="#374151" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </a>
                        <?php endif; ?>

                        <?php if (!empty($link_github)): ?>
                            <a class="gs-action-btn" href="<?php echo esc_url($link_github); ?>" target="_blank" rel="noopener noreferrer nofollow" title="Ver no GitHub">
                                <!-- github SVG -->
                                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M12 2C6.48 2 2 6.48 2 12c0 4.42 2.87 8.17 6.84 9.5.5.09.66-.22.66-.49 0-.24-.01-.87-.01-1.71-2.78.61-3.37-1.34-3.37-1.34-.45-1.16-1.11-1.47-1.11-1.47-.91-.62.07-.61.07-.61 1 .07 1.53 1.03 1.53 1.03.89 1.52 2.34 1.08 2.91.83.09-.65.35-1.08.64-1.33-2.22-.25-4.56-1.11-4.56-4.95 0-1.09.39-1.99 1.03-2.69-.10-.25-.45-1.28.10-2.66 0 0 .84-.27 2.75 1.02A9.56 9.56 0 0112 6.80c.85.004 1.71.115 2.51.338 1.90-1.29 2.74-1.02 2.74-1.02.55 1.38.20 2.41.10 2.66.64.70 1.03 1.60 1.03 2.69 0 3.85-2.34 4.70-4.57 4.95.36.31.68.92.68 1.85 0 1.33-.01 2.40-.01 2.72 0 .27.16.59.67.49A10.01 10.01 0 0022 12c0-5.52-4.48-10-10-10z" fill="#374151"/></svg>
                            </a>
                        <?php endif; ?>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>



  

