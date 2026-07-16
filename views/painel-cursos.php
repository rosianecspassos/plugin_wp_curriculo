<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div style="max-width:1000px;margin:0 auto;font-family:Arial,sans-serif;">
    <h2>Gerenciamento de Cursos</h2>
    <?php if (!empty($status)): ?>
        <div style="background:#d4edda;color:#155724;padding:16px;border-radius:10px;margin-bottom:20px;">✅ Curso salvo com sucesso!</div>
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:20px;margin-bottom:30px;">
        <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;">
            <h3>Adicionar novo curso</h3>
            <form method="post">
                <input type="hidden" name="acao_cursos" value="adicionar_curso">
                <?php wp_nonce_field('salvar_curso_acao'); ?>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Ícone</strong><br>
                    <div class="saas-icon-grid">
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-book">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-book'); ?>
                            <span>Livro</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-lightbulb">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-lightbulb'); ?>
                            <span>Conhecimento</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-flask">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-flask'); ?>
                            <span>Laboratório</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-laptop-code">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-laptop-code'); ?>
                            <span>Tecnologia</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-chart-line">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-chart-line'); ?>
                            <span>Crescimento</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-graduation-cap">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-graduation-cap'); ?>
                            <span>Formação</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-globe">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-globe'); ?>
                            <span>Web</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-gear">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-gear'); ?>
                            <span>Processo</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-rocket">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-rocket'); ?>
                            <span>Inovação</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-circle-check">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-circle-check'); ?>
                            <span>Certificação</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-bullseye">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-bullseye'); ?>
                            <span>Objetivo</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-star">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-star'); ?>
                            <span>Destaque</span>
                        </label>
                    </div>
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Nome do curso</strong><br>
                    <input type="text" name="curso" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Instituição</strong><br>
                    <input type="text" name="instituicao" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>

                <button type="submit" style="background:#2563eb;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Adicionar curso</button>
            </form>
        </div>

        <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;">
            <h3>Shortcode de visualização</h3>
            <p>Use este shortcode em qualquer página:</p>
            <pre style="background:#f3f4f6;padding:12px;border-radius:8px;">[curriculo_cursos]</pre>
            <p>Exibe os cursos em cards 4-colunas com sanfona para os itens além de 4.</p>
        </div>
    </div>

    <div>
        <h3>Cursos cadastrados</h3>
        <?php if (empty($cursos)): ?>
            <p>Nenhum curso cadastrado.</p>
        <?php else: ?>
            <?php foreach ($cursos as $curso_item): ?>
                <form method="post" style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:20px;margin-bottom:16px;display:grid;grid-template-columns:1fr 1fr 1fr 140px;gap:12px;align-items:end;">
                    <input type="hidden" name="acao_cursos" value="salvar_curso">
                    <input type="hidden" name="curso_id" value="<?php echo esc_attr($curso_item['id']); ?>">
                    <?php wp_nonce_field('salvar_curso_acao'); ?>

                    <label style="display:block;">
                        <strong>Ícone</strong><br>
                        <div class="saas-icon-grid">
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-book" <?php checked($curso_item['icon'], 'fa-solid fa-book'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-book'); ?>
                                <span>Livro</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-lightbulb" <?php checked($curso_item['icon'], 'fa-solid fa-lightbulb'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-lightbulb'); ?>
                                <span>Conhecimento</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-flask" <?php checked($curso_item['icon'], 'fa-solid fa-flask'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-flask'); ?>
                                <span>Laboratório</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-laptop-code" <?php checked($curso_item['icon'], 'fa-solid fa-laptop-code'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-laptop-code'); ?>
                                <span>Tecnologia</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-chart-line" <?php checked($curso_item['icon'], 'fa-solid fa-chart-line'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-chart-line'); ?>
                                <span>Crescimento</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-graduation-cap" <?php checked($curso_item['icon'], 'fa-solid fa-graduation-cap'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-graduation-cap'); ?>
                                <span>Formação</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-globe" <?php checked($curso_item['icon'], 'fa-solid fa-globe'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-globe'); ?>
                                <span>Web</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-gear" <?php checked($curso_item['icon'], 'fa-solid fa-gear'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-gear'); ?>
                                <span>Processo</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-rocket" <?php checked($curso_item['icon'], 'fa-solid fa-rocket'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-rocket'); ?>
                                <span>Inovação</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-circle-check" <?php checked($curso_item['icon'], 'fa-solid fa-circle-check'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-circle-check'); ?>
                                <span>Certificação</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-bullseye" <?php checked($curso_item['icon'], 'fa-solid fa-bullseye'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-bullseye'); ?>
                                <span>Objetivo</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-star" <?php checked($curso_item['icon'], 'fa-solid fa-star'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-star'); ?>
                                <span>Destaque</span>
                            </label>
                            <?php if (!empty($curso_item['icon']) && !in_array($curso_item['icon'], ['fa-solid fa-book','fa-solid fa-lightbulb','fa-solid fa-flask','fa-solid fa-laptop-code','fa-solid fa-chart-line','fa-solid fa-graduation-cap','fa-solid fa-globe','fa-solid fa-gear','fa-solid fa-rocket','fa-solid fa-circle-check','fa-solid fa-bullseye','fa-solid fa-star'], true)): ?>
                                <label class="saas-icon-option">
                                    <input type="radio" name="icon" value="<?php echo esc_attr($curso_item['icon']); ?>" checked>
                                    <?php echo gerenciador_saas_render_icon($curso_item['icon']); ?>
                                    <span><?php echo esc_html($curso_item['icon']); ?></span>
                                </label>
                            <?php endif; ?>
                        </div>
                    </label>

                    <label style="display:block;">
                        <strong>Nome do curso</strong><br>
                        <input type="text" name="curso" value="<?php echo esc_attr($curso_item['curso']); ?>" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <label style="display:block;">
                        <strong>Instituição</strong><br>
                        <input type="text" name="instituicao" value="<?php echo esc_attr($curso_item['instituicao']); ?>" required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <div style="display:flex;flex-direction:column;gap:8px;">
                        <button type="submit" style="background:#16a34a;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Salvar</button>
                        <button type="submit" name="acao_cursos" value="excluir_curso" style="background:#dc2626;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Excluir</button>
                    </div>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>
