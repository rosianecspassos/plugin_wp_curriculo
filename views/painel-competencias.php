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
                    <div class="saas-icon-grid">
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-car">
                            <?php echo gerenciador_saas_render_icon('fas fa-car'); ?>
                            <span>Carro</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-book">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-book'); ?>
                            <span>Livro</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-gear">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-gear'); ?>
                            <span>Configuração</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-bullseye">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-bullseye'); ?>
                            <span>Meta</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-bullseye">
                            <?php echo gerenciador_saas_render_icon('fas fa-bullseye'); ?>
                            <span>Gráfico</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-laptop-code">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-laptop-code'); ?>
                            <span>Dev</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-rocket">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-rocket'); ?>
                            <span>Estratégia</span>
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
                            <input type="radio" name="icon" value="fa-solid fa-circle-check">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-circle-check'); ?>
                            <span>Sucesso</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-database">
                            <?php echo gerenciador_saas_render_icon('fas fa-database'); ?>
                            <span>Banco de dados</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-star">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-star'); ?>
                            <span>Destaque</span>
                        </label>
                            <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-laptop">
                            <?php echo gerenciador_saas_render_icon('fas fa-laptop'); ?>
                            <span>Computador</span>
                        </label>
                              <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-code">
                            <?php echo gerenciador_saas_render_icon('fas fa-code'); ?>
                            <span>Programação código</span>
                        </label>
                                   <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-code-branch">
                            <?php echo gerenciador_saas_render_icon('fas fa-code-branch'); ?>
                            <span>Versionamento Branch</span>
                        </label>
                                       <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-terminal">
                            <?php echo gerenciador_saas_render_icon('fas fa-terminal'); ?>
                            <span>Terminal</span>
                        </label>
                                         <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-bug">
                            <?php echo gerenciador_saas_render_icon('fas fa-bug'); ?>
                            <span>Bug</span>
                        </label>
                                         <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-pallete">
                            <?php echo gerenciador_saas_render_icon('fas fa-pallete'); ?>
                            <span>Arte</span>
                        </label>
                                     <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-file-word">
                            <?php echo gerenciador_saas_render_icon('fas fa-file-word'); ?>
                            <span>Word</span>
                        </label>

                                       <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-file-image">
                            <?php echo gerenciador_saas_render_icon('fas fa-file-image'); ?>
                            <span>Arte</span>
                        </label>
                    </div>
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
                        <div class="saas-icon-grid">
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-lightbulb" <?php checked($competencia['icon'], 'fa-solid fa-lightbulb'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-lightbulb'); ?>
                                <span>Luz</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-book" <?php checked($competencia['icon'], 'fa-solid fa-book'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-book'); ?>
                                <span>Livro</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-gear" <?php checked($competencia['icon'], 'fa-solid fa-gear'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-gear'); ?>
                                <span>Configuração</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-bullseye" <?php checked($competencia['icon'], 'fa-solid fa-bullseye'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-bullseye'); ?>
                                <span>Meta</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-chart-line" <?php checked($competencia['icon'], 'fa-solid fa-chart-line'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-chart-line'); ?>
                                <span>Gráfico</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-laptop-code" <?php checked($competencia['icon'], 'fa-solid fa-laptop-code'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-laptop-code'); ?>
                                <span>Tecnologia</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-rocket" <?php checked($competencia['icon'], 'fa-solid fa-rocket'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-rocket'); ?>
                                <span>Estratégia</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-graduation-cap" <?php checked($competencia['icon'], 'fa-solid fa-graduation-cap'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-graduation-cap'); ?>
                                <span>Formação</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-globe" <?php checked($competencia['icon'], 'fa-solid fa-globe'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-globe'); ?>
                                <span>Web</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-circle-check" <?php checked($competencia['icon'], 'fa-solid fa-circle-check'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-circle-check'); ?>
                                <span>Sucesso</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-brain" <?php checked($competencia['icon'], 'fa-solid fa-brain'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-brain'); ?>
                                <span>Ideia</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-star" <?php checked($competencia['icon'], 'fa-solid fa-star'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-star'); ?>
                                <span>Destaque</span>
                            </label>
                            <?php if (!empty($competencia['icon']) && !in_array($competencia['icon'], ['fa-solid fa-lightbulb','fa-solid fa-book','fa-solid fa-gear','fa-solid fa-bullseye','fa-solid fa-chart-line','fa-solid fa-laptop-code','fa-solid fa-rocket','fa-solid fa-graduation-cap','fa-solid fa-globe','fa-solid fa-circle-check','fa-solid fa-brain','fa-solid fa-star'], true)): ?>
                                <label class="saas-icon-option">
                                    <input type="radio" name="icon" value="<?php echo esc_attr($competencia['icon']); ?>" checked>
                                    <?php echo gerenciador_saas_render_icon($competencia['icon']); ?>
                                    <span><?php echo esc_html($competencia['icon']); ?></span>
                                </label>
                            <?php endif; ?>
                        </div>
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
     