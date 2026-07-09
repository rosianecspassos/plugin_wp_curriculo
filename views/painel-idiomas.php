<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div style="max-width:1000px;margin:0 auto;font-family:Arial,sans-serif;">
    <h2>Gerenciamento de Idiomas</h2>
    <?php if (!empty($status)): ?>
        <div style="background:#d4edda;color:#155724;padding:16px;border-radius:10px;margin-bottom:20px;">✅ Alterações salvas com sucesso!</div>
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:30px;">
        <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;">
            <h3>Adicionar novo idioma</h3>
            <form method="post">
                <input type="hidden" name="acao_idiomas" value="adicionar_idioma">
                <?php wp_nonce_field('salvar_idioma_acao'); ?>
                <label style="display:block;margin-bottom:14px;">
                    <strong>Nome</strong><br>
                    <input type="text" name="nome" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>
                <label style="display:block;margin-bottom:14px;">
                    <strong>Fluência</strong><br>
                    <select name="nivel_text" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                        <option value="basico">Básico</option>
                        <option value="intermediario">Intermediário</option>
                        <option value="fluente">Fluente</option>
                        <option value="nativo">Nativo</option>
                    </select>
                </label>
                <button type="submit" style="background:#2563eb;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Adicionar idioma</button>
            </form>
        </div>

        <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;">
            <h3>Shortcode de visualização</h3>
            <p>Use este shortcode em qualquer página, inclusive no Elementor:</p>
            <pre style="background:#f3f4f6;padding:12px;border-radius:8px;">[sistema_idiomas_progress]</pre>
            <p>Ele exibe os idiomas cadastrados com barra de progresso e porcentagem.</p>
        </div>
    </div>

    <div>
        <h3>Idiomas cadastrados</h3>
        <?php if (empty($languages)): ?>
            <p>Nenhum idioma cadastrado.</p>
        <?php else: ?>
            <?php foreach ($languages as $idioma): ?>
                <form method="post" style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:20px;margin-bottom:16px;display:grid;grid-template-columns:1fr 1fr 1fr 140px;gap:12px;align-items:end;">
                    <input type="hidden" name="acao_idiomas" value="salvar_idioma">
                    <input type="hidden" name="idioma_id" value="<?php echo esc_attr($idioma['id']); ?>">
                    <?php wp_nonce_field('salvar_idioma_acao'); ?>

                    <label style="display:block;">
                        <strong>Nome</strong><br>
                        <input type="text" name="nome" value="<?php echo esc_attr($idioma['nome']); ?>" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <label style="display:block;">
                        <strong>Fluência</strong><br>
                        <?php
                            $nivel_val = intval($idioma['nivel']);
                            if ($nivel_val === 100) { $sel = 'nativo'; }
                            elseif ($nivel_val >= 80) { $sel = 'fluente'; }
                            elseif ($nivel_val >= 50) { $sel = 'intermediario'; }
                            else { $sel = 'basico'; }
                        ?>
                        <select name="nivel_text" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                            <option value="basico" <?php selected($sel, 'basico'); ?>>Básico</option>
                            <option value="intermediario" <?php selected($sel, 'intermediario'); ?>>Intermediário</option>
                            <option value="fluente" <?php selected($sel, 'fluente'); ?>>Fluente</option>
                            <option value="nativo" <?php selected($sel, 'nativo'); ?>>Nativo</option>
                        </select>
                    </label>

                    <div></div>
                    <div style="display:flex;flex-direction:column;gap:8px;">
                        <button type="submit" style="background:#16a34a;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Salvar</button>
                        <button type="submit" name="acao_idiomas" value="excluir_idioma" style="background:#dc2626;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Excluir</button>
                    </div>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
