<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div style="max-width: 900px; margin: 0 auto; font-family: Arial, sans-serif;">
    <h2>Formações acadêmicas</h2>

    <?php if ($status): ?>
        <div style="background:#dcfce7;color:#166534;padding:10px 12px;border-radius:8px;margin-bottom:16px;">Formação salva com sucesso.</div>
    <?php endif; ?>

    <form method="post" style="background:#fff;padding:20px;border:1px solid #e5e7eb;border-radius:10px;margin-bottom:24px;">
        <?php wp_nonce_field('salvar_formacao_acao', '_wpnonce'); ?>
        <input type="hidden" name="acao_formacao" value="<?php echo $formacao_em_edicao ? 'salvar_formacao' : 'adicionar_formacao'; ?>">
        <?php if ($formacao_em_edicao): ?>
            <input type="hidden" name="formacao_id" value="<?php echo esc_attr(intval($formacao_em_edicao['id'])); ?>">
        <?php endif; ?>

        <div style="display:grid; gap:12px;">
            <label>
                <strong>Curso</strong><br>
                <input type="text" name="curso" value="<?php echo esc_attr($formacao_em_edicao['curso'] ?? ''); ?>" required style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:6px;">
            </label>

            <label>
                <strong>Instituição</strong><br>
                <input type="text" name="instituicao" value="<?php echo esc_attr($formacao_em_edicao['instituicao'] ?? ''); ?>" required style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:6px;">
            </label>

            <label>
                <strong>Grau</strong><br>
                <select name="grau" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:6px;">
                    <option value="" <?php selected($formacao_em_edicao['grau'] ?? '', ''); ?>>Selecione</option>
                    <option value="Graduação" <?php selected($formacao_em_edicao['grau'] ?? '', 'Graduação'); ?>>Graduação</option>
                    <option value="Tecnico" <?php selected($formacao_em_edicao['grau'] ?? '', 'Tecnico'); ?>>Técnico</option>
                    <option value="Pós-graduação" <?php selected($formacao_em_edicao['grau'] ?? '', 'Pós-graduação'); ?>>Pós-graduação</option>
                    <option value="Mestrado" <?php selected($formacao_em_edicao['grau'] ?? '', 'Mestrado'); ?>>Mestrado</option>
                    <option value="Doutorado" <?php selected($formacao_em_edicao['grau'] ?? '', 'Doutorado'); ?>>Doutorado</option>
                </select>
            </label>

            <label>
                <strong>Título</strong><br>
                <select name="titulo" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:6px;">
                    <option value="" <?php selected($formacao_em_edicao['titulo'] ?? '', ''); ?>>Selecione</option>
                    <option value="Bacharel" <?php selected($formacao_em_edicao['titulo'] ?? '', 'Bacharel'); ?>>Bacharel</option>
                    <option value="Licenciado" <?php selected($formacao_em_edicao['titulo'] ?? '', 'Licenciado'); ?>>Licenciado</option>
                    <option value="Especialista" <?php selected($formacao_em_edicao['titulo'] ?? '', 'Especialista'); ?>>Especialista</option>
                    <option value="Mestre" <?php selected($formacao_em_edicao['titulo'] ?? '', 'Mestre'); ?>>Mestre</option>
                    <option value="Doutor" <?php selected($formacao_em_edicao['titulo'] ?? '', 'Doutor'); ?>>Doutor</option>
                </select>
            </label>

            <label>
                <strong>Status</strong><br>
                <select name="status" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:6px;">
                    <option value="concluido" <?php selected($formacao_em_edicao['status'] ?? 'concluido', 'concluido'); ?>>Concluído</option>
                    <option value="cursando" <?php selected($formacao_em_edicao['status'] ?? 'concluido', 'cursando'); ?>>Cursando</option>
                </select>
            </label>

            <label>
                <strong>Ano de conclusão</strong><br>
                <input type="number" name="ano_conclusao" min="1900" max="2100" value="<?php echo esc_attr($formacao_em_edicao['ano_conclusao'] ?? ''); ?>" style="width:100%;padding:8px;border:1px solid #d1d5db;border-radius:6px;">
            </label>
        </div>

        <button type="submit" style="margin-top:16px;padding:10px 16px;background:#2563eb;color:#fff;border:none;border-radius:6px;cursor:pointer;">Salvar formação</button>
    </form>

    <?php if (!empty($formacoes)): ?>
        <div style="display:grid; gap:12px;">
            <?php foreach ($formacoes as $formacao): ?>
                <div style="background:#f9fafb;padding:16px;border:1px solid #e5e7eb;border-radius:10px;">
                    <div style="display:flex;justify-content:space-between;gap:12px;align-items:flex-start;flex-wrap:wrap;">
                        <div>
                            <strong><?php echo esc_html($formacao['curso']); ?></strong><br>
                            <span><?php echo esc_html($formacao['instituicao']); ?></span><br>
                            <small><?php echo esc_html($formacao['grau']); ?> • <?php echo esc_html($formacao['titulo']); ?> • <?php echo esc_html($formacao['status'] === 'cursando' ? 'Cursando' : 'Concluído'); ?> • <?php echo esc_html($formacao['ano_conclusao']); ?></small>
                        </div>
                        <div style="display:flex;gap:10px;flex-wrap:wrap;align-items:center;">
                            <a href="<?php echo esc_url(add_query_arg(['editar' => intval($formacao['id'])], wp_unslash($_SERVER['REQUEST_URI']))); ?>" style="color:#2563eb;">Editar</a>
                            <form method="post" style="margin:0;">
                                <input type="hidden" name="acao_formacao" value="excluir_formacao">
                                <input type="hidden" name="formacao_id" value="<?php echo esc_attr(intval($formacao['id'])); ?>">
                                <?php wp_nonce_field('salvar_formacao_acao'); ?>
                                <button type="submit" style="background:#dc2626;color:#fff;padding:8px 12px;border:none;border-radius:8px;cursor:pointer;">Excluir</button>
                            </form>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Nenhuma formação cadastrada ainda.</p>
    <?php endif; ?>
</div>
