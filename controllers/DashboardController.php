<?php

if (!defined('ABSPATH')) {
    exit;
}

class DashboardController
{
    public function __construct()
    {
        add_action('init', [$this, 'init_hooks']);
    }

    public function init_hooks()
    {
        // Process POSTs early so redirects and updates happen before output
        $this->process_post_requests();

        // Register painel shortcode during init
        add_shortcode('sistema_painel', [$this, 'render_panel']);
    }

    public function process_post_requests()
    {
        if (!is_user_logged_in()) {
            return;
        }

        if (isset($_POST['acao_painel']) && $_POST['acao_painel'] === 'cadastrar_usuario') {
            if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'cadastrar_usuario_acao')) {
                wp_die('Erro de segurança. Tente novamente.');
            }

            if (!current_user_can('manage_options') && !current_user_can('create_users') && !current_user_can('gerenciar_curriculo_saas')) {
                wp_die('Você não tem permissão para cadastrar usuários.');
            }

            $username = sanitize_user($_POST['username'] ?? '');
            $email = sanitize_email($_POST['email'] ?? '');
            $first_name = sanitize_text_field($_POST['first_name'] ?? '');
            $last_name = sanitize_text_field($_POST['last_name'] ?? '');
            $password = isset($_POST['password']) ? $_POST['password'] : '';

            if (empty($username) || empty($email)) {
                $this->redirect_usuario('erro', 'Preencha usuário e e-mail.');
            }

            if (username_exists($username) || email_exists($email)) {
                $this->redirect_usuario('erro', 'Usuário ou e-mail já existem.');
            }

            if (empty($password)) {
                $password = wp_generate_password(16, true, true);
            }

            $user_id = wp_insert_user([
                'user_login' => $username,
                'user_email' => $email,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'display_name' => trim($first_name . ' ' . $last_name) ?: $username,
                'role' => 'usuarios_internos',
                'user_pass' => $password,
            ]);

            if (is_wp_error($user_id)) {
                $this->redirect_usuario('erro', 'Não foi possível criar o usuário.');
            }

            if (function_exists('wp_new_user_notification')) {
                wp_new_user_notification($user_id, null, 'user');
            }

