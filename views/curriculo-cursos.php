<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="curriculo-cursos" style="max-width:1200px;margin:0 auto;font-family:Arial,sans-serif;">
    <?php if (empty($cursos)): ?>
        <p style="background:#f3f4f6;color:#6b7280;padding:16px;border-radius:10px;text-align:center;">Nenhum curso encontrado.</p>
    <?php else: ?>
        <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:20px;margin-bottom:24px;">
            <?php foreach ($cursos as $index => $curso_item): ?>
                <?php if ($index < 4): ?>
                    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:18px;padding:24px;min-height:200px;display:flex;flex-direction:column;gap:14px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                              <div style="width:44px;height:44px;border-radius:25px;background:#11205A;color:#e5e7eb;display:flex;align-items:center;justify-content:center;font-size:20px;">
                                <?php echo gerenciador_saas_render_icon($curso_item['icon']); ?>
                            </div>
                            <div style="font-weight:700;font-size:1rem;color:#111827;"><?php echo esc_html($curso_item['curso']); ?></div>
                        </div>
                        <p style="margin:0;color:#4b5563;line-height:1.6;flex:1;"><?php echo esc_html($curso_item['instituicao']); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <?php if (count($cursos) > 4): ?>
            <details style="border:1px solid #e5e7eb;border-radius:18px;background:#fff;padding:16px;">
                <summary style="font-weight:700;cursor:pointer;color:#2563eb;outline:none;padding:8px 0;">Ver mais cursos</summary>
                <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:20px;margin-top:16px;">
                    <?php foreach ($cursos as $index => $curso_item): ?>
                        <?php if ($index >= 4): ?>
                            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:18px;padding:24px;min-height:200px;display:flex;flex-direction:column;gap:14px;">
                                <div style="display:flex;align-items:center;gap:12px;">
                                    <div style="width:44px;height:44px;border-radius:25px;background:#11205A;color:#e5e7eb;display:flex;align-items:center;justify-content:center;font-size:20px;">
                                        <?php echo gerenciador_saas_render_icon($curso_item['icon']); ?>
                                    </div>
                                    <div style="font-weight:700;font-size:1rem;color:#111827;"><?php echo esc_html($curso_item['curso']); ?></div>
                                </div>
                                <p style="margin:0;color:#4b5563;line-height:1.6;flex:1;"><?php echo esc_html($curso_item['instituicao']); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </details>
        <?php endif; ?>
    <?php endif; ?>
</div>
