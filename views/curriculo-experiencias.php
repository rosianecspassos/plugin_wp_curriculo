<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div class="curriculo-experiencias" style="max-width:760px;margin:0 auto;">
    <?php if (empty($experiencias)): ?>
        <p style="background:#f3f4f6;color:#6b7280;padding:16px;border-radius:10px;text-align:center;">Nenhuma experiência encontrada.</p>
    <?php else: ?>
        <ul style="list-style:disc inside; padding:0; margin:0;">
            <?php foreach ($experiencias as $experiencia): ?>
                <?php $cargo = $experiencia['cargo']; ?>
                <li style="margin-bottom:12px; padding:16px; background:#ffffff; border:1px solid #e5e7eb; border-radius:10px; box-shadow:0 1px 2px rgba(0,0,0,0.05);">
                    <div style="font-size:16px; font-weight:700; color:#111827;"><?php echo esc_html($cargo); ?></div>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>
        