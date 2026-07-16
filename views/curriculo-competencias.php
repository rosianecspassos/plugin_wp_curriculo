<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="curriculo-competencias" style="max-width:1200px;margin:0 auto;font-family:Arial,sans-serif;">
    <?php if (empty($competencias)): ?>
        <p style="background:#f3f4f6;color:#6b7280;padding:16px;border-radius:10px;text-align:center;">Nenhuma competência encontrada.</p>
    <?php else: ?>
        <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:20px;margin-bottom:24px;">
            <?php foreach ($competencias as $index => $competencia): ?>
                <?php if ($index < 4): ?>
                    <div style="background:#fff;border:1px solid #e5e7eb;border-radius:18px;padding:24px;min-height:200px;display:flex;flex-direction:column;gap:14px;">
                        <div style="display:flex;align-items:center;gap:12px;">
                            <div style="width:44px;height:44px;border-radius:14px;background:#eff6ff;color:#1d4ed8;display:flex;align-items:center;justify-content:center;font-size:20px;">
                                <?php echo gerenciador_saas_render_icon($competencia['icon']); ?>
                            </div>
                            <div style="font-weight:700;font-size:1rem;color:#111827;"><?php echo esc_html($competencia['titulo']); ?></div>
                        </div>
                        <p style="margin:0;color:#4b5563;line-height:1.6;flex:1;"><?php echo esc_html($competencia['descricao']); ?></p>
                    </div>
                <?php endif; ?>
            <?php endforeach; ?>
        </div>

        <?php if (count($competencias) > 4): ?>
            <details style="border:1px solid #e5e7eb;border-radius:18px;background:#fff;padding:16px;">
                <summary style="font-weight:700;cursor:pointer;color:#2563eb;outline:none;padding:8px 0;">Ver mais competências</summary>
                <div style="display:grid;grid-template-columns:repeat(4,minmax(0,1fr));gap:20px;margin-top:16px;">
                    <?php foreach ($competencias as $index => $competencia): ?>
                        <?php if ($index >= 4): ?>
                            <div style="background:#fff;border:1px solid #e5e7eb;border-radius:18px;padding:24px;min-height:200px;display:flex;flex-direction:column;gap:14px;">
                                <div style="display:flex;align-items:center;gap:12px;">
                                    <div style="width:44px;height:44px;border-radius:14px;background:#eff6ff;color:#1d4ed8;display:flex;align-items:center;justify-content:center;font-size:20px;">
                                        <?php echo gerenciador_saas_render_icon($competencia['icon']); ?>
                                    </div>
                                    <div style="font-weight:700;font-size:1rem;color:#111827;"><?php echo esc_html($competencia['titulo']); ?></div>
                                </div>
                                <p style="margin:0;color:#4b5563;line-height:1.6;flex:1;"><?php echo esc_html($competencia['descricao']); ?></p>
                            </div>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </div>
            </details>
        <?php endif; ?>
    <?php endif; ?>
</div>