            $this->redirect_usuario('sucesso', 'Usuário cadastrado com sucesso.');
        }

        if (isset($_POST['acao_painel']) && $_POST['acao_painel'] === 'salvar_pagina') {
            if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'salvar_pagina_acao')) {
                wp_die('Erro de segurança. Tente novamente.');
            }

            $pagina_id = intval($_POST['pagina_id']);
            $novo_conteudo = wp_kses_post(wp_unslash($_POST['conteudo']));

            if (current_user_can('edit_pages')) {
                $updated = wp_update_post([
                    'ID' => $pagina_id,
                    'post_content' => $novo_conteudo,
                ]);

                if ($updated) {
                    $secao = isset($_GET['secao']) ? sanitize_text_field($_GET['secao']) : 'dashboard';
                    $redirect_url = add_query_arg([
                        'secao' => $secao,
                        'status' => 'sucesso',
                    ], wp_unslash($_SERVER['REQUEST_URI']));

                    wp_safe_redirect($redirect_url);
                    exit;
                }
            }
        }
    }

    private function redirect_usuario($status, $message)
    {
        $redirect_url = add_query_arg([
            'secao' => 'usuarios',
            'status' => $status,
            'message' => urlencode($message),
        ], wp_unslash($_SERVER['REQUEST_URI']));

        wp_safe_redirect($redirect_url);
        exit;
    }

    public function render_panel()
    {
        if (!is_user_logged_in()) {
            return '<p>Por favor, faça <a href="' . esc_url(home_url('/login')) . '">login</a>.</p>';
        }

        $user = wp_get_current_user();
        $secao = isset($_GET['secao']) ? sanitize_text_field($_GET['secao']) : 'dashboard';

        ob_start();
        ?>
        <div class="painel-container" style="display:flex; min-height:600px; border:1px solid #ddd;">
            <div class="menu" style="width:200px; background:#2c3e50; padding:20px; color:#fff;">
                <h4 style="margin-top:0;">Menu</h4>
                <a href="?secao=dashboard" style="color:#fff; display:block; margin-bottom:10px;">🏠 Dashboard</a>
                <a href="?secao=home" style="color:#fff; display:block; margin-bottom:10px;">📄 Home</a>

                <!--Adiciona o link para form-idiomas.php-->
                <a href="?secao=idiomas" style="color:#fff; display:block; margin-bottom:10px;">🌐 Idiomas</a>
                <a href="?secao=competencias" style="color:#fff; display:block; margin-bottom:10px;">💼 Competências</a>
                <a href="?secao=cursos" style="color:#fff; display:block; margin-bottom:10px;">📚 Cursos</a>
                <a href="?secao=experiencias" style="color:#fff; display:block; margin-bottom:10px;">💼 Experiências</a>
                <a href="?secao=formacoes" style="color:#fff; display:block; margin-bottom:10px;">🎓 Formações</a>
                <a href="?secao=portifolio" style="color:#fff; display:block; margin-bottom:10px;">🖼️ Portfólio</a>
                <a href="?secao=usuarios" style="color:#fff; display:block; margin-bottom:10px;">👤 Usuários</a>

                <hr>

                <a href="<?php echo esc_url(wp_logout_url(home_url('/login'))); ?>" style="color:#ff7675;">Sair</a>
            </div>

            <div class="conteudo" style="flex:1; padding:30px; background:#f9f9f9;">
                <?php
                if (isset($_GET['status']) && $_GET['status'] === 'sucesso') {
                    echo '<div style="background:#d4edda; color:#155724; padding:15px; margin-bottom:20px; border-radius:5px;">✅ Alterações salvas com sucesso!</div>';
                }

                if ($secao === 'dashboard') {
                    echo '<h2>Olá, ' . esc_html($user->display_name) . '!</h2><p>Selecione uma página ao lado para editar o conteúdo diretamente por aqui.</p><p><a href="?secao=cursos" style="color:#2563eb;">Ir para o formulário de cursos</a></p>';
                } elseif ($secao === 'usuarios') {
                    $this->render_user_management();
                } elseif ($secao === 'idiomas') {
                    echo do_shortcode('[sistema_idiomas]');
                } elseif ($secao === 'competencias') {
                    echo do_shortcode('[sistema_competencias]');
                } elseif ($secao === 'cursos') {
                    echo do_shortcode('[sistema_cursos]');
                } elseif ($secao === 'experiencias') {
                    echo do_shortcode('[sistema_experiencias]');
                } elseif ($secao === 'formacoes') {
                    echo do_shortcode('[sistema_formacoes]');
                } elseif ($secao === 'portifolio') {
                    echo do_shortcode('[sistema_portifolio]');
                } else {
                    $this->generate_dynamic_editor($secao);
                }
                ?>
            </div>
        </div>
        <?php

        return ob_get_clean();
    }

    private function render_user_management()
    {
        if (!current_user_can('manage_options') && !current_user_can('create_users') && !current_user_can('gerenciar_curriculo_saas')) {
            echo '<p>Você não tem permissão para cadastrar usuários.</p>';
            return;
        }

        $status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
        $message = isset($_GET['message']) ? urldecode(sanitize_text_field(wp_unslash($_GET['message']))) : '';

        if ($status === 'sucesso' && $message) {
            echo '<div style="background:#d4edda;color:#155724;padding:15px;margin-bottom:20px;border-radius:5px;">✅ ' . esc_html($message) . '</div>';
        } elseif ($status === 'erro' && $message) {
            echo '<div style="background:#f8d7da;color:#842029;padding:15px;margin-bottom:20px;border-radius:5px;">⚠️ ' . esc_html($message) . '</div>';
        }

        // =========================================================================
        // 1. PROCESSAMENTO DAS AÇÕES (UPDATE E DELETE)
        // =========================================================================
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['acao_painel'])) {

            // Processa Atualização de Usuário (UPDATE)
            if ($_POST['acao_painel'] === 'editar_usuario') {
                if (check_admin_referer('editar_usuario_acao')) {
                    $user_id = intval($_POST['user_id']);

                    $userdata = [
                        'ID' => $user_id,
                        'user_email' => sanitize_email($_POST['email'] ?? ''),
                        'first_name' => sanitize_text_field($_POST['first_name'] ?? ''),
                        'last_name' => sanitize_text_field($_POST['last_name'] ?? ''),
                    ];

                    // Só altera a senha se o campo não estiver vazio
                    if (!empty($_POST['password'])) {
                        $userdata['user_pass'] = $_POST['password'];
                    }

                    $updated = wp_update_user($userdata);

                    if (!is_wp_error($updated)) {
                        echo '<div style="padding:12px;background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:8px;margin-bottom:15px;max-width:700px;">Usuário atualizado com sucesso!</div>';
                    } else {
                        echo '<div style="padding:12px;background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:8px;margin-bottom:15px;max-width:700px;">Erro ao atualizar: ' . esc_html($updated->get_error_message()) . '</div>';
                    }
                }
            }

            // Processa Exclusão de Usuário (DELETE)
            if ($_POST['acao_painel'] === 'deletar_usuario') {
                if (check_admin_referer('deletar_usuario_acao')) {
                    $user_id = intval($_POST['user_id']);

                    // Trava para evitar autoexclusão da conta atual
                    if (get_current_user_id() !== $user_id) {
                        require_once(ABSPATH . 'wp-admin/includes/user.php');
                        if (wp_delete_user($user_id)) {
                            echo '<div style="padding:12px;background:#dcfce7;color:#166534;border:1px solid #bbf7d0;border-radius:8px;margin-bottom:15px;max-width:700px;">Usuário excluído com sucesso!</div>';
                        } else {
                            echo '<div style="padding:12px;background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:8px;margin-bottom:15px;max-width:700px;">Erro ao excluir o usuário.</div>';
                        }
                    } else {
                        echo '<div style="padding:12px;background:#fee2e2;color:#991b1b;border:1px solid #fecaca;border-radius:8px;margin-bottom:15px;max-width:700px;">Você não pode excluir a sua própria conta por este painel!</div>';
                    }
                }
            }
        }

        // =========================================================================
        // 2. FORMULÁRIO DE CADASTRO (CREATE)
        // =========================================================================
        echo '<h2>Cadastrar usuários</h2>';
        echo '<p>Crie contas internas para o painel com acesso ao conteúdo do currículo.</p>';
        ?>

        <form method="post"
            style="background:#fff;border:1px solid #ddd;border-radius:12px;padding:20px;margin-bottom:20px;max-width:700px;">
            <input type="hidden" name="acao_painel" value="cadastrar_usuario">
            <?php wp_nonce_field('cadastrar_usuario_acao'); ?>

            <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;">
                <label><strong>Usuário</strong><br><input type="text" name="username" required
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"></label>
                <label><strong>E-mail</strong><br><input type="email" name="email" required
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"></label>
                <label><strong>Nome</strong><br><input type="text" name="first_name"
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"></label>
                <label><strong>Sobrenome</strong><br><input type="text" name="last_name"
                        style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"></label>
            </div>

            <label style="display:block;margin-top:12px;"><strong>Senha</strong><br><input type="password" name="password"
                    placeholder="Opcional; se vazio, será gerada automaticamente"
                    style="width:100%;padding:10px;border:1px solid #ccc;border-radius:8px;"></label>
            <button type="submit"
                style="margin-top:16px;background:#2563eb;color:#fff;border:none;padding:12px 20px;border-radius:8px;cursor:pointer;">Cadastrar
                usuário</button>
        </form>

        <?php
        // =========================================================================
        // 3. TABELA COM LISTAGEM E AÇÕES (READ, UPDATE, DELETE)
        // =========================================================================
        $usuarios = get_users([
            'role' => 'usuarios_internos',
            'orderby' => 'display_name',
            'order' => 'ASC',
        ]);

        if (!empty($usuarios)) {
            echo '<h3>Usuários cadastrados</h3>';
            echo '<table style="width:100%;border-collapse:collapse;background:#fff;border:1px solid #ddd;max-width:900px;">';
            echo '<thead>
                    <tr style="background:#f3f4f6;">
                        <th style="text-align:left;padding:10px;border-bottom:1px solid #ddd;">Usuário</th>
                        <th style="text-align:left;padding:10px;border-bottom:1px solid #ddd;">E-mail</th>
                        <th style="text-align:left;padding:10px;border-bottom:1px solid #ddd;">Função</th>
                        <th style="text-align:center;padding:10px;border-bottom:1px solid #ddd;">Ações</th>
                    </tr>
                  </thead>
                  <tbody>';

            foreach ($usuarios as $usuario) {
                $first_name = get_user_meta($usuario->ID, 'first_name', true);
                $last_name = get_user_meta($usuario->ID, 'last_name', true);

                echo '<tr>';
                echo '<td style="padding:10px;border-bottom:1px solid #ddd;">' . esc_html($usuario->display_name ?: $usuario->user_login) . '</td>';
                echo '<td style="padding:10px;border-bottom:1px solid #ddd;">' . esc_html($usuario->user_email) . '</td>';
                echo '<td style="padding:10px;border-bottom:1px solid #ddd;">' . esc_html(implode(', ', $usuario->roles)) . '</td>';

                // Botões de Ação Alinhados
                echo '<td style="padding:10px;border-bottom:1px solid #ddd;text-align:center;">';
                echo '<div style="display:inline-flex;align-items:center;justify-content:center;gap:8px;">';

                // Botão Editar (Abre a Modal via JS)
                echo '<button type="button" onclick="abrirModalEdicao(' . esc_attr($usuario->ID) . ', \'' . esc_js(esc_attr($usuario->user_email)) . '\', \'' . esc_js(esc_attr($first_name)) . '\', \'' . esc_js(esc_attr($last_name)) . '\')" style="background:#f59e0b;color:#fff;border:none;width:36px;height:36px;border-radius:6px;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;margin:0;padding:0;"><i class="fa-solid fa-pen-to-square"></i></button>';

                // Form/Botão Deletar
                echo '<form method="post" style="display:inline-flex;margin:0;" onsubmit="return confirm(\'Deseja mesmo excluir o usuário ' . esc_attr($usuario->user_login) . '?\');">';
                echo '<input type="hidden" name="acao_painel" value="deletar_usuario">';
                echo '<input type="hidden" name="user_id" value="' . esc_attr($usuario->ID) . '">';
                wp_nonce_field('deletar_usuario_acao');
                echo '<button type="submit" style="background:#ef4444;color:#fff;border:none;width:36px;height:36px;border-radius:6px;cursor:pointer;display:inline-flex;align-items:center;justify-content:center;margin:0;padding:0;"><i class="fa-solid fa-trash-can"></i></button>';
                echo '</form>';

                echo '</div>';
                echo '</td>';
                echo '</tr>';
            }
            echo '</tbody></table>';
        }
        ?>

        <!-- =========================================================================
             4. MODAL DE EDIÇÃO (Estrutura HTML/CSS + Script JavaScript)
             ========================================================================= -->
        <div id="modal-editar-usuario"
            style="display:none;position:fixed;top:0;left:0;width:100%;height:100%;background:rgba(0,0,0,0.5);align-items:center;justify-content:center;z-index:99999;">
            <div
                style="background:#fff;padding:24px;border-radius:12px;width:100%;max-width:500px;box-shadow:0 20px 25px -5px rgba(0,0,0,0.1);">
                <h3 style="margin-top:0;margin-bottom:16px;">Editar Usuário</h3>

                <form method="post">
                    <input type="hidden" name="acao_painel" value="editar_usuario">
                    <input type="hidden" name="user_id" id="edit_user_id">
                    <?php wp_nonce_field('editar_usuario_acao'); ?>

                    <div style="display:grid;grid-template-columns:1fr 1fr;gap:12px;margin-bottom:12px;">
                        <label><strong>Nome</strong><br><input type="text" name="first_name" id="edit_first_name"
                                style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px;"></label>
                        <label><strong>Sobrenome</strong><br><input type="text" name="last_name" id="edit_last_name"
                                style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px;"></label>
                    </div>

                    <label style="display:block;margin-bottom:12px;"><strong>E-mail</strong><br><input type="email" name="email"
                            id="edit_email" required
                            style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px;"></label>
                    <label style="display:block;margin-bottom:16px;"><strong>Nova Senha</strong><br><input type="password"
                            name="password" placeholder="Deixe em branco para manter a atual"
                            style="width:100%;padding:8px;border:1px solid #ccc;border-radius:6px;"></label>

                    <div style="text-align:right;display:flex;gap:8px;justify-content:flex-end;">
                        <button type="button" onclick="fecharModalEdicao()"
                            style="background:#6b7280;color:#fff;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;">Cancelar</button>
                        <button type="submit"
                            style="background:#2563eb;color:#fff;border:none;padding:8px 16px;border-radius:6px;cursor:pointer;">Salvar
                            Alterações</button>
                    </div>
                </form>
            </div>
        </div>

        <script>
            function abrirModalEdicao(id, email, firstName, lastName) {
                document.getElementById('edit_user_id').value = id;
                document.getElementById('edit_email').value = email;
                document.getElementById('edit_first_name').value = firstName;
                document.getElementById('edit_last_name').value = lastName;
                document.getElementById('modal-editar-usuario').style.display = 'flex';
            }

            function fecharModalEdicao() {
                document.getElementById('modal-editar-usuario').style.display = 'none';
            }
        </script>
        <?php
    }

    // =========================================================================
    // 5. EDITOR DINÂMICO DE PÁGINAS
    // =========================================================================
    private function generate_dynamic_editor($slug)
    {
        $pagina = get_page_by_path($slug);

        if (!$pagina) {
            echo '<p>Página <strong>' . esc_html($slug) . '</strong> não encontrada. Verifique se o slug na URL está correto.</p>';
            return;
        }

        echo '<h3>Editando: ' . esc_html(get_the_title($pagina->ID)) . '</h3>';
        ?>
        <form method="post">
            <input type="hidden" name="acao_painel" value="salvar_pagina">
            <input type="hidden" name="pagina_id" value="<?php echo esc_attr($pagina->ID); ?>">
            <?php wp_nonce_field('salvar_pagina_acao'); ?>
            <?php wp_editor($pagina->post_content, 'conteudo', [
                'textarea_name' => 'conteudo',
                'media_buttons' => true,
                'textarea_rows' => 15,
            ]); ?>
            <br>
            <button type="submit"
                style="background:#27ae60; color:white; border:none; padding:10px 20px; border-radius:4px; cursor:pointer;">
                Salvar Alterações
            </button>
        </form>
        <?php
    }
}