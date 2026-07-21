<?php
if (!defined('ABSPATH')) {
    exit;
}
wp_enqueue_media();
?>
<div style="max-width:1000px;margin:0 auto;font-family:Arial,sans-serif;">
    <h2>Gerenciamento de Portfólio</h2>
    <?php if (!empty($status)): ?>
        <div style="background:#d4edda;color:#155724;padding:16px;border-radius:10px;margin-bottom:20px;">✅ Projeto salvo
            com sucesso!</div>
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:30px;">
        <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;">
            <h3>Adicionar novo projeto</h3>
            <form method="post">
                <input type="hidden" name="acao_portifolio" value="adicionar_portifolio">
                <?php wp_nonce_field('salvar_portifolio_acao'); ?>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Título</strong><br>
                    <input type="text" name="titulo" required
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Descrição</strong><br>
                    <textarea name="descricao" rows="4"
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"></textarea>
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Imagem (URL)</strong><br>
                    <div style="display:flex;gap:8px;align-items:center;">
                        <input id="imagem-new" type="text" name="imagem" placeholder="https://.../imagem.jpg"
                            style="flex:1;padding:10px;border:1px solid #ccc;border-radius:8px;">
                        <button type="button" class="gs-select-image" data-target="#imagem-new"
                            style="padding:8px 10px;border-radius:8px;border:1px solid #ccc;background:#fff;cursor:pointer;">Selecionar</button>
                    </div>
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Link do projeto</strong><br>
                    <input type="url" name="link_projeto" placeholder="https://meuprojeto.com"
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Link do GitHub</strong><br>
                    <input type="url" name="link_github" placeholder="https://github.com/usuario/projeto"
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>

                <button type="submit"
                    style="background:#2563eb;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Adicionar
                    projeto</button>
            </form>
        </div>

        <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;">
            <h3>Shortcode de visualização</h3>
            <p>Use este shortcode em qualquer página:</p>
            <pre style="background:#f3f4f6;padding:12px;border-radius:8px;">[curriculo_portifolio]</pre>
            <p>Exibe os projetos em cards 4-colunas.</p>
        </div>
    </div>

    <div>
        <h3>Projetos cadastrados</h3>
        <?php if (empty($portifolio)): ?>
            <p>Nenhum projeto cadastrado.</p>
        <?php else: ?>
            <?php foreach ($portifolio as $item): ?>
                <form method="post"
                    style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:20px;margin-bottom:16px;display:grid;grid-template-columns:1fr 1fr 1fr 1fr;gap:12px;align-items:end;">
                    <input type="hidden" name="acao_portifolio" value="salvar_portifolio">
                    <input type="hidden" name="portifolio_id" value="<?php echo esc_attr($item['id']); ?>">
                    <?php wp_nonce_field('salvar_portifolio_acao'); ?>

                    <label style="display:block;">
                        <strong>Título</strong><br>
                        <input type="text" name="titulo" value="<?php echo esc_attr($item['titulo']); ?>" required
                            style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <label style="display:block;">
                        <strong>Descrição</strong><br>
                        <input type="text" name="descricao" value="<?php echo esc_attr($item['descricao']); ?>"
                            style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <label style="display:block;">
                        <strong>Imagem (URL)</strong><br>
                        <div style="display:flex;gap:8px;align-items:center;">
                            <input id="imagem-<?php echo esc_attr($item['id']); ?>" type="text" name="imagem"
                                value="<?php echo esc_attr($item['imagem']); ?>"
                                style="flex:1;padding:10px;border:1px solid #ccc;border-radius:8px;">
                            <button type="button" class="gs-select-image"
                                data-target="#imagem-<?php echo esc_attr($item['id']); ?>"
                                style="padding:8px 10px;border-radius:8px;border:1px solid #ccc;background:#fff;cursor:pointer;">Selecionar</button>
                        </div>
                    </label>

                    <div>
                        <label style="display:block;margin-bottom:8px;">
                            <strong>Link projeto</strong><br>
                            <input type="url" name="link_projeto" value="<?php echo esc_attr($item['link_projeto']); ?>"
                                style="width:100%;padding:8px;border:1px solid #ccc;border-radius:8px;">
                        </label>

                        <label style="display:block;margin-bottom:8px;">
                            <strong>Link GitHub</strong><br>
                            <input type="url" name="link_github" value="<?php echo esc_attr($item['link_github']); ?>"
                                style="width:100%;padding:8px;border:1px solid #ccc;border-radius:8px;">
                        </label>

                        <div style="display:flex;flex-direction:column;gap:8px;margin-top:6px;">
                            <button type="submit"
                                style="background:#16a34a;color:#fff;padding:10px 14px;border:none;border-radius:10px;cursor:pointer;"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button type="submit" name="acao_portifolio" value="excluir_portifolio"
                                style="background:#dc2626;color:#fff;padding:10px 14px;border:none;border-radius:10px;cursor:pointer;"><i class="fa-solid fa-trash-can"></i></button>
                        </div>
                    </div>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const buttons = document.querySelectorAll('.gs-select-image');
        buttons.forEach(function (btn) {
            btn.addEventListener('click', function (e) {
                e.preventDefault();
                const targetSelector = btn.getAttribute('data-target');
                const targetInput = document.querySelector(targetSelector);
                if (!targetInput) return;

                var frame = wp.media({
                    title: 'Selecionar imagem do projeto',
                    button: { text: 'Usar esta imagem' },
                    multiple: false
                });

                frame.on('select', function () {
                    var attachment = frame.state().get('selection').first().toJSON();
                    if (attachment && attachment.url) {
                        targetInput.value = attachment.url;
                    }
                });

                frame.open();
            });
        });
    });
</script>