<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<div style="max-width:1000px;margin:0 auto;font-family:Arial,sans-serif;">
    <h2>Gerenciamento de Competências</h2>
    <?php if (!empty($status)): ?>
        <div style="background:#d4edda;color:#155724;padding:16px;border-radius:10px;margin-bottom:20px;">✅ Competência salva com sucesso!</div>
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:30px;">
        <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;">
            <h3>Adicionar nova competência</h3>
            <form method="post">
                <input type="hidden" name="acao_competencias" value="adicionar_competencia">
                <?php wp_nonce_field('salvar_competencia_acao'); ?>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Ícone</strong><br>
                    <input type="text" name="icon" placeholder="Ex: 💡 ou fas fa-star" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Título</strong><br>
                    <input type="text" name="titulo" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Descrição</strong><br>
                    <textarea name="descricao" rows="4" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"></textarea>
                </label>

                <button type="submit" style="background:#2563eb;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Adicionar competência</button>
            </form>
        </div>

        <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;">
            <h3>Shortcode de visualização</h3>
            <p>Use este shortcode em qualquer página para exibir as competências em cards:</p>
            <pre style="background:#f3f4f6;padding:12px;border-radius:8px;">[curriculo_competencias]</pre>
            <p>As competências aparecem em linhas de 4 colunas e os itens extras ficam em uma sanfona.</p>
        </div>
    </div>

    <div>
        <h3>Competências cadastradas</h3>
        <?php if (empty($competencias)): ?>
            <p>Nenhuma competência cadastrada.</p>
        <?php else: ?>
            <?php foreach ($competencias as $competencia): ?>
                <form method="post" style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:20px;margin-bottom:16px;display:grid;grid-template-columns:1fr 1fr 1fr 140px;gap:12px;align-items:end;">
                    <input type="hidden" name="acao_competencias" value="salvar_competencia">
                    <input type="hidden" name="competencia_id" value="<?php echo esc_attr($competencia['id']); ?>">
                    <?php wp_nonce_field('salvar_competencia_acao'); ?>

                    <label style="display:block;">
                        <strong>Ícone</strong><br>
                        <input type="text" name="icon" value="<?php echo esc_attr($competencia['icon']); ?>" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <label style="display:block;">
                        <strong>Título</strong><br>
                        <input type="text" name="titulo" value="<?php echo esc_attr($competencia['titulo']); ?>" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <label style="display:block;">
                        <strong>Descrição</strong><br>
                        <textarea name="descricao" rows="2" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"><?php echo esc_textarea($competencia['descricao']); ?></textarea>
                    </label>

                    <div style="display:flex;flex-direction:column;gap:8px;">
                        <button type="submit" style="background:#16a34a;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Salvar</button>
                        <button type="submit" name="acao_competencias" value="excluir_competencia" style="background:#dc2626;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Excluir</button>
                    </div>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
     