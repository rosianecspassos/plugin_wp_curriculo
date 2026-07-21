<?php

if (!defined('ABSPATH')) {
    exit;
}

// 1. Processa o login ANTES de carregar o HTML da página
add_action('init', 'processar_login_usuario');
add_action('wp_enqueue_scripts', 'gerenciador_saas_enqueue_assets');
add_action('admin_enqueue_scripts', 'gerenciador_saas_enqueue_assets');
add_shortcode('login_usuario', 'render_login');

function gerenciador_saas_enqueue_assets()
{
    wp_enqueue_style(
        'font-awesome',
        'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css',
        [],
        null
    );

    wp_enqueue_style(
        'gerenciador-saas-admin',
        GERENCIADOR_SAAS_URL . 'assets/css/admin.css',
        [],
        '1.0.2'
    );
}

function gerenciador_saas_render_icon($icon = '')
{
    if (empty($icon)) {
        return '';
    }

    $icon_class = trim($icon);

    if (strpos($icon_class, 'fa') === 0) {
        return '<i class="' . esc_attr($icon_class) . '" aria-hidden="true"></i>';
    }

    return esc_html($icon);
}

function processar_login_usuario()
{
    // Só age se o formulário foi enviado
    if (!isset($_POST['login_usuario'])) {
        return;
    }

    // Segurança: Verifica se os campos existem
    $username = isset($_POST['username']) ? sanitize_text_field($_POST['username']) : '';
    $password = isset($_POST['password']) ? $_POST['password'] : '';

    $creds = [
        'user_login' => $username,
        'user_password' => $password,
        'remember' => true
    ];

    $user = wp_signon($creds, false);

    if (!is_wp_error($user)) {
        if (gerenciador_saas_user_can_manage($user)) {
            wp_redirect(home_url('/sistema-painel'));
            exit;
        }
    } else {
        // Se houver erro, podemos passar por URL ou usar uma Global para exibir no shortcode
        add_filter('login_errors_custom', function () {
            return "Login ou senha inválidos."; });
    }
}

// 2. Shortcode apenas exibe o formulário
function render_login()
{
    // Se já estiver logado, redireciona via JavaScript (fallback seguro para dentro de shortcode)
    if (is_user_logged_in()) {
        echo '<script>window.location.href="' . home_url('/sistema-painel') . '";</script>';
        return;
    }

    ob_start();

    // Exibe mensagem de erro se o login falhou
    if (isset($_POST['login_usuario']) && !is_user_logged_in()) {
        echo '<p class="saas-login-message saas-login-message-error">Usuário ou senha incorretos.</p>';
    }
    ?>

    <div class="saas-login-card">
        <div class="saas-login-icon">🔐</div>
        <h2>Acesse o painel</h2>
        <p class="saas-login-subtitle">Entre com suas credenciais para continuar.</p>

        <form method="post" class="saas-login-form">
            <label for="saas-username">Usuário</label>
            <input id="saas-username" type="text" name="username" placeholder="Digite seu usuário" autocomplete="username"
                required>

            <label for="saas-password">Senha</label>
            <input id="saas-password" type="password" name="password" placeholder="Digite sua senha"
                autocomplete="current-password" required>

            <button type="submit" name="login_usuario">Entrar</button>
        </form>
    </div>

    <?php
    return ob_get_clean();
}