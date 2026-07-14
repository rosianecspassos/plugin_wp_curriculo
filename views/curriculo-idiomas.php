<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div class="curriculo-idiomas" style="max-width:100%;margin:0 auto;font-family:Arial,sans-serif;padding:20px;">
    <?php if (empty($idiomas)): ?>
        <p style="background:#f3f4f6;color:#6b7280;padding:16px;border-radius:10px;text-align:center;">Nenhum idioma encontrado.</p>
    <?php else: ?>
        <div style="display:block;width:100%;padding:20px 0;">
            <?php foreach ($idiomas as $idioma): ?>
                <?php
                    $raio = 50;
                    $espessura = 12;
                    $circunferencia = 2 * pi() * $raio;
                    $offset = $circunferencia - ($idioma['nivel'] / 100) * $circunferencia;
                    $cor = $this->obter_cor(intval($idioma['nivel']));
                    $nivel_texto = $this->obter_nivel_texto(intval($idioma['nivel']));
                ?>
                <div style="position:relative;width:130px;height:130px;margin:30px auto;">
                    <svg width="130" height="130" viewBox="0 0 130 130" style="position:absolute;top:0;left:0;z-index:1;">
                        <circle
                            class="bg"
                            cx="65"
                            cy="65"
                            r="<?php echo esc_attr($raio); ?>"
                            fill="none"
                            stroke="#e5e7eb"
                            stroke-width="<?php echo esc_attr($espessura); ?>"
                        />
                        <circle
                            class="progress"
                            cx="65"
                            cy="65"
                            r="<?php echo esc_attr($raio); ?>"
                            fill="none"
                            stroke="<?php echo esc_attr($cor); ?>"
                            stroke-width="<?php echo esc_attr($espessura); ?>"
                            stroke-dasharray="<?php echo esc_attr($circunferencia); ?>"
                            stroke-dashoffset="<?php echo esc_attr($offset); ?>"
                            stroke-linecap="round"
                            transform="rotate(-90 65 65)"
                            style="transition: stroke-dashoffset 0.6s ease, stroke 0.3s ease;"
                        />
                    </svg>
                    <div class="idioma-centro" style="position:absolute;top:50%;left:50%;transform:translate(-50%, -50%);text-align:center;z-index:2;">
                        <div style="font-size:12px;font-weight:700;color:#111827;"><?php echo esc_html($nivel_texto); ?></div>
                        <div style="font-size:11px;color:#4b5563;"><?php echo esc_html($idioma['nome']); ?></div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>
