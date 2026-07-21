<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<div style="max-width:1000px;margin:0 auto;font-family:Arial,sans-serif;">
    <h2>Gerenciamento de Cursos</h2>
    <?php if (!empty($status)): ?>
        <div style="background:#d4edda;color:#155724;padding:16px;border-radius:10px;margin-bottom:20px;">✅ Curso salvo com
            sucesso!</div>
    <?php endif; ?>

    <div style="display:grid;grid-template-columns:1fr 1fr;gap:30px;margin-bottom:40px;">
        <div style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:24px;">
            <h3>Adicionar novo curso</h3>
            <form method="post">
                <input type="hidden" name="acao_cursos" value="adicionar_curso">
                <?php wp_nonce_field('salvar_curso_acao'); ?>

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
                            <input type="radio" name="icon" value="fa fa-wordpress">
                            <?php echo gerenciador_saas_render_icon('fa fa-wordpress'); ?>
                            <span>Wordpress</span>
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
                            <span>Branch</span>
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
                            <input type="radio" name="icon" value="fas fa-file-word">
                            <?php echo gerenciador_saas_render_icon('fas fa-file-word'); ?>
                            <span>Word</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa fa-linux">
                            <?php echo gerenciador_saas_render_icon('fa fa-linux'); ?>
                            <span>Linux</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fas fa-file-image">
                            <?php echo gerenciador_saas_render_icon('fas fa-file-image'); ?>
                            <span>Arte</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa fa-git">
                            <?php echo gerenciador_saas_render_icon('fa fa-git'); ?>
                            <span>Git</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa fa-github">
                            <?php echo gerenciador_saas_render_icon('fa fa-github'); ?>
                            <span>GitHub</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa fa-windows">
                            <?php echo gerenciador_saas_render_icon('fa fa-windows'); ?>
                            <span>Windows</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa fa-html5">
                            <?php echo gerenciador_saas_render_icon('fa fa-html5'); ?>
                            <span>HTML</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-docker">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-docker'); ?>
                            <span>Docker</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-css">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-css'); ?>
                            <span>CSS</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-php">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-php'); ?>
                            <span>PHP</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-laravel">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-laravel'); ?>
                            <span>Laravel</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-sass">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-sass'); ?>
                            <span>Sass</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-js">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-js'); ?>
                            <span>JavaScript</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-node">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-node'); ?>
                            <span>Node</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-bootstrap">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-bootstrap'); ?>
                            <span>Bootstrap</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-composer">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-composer'); ?>
                            <span>Composer</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-brands fa-npm">
                            <?php echo gerenciador_saas_render_icon('fa-brands fa-npm'); ?>
                            <span>NPM</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-diagram-project">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-diagram-project'); ?>
                            <span>Diagramas UML</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-table">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-table'); ?>
                            <span>Planilhas</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-person-dots-from-line">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-person-dots-from-line'); ?>
                            <span>Vendedor</span>
                        </label>
                        <label class="saas-icon-option">
                            <input type="radio" name="icon" value="fa-solid fa-file-pen">
                            <?php echo gerenciador_saas_render_icon('fa-solid fa-file-pen'); ?>
                            <span>Arquivo e caneta</span>
                        </label>
                    </div>
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Nome do curso</strong><br>
                    <input type="text" name="curso" required
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>

                <label style="display:block;margin-bottom:14px;">
                    <strong>Instituição</strong><br>
                    <input type="text" name="instituicao" required
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                </label>

                <button type="submit"
                    style="background:#2563eb;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;">Adicionar
                    curso</button>
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
                <form method="post"
                    style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:20px;margin-bottom:16px;display:grid;grid-template-columns:1fr 1fr 1fr 140px;gap:12px;align-items:end;">
                    <input type="hidden" name="acao_cursos" value="salvar_curso">
                    <input type="hidden" name="curso_id" value="<?php echo esc_attr($curso_item['id']); ?>">
                    <?php wp_nonce_field('salvar_curso_acao'); ?>

                    <label style="display:block;">
                        <strong>Ícone</strong><br>
                        <div class="saas-icon-grid">
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-car" <?php checked($curso_item['icon'], 'fas fa-car'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-car'); ?>
                                <span>Carro</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-book" <?php checked($curso_item['icon'], 'fa-solid fa-book'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-book'); ?>
                                <span>Livro</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-gear" <?php checked($curso_item['icon'], 'fa-solid fa-gear'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-gear'); ?>
                                <span>Configuração</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-bullseye" <?php checked($curso_item['icon'], 'fa-solid fa-bullseye'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-bullseye'); ?>
                                <span>Meta</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-bullseye" <?php checked($curso_item['icon'], 'fas fa-bullseye'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-bullseye'); ?>
                                <span>Gráfico</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-laptop-code" <?php checked($curso_item['icon'], 'fa-solid fa-laptop-code'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-laptop-code'); ?>
                                <span>Dev</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-rocket" <?php checked($curso_item['icon'], 'fa-solid fa-rocket'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-rocket'); ?>
                                <span>Estratégia</span>
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
                                <input type="radio" name="icon" value="fa-solid fa-circle-check" <?php checked($curso_item['icon'], 'fa-solid fa-circle-check'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-circle-check'); ?>
                                <span>Sucesso</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-database" <?php checked($curso_item['icon'], 'fas fa-database'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-database'); ?>
                                <span>Banco de dados</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa fa-wordpress" <?php checked($curso_item['icon'], 'fa fa-wordpress'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa fa-wordpress'); ?>
                                <span>Wordpress</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-laptop" <?php checked($curso_item['icon'], 'fas fa-laptop'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-laptop'); ?>
                                <span>Computador</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-code" <?php checked($curso_item['icon'], 'fas fa-code'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-code'); ?>
                                <span>Programação código</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-code-branch" <?php checked($curso_item['icon'], 'fas fa-code-branch'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-code-branch'); ?>
                                <span>Branch</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-terminal" <?php checked($curso_item['icon'], 'fas fa-terminal'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-terminal'); ?>
                                <span>Terminal</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-bug" <?php checked($curso_item['icon'], 'fas fa-bug'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-bug'); ?>
                                <span>Bug</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-file-word" <?php checked($curso_item['icon'], 'fas fa-file-word'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-file-word'); ?>
                                <span>Word</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa fa-linux" <?php checked($curso_item['icon'], 'fa fa-linux'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa fa-linux'); ?>
                                <span>Linux</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fas fa-file-image" <?php checked($curso_item['icon'], 'fas fa-file-image'); ?>>
                                <?php echo gerenciador_saas_render_icon('fas fa-file-image'); ?>
                                <span>Arte</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa fa-git" <?php checked($curso_item['icon'], 'fa fa-git'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa fa-git'); ?>
                                <span>Git</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa fa-github" <?php checked($curso_item['icon'], 'fa fa-github'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa fa-github'); ?>
                                <span>GitHub</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa fa-windows" <?php checked($curso_item['icon'], 'fa fa-windows'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa fa-windows'); ?>
                                <span>Windows</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa fa-html5" <?php checked($curso_item['icon'], 'fa fa-html5'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa fa-html5'); ?>
                                <span>HTML</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-docker" <?php checked($curso_item['icon'], 'fa-brands fa-docker'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-docker'); ?>
                                <span>Docker</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-css" <?php checked($curso_item['icon'], 'fa-brands fa-css'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-css'); ?>
                                <span>CSS</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-php" <?php checked($curso_item['icon'], 'fa-brands fa-php'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-php'); ?>
                                <span>PHP</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-laravel" <?php checked($curso_item['icon'], 'fa-brands fa-laravel'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-laravel'); ?>
                                <span>Laravel</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-sass" <?php checked($curso_item['icon'], 'fa-brands fa-sass'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-sass'); ?>
                                <span>Sass</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-js" <?php checked($curso_item['icon'], 'fa-brands fa-js'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-js'); ?>
                                <span>JavaScript</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-node" <?php checked($curso_item['icon'], 'fa-brands fa-node'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-node'); ?>
                                <span>Node</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-bootstrap" <?php checked($curso_item['icon'], 'fa-brands fa-bootstrap'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-bootstrap'); ?>
                                <span>Bootstrap</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-composer" <?php checked($curso_item['icon'], 'fa-brands fa-composer'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-composer'); ?>
                                <span>Composer</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-brands fa-npm" <?php checked($curso_item['icon'], 'fa-brands fa-npm'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-brands fa-npm'); ?>
                                <span>NPM</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-diagram-project" <?php checked($curso_item['icon'], 'fa-solid fa-diagram-project'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-diagram-project'); ?>
                                <span>Diagramas UML</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-table" <?php checked($curso_item['icon'], 'fa-solid fa-table'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-table'); ?>
                                <span>Planilhas</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-person-dots-from-line" <?php checked($curso_item['icon'], 'fa-solid fa-person-dots-from-line'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-person-dots-from-line'); ?>
                                <span>Vendedor</span>
                            </label>
                            <label class="saas-icon-option">
                                <input type="radio" name="icon" value="fa-solid fa-file-pen" <?php checked($curso_item['icon'], 'fa-solid fa-file-pen'); ?>>
                                <?php echo gerenciador_saas_render_icon('fa-solid fa-file-pen'); ?>
                                <span>Arquivo e caneta</span>
                            </label>

                            <?php
                            // Verifica se o ícone não é nenhum dos padrões acima, caso exista a possibilidade no seu sistema
                            $icones_padroes = [
                                'fas fa-car',
                                'fa-solid fa-book',
                                'fa-solid fa-gear',
                                'fa-solid fa-bullseye',
                                'fas fa-bullseye',
                                'fa-solid fa-laptop-code',
                                'fa-solid fa-rocket',
                                'fa-solid fa-graduation-cap',
                                'fa-solid fa-globe',
                                'fa-solid fa-circle-check',
                                'fas fa-database',
                                'fa fa-wordpress',
                                'fas fa-laptop',
                                'fas fa-code',
                                'fas fa-code-branch',
                                'fas fa-terminal',
                                'fas fa-bug',
                                'fas fa-file-word',
                                'fa fa-linux',
                                'fas fa-file-image',
                                'fa fa-git',
                                'fa fa-github',
                                'fa fa-windows',
                                'fa fa-html5',
                                'fa-brands fa-docker',
                                'fa-brands fa-css',
                                'fa-brands fa-php',
                                'fa-brands fa-laravel',
                                'fa-brands fa-sass',
                                'fa-brands fa-js',
                                'fa-brands fa-node',
                                'fa-brands fa-bootstrap',
                                'fa-brands fa-composer',
                                'fa-brands fa-npm',
                                'fa-solid fa-diagram-project',
                                'fa-solid fa-table',
                                'fa-solid fa-person-dots-from-line',
                                'fa-solid fa-file-pen'
                            ];
                            if (!empty($curso_item['icon']) && !in_array($curso_item['icon'], $icones_padroes, true)): ?>
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
                        <input type="text" name="curso" value="<?php echo esc_attr($curso_item['curso']); ?>" required
                            style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <label style="display:block;">
                        <strong>Instituição</strong><br>
                        <input type="text" name="instituicao" value="<?php echo esc_attr($curso_item['instituicao']); ?>"
                            required style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;">
                    </label>

                    <div style="display:flex;flex-direction:column;gap:8px;">
                        <button type="submit"
                            style="background:#16a34a;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;"><i class="fa-solid fa-pen-to-square"></i></button>
                        <button type="submit" name="acao_cursos" value="excluir_curso"
                            style="background:#dc2626;color:#fff;padding:12px 20px;border:none;border-radius:10px;cursor:pointer;"><i class="fa-solid fa-trash-can"></i></button>
                    </div>
                </form>
            <?php endforeach; ?>
        <?php endif; ?>
    </div>
</div>