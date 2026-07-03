<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div style="max-width:1000px;margin:0 auto;font-family:Arial,sans-serif;">
    <h2>Gerenciamento de Experiências</h2>
    <?php if (!empty($status)): ?>
        <div style="background:#d4edda;color:#155724;padding:16px;border-radius:10px;margin-bottom:20px;">✅ Alterações salvas com sucesso!</div>   
    <?php endif; ?>
    <!-- Formulário para adicionar nova experiência -->
    <div style="background:#fff;border:1px solid #ddd;border-radius:12  px;padding:24px;margin-bottom:30px;">
        <h3>Adicionar nova experiência</h3>
        <form method="post">
            <input type="hidden" name="acao_experiencias" value="adicionar_experiencia">
            <?php wp_nonce_field('salvar_experiencia_acao'); ?>
            <label style="display:block;margin-bottom:14px;">
                <strong>Cargo</strong><br>
                <input type="text" name="cargo" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
            </label>
            <button type="submit" style="background:#2563eb;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Adicionar experiência</button>
        </form> 
    </div>
    <!-- Shortcode de visualização -->
    <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;margin-bottom:30px;">
        <h3>Shortcode de visualização</h3>
        <p>Use este shortcode em qualquer página, inclusive no Elementor:</p>
        <pre style="background:#f3f4f6;padding:12px;border-radius:8px;">[curriculo_experiencias]</pre>
        <p>Ele exibe as experiências cadastradas.</p>
        <p>Para carregar a área de gerenciamento, use também: <code>[sistema_experiencias]</code></p>
    </div>
    <!-- Lista de experiências cadastradas -->


    <div>
        <h3>Experiências cadastradas</h3>
        <?php if (empty($experiencias)): ?>
            <p>Nenhuma experiência cadastrada.</p>
        <?php else: ?>
            <?php foreach ($experiencias as $experiencia): ?>
                <form method="post" style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:20px;margin-bottom:16px;display:grid;grid-template-columns:1fr 140px;gap:12px;align-items:end;">
                    <input type="hidden" name="acao_experiencias" value="salvar_experiencia">
                    <input type="hidden" name="experiencia_id" value="<?php echo esc_attr($experiencia['id']); ?>">
                    <?php wp_nonce_field('salvar_experiencia_acao'); ?>

                    <label style="display:block;">
                        <strong>Cargo</strong><br>
                        <input type="text" name="cargo" value="<?php echo esc_attr($experiencia['cargo']); ?>" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <button type="submit" style="background:#2563eb;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Salvar alterações</button>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>