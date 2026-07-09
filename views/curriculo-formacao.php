<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div style="max-width: 900px; margin: 0 auto; font-family: Arial, sans-serif;">

    <?php if (!empty($formacoes)): ?>
        <div style="display:grid; gap:12px;">
            <?php foreach ($formacoes as $formacao): ?>
                <div style="background:#fff;padding:16px;border:1px solid #e5e7eb;border-radius:10px;">
                    <strong><?php echo esc_html($formacao['curso']); ?></strong><br>
                    <span><?php echo esc_html($formacao['instituicao']); ?></span><br>
                    <small><?php echo esc_html($formacao['grau']); ?> • <?php echo esc_html($formacao['titulo']); ?> • <?php echo esc_html($formacao['status'] === 'cursando' ? 'Cursando' : 'Concluído'); ?> • <?php echo esc_html($formacao['ano_conclusao']); ?></small>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Nenhuma formação cadastrada.</p>
    <?php endif; ?>
</div>
