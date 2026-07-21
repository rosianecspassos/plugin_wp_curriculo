<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="curriculo-portifolio" style="max-width:1200px;margin:0 auto;font-family:Arial,sans-serif;padding:12px;">
    <?php if (empty($portifolio)): ?>
        <p style="background:#f3f4f6;color:#6b7280;padding:16px;border-radius:10px;text-align:center;">Nenhum projeto
            encontrado.</p>
    <?php else: ?>
        <style>
            .gs-grid {
                display: grid;
                grid-template-columns: repeat(4, 1fr);
                gap: 20px;
            }

            .gs-card {
                background: #fff;
                border: 1px solid #e5e7eb;
                border-radius: 12px;
                padding: 16px;
                display: flex;
                flex-direction: column;
                gap: 12px;
                min-height: 280px;
                box-sizing: border-box;
                position: relative;
            }

            /* Garante que a imagem seja um bloco isolado e sem filhos flutuando sobre ela */
            .gs-thumb {
                width: 100%;
                height: 140px;
                overflow: hidden;
                border-radius: 8px;
                background: #f3f4f6;
                display: flex;
                align-items: center;
                justify-content: center;
                flex-shrink: 0;
                position: relative;
                z-index: 1;
            }

            .gs-thumb img {
                width: 100%;
                height: 100%;
                object-fit: cover;
                display: block;
            }

            .gs-content {
                display: flex;
                flex-direction: column;
                gap: 8px;
                flex: 1;
            }

            .gs-title {
                font-weight: 700;
                font-size: 1rem;
                color: #111827;
            }

            .gs-desc {
                margin: 0;
                color: #4b5563;
                line-height: 1.5;
                font-size: 0.9rem;
            }

            /* Container das ações */
            .gs-actions {
                display: flex;
                gap: 10px;
                align-items: center;
                margin-top: auto;
                padding-top: 8px;
            }

            /* Força o botão a se comportar como um flex container centralizado */
            .gs-action-btn {
                width: 36px;
                height: 36px;
                border-radius: 8px;
                background: #f9fafb;
                border: 1px solid #e6e7eb;
                display: inline-flex !important;
                align-items: center !important;
                justify-content: center !important;
                text-decoration: none;
                transition: background 0.2s;
                position: relative;
            }

            .gs-action-btn:hover {
                background: #f3f4f6;
            }

            /* Neutraliza qualquer CSS global do tema que force os SVGs a saírem do lugar */
            .gs-action-btn svg {
                position: static !important;
                display: block !important;
                margin: 0 auto !important;
                transform: none !important;
                width: 18px !important;
                height: 18px !important;
                max-width: 18px !important;
                max-height: 18px !important;
            }

            @media (max-width:1000px) {
                .gs-grid {
                    grid-template-columns: repeat(2, 1fr);
                }
            }

            @media (max-width:600px) {
                .gs-grid {
                    grid-template-columns: repeat(1, 1fr);
                }
            }
        </style>

        <div class="gs-grid">
            <?php foreach ($portifolio as $projeto): ?>
                <?php
                $titulo = isset($projeto['titulo']) ? $projeto['titulo'] : '';
                $descricao = isset($projeto['descricao']) ? $projeto['descricao'] : '';
                $link_projeto = isset($projeto['link_projeto']) ? $projeto['link_projeto'] : '';
                $link_github = isset($projeto['link_github']) ? $projeto['link_github'] : '';
                $imagem = '';
                if (!empty($projeto['imagem'])) {
                    $imagem = $projeto['imagem'];
                } elseif (!empty($projeto['image'])) {
                    $imagem = $projeto['image'];
                }
                ?>

                <article class="gs-card" aria-labelledby="proj-<?php echo esc_attr(md5($titulo)); ?>">
                    <div class="gs-thumb">
                        <?php if (!empty($imagem)): ?>
                            <img src="<?php echo esc_url($imagem); ?>" alt="<?php echo esc_attr($titulo); ?>">
                        <?php else: ?>
                            <span style="color:#9ca3af;font-size:14px;">Sem imagem</span>
                        <?php endif; ?>
                    </div>

                    <div class="gs-content">
                        <div id="proj-<?php echo esc_attr(md5($titulo)); ?>" class="gs-title"><?php echo esc_html($titulo); ?>
                        </div>
                        <p class="gs-desc"><?php echo esc_html($descricao); ?></p>

                        <div class="gs-actions">
                            <?php if (!empty($link_projeto)): ?>
                                <a class="gs-action-btn" style="text-decoration:none;" href="<?php echo esc_url($link_projeto); ?>"
                                    target="_blank" rel="noopener noreferrer nofollow" title="Abrir projeto">
                                    <i class="fa-solid fas fa-eye " style="color:#000;"></i>
                                </a>
                            <?php endif; ?>

                            <?php if (!empty($link_github)): ?>
                                <a class="gs-action-btn" style="text-decoration:none;" href="<?php echo esc_url($link_github); ?>"
                                    target="_blank" rel="noopener noreferrer nofollow" title="Ver no GitHub">
                                    <i class="fa-solid fa-brands fa-github" style="color:#000;"></i>
                                </a>
                            <?php endif; ?>
                        </div>
                    </div>
                </article>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>