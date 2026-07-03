<?php

if (!defined('ABSPATH')) {
    exit;
}
class ExperienciasController {
    private $model;

    public function __construct() {
        $this->model = new ExperienciaModel();
        add_action('init', [$this, 'init_hooks']);
    }

    public function init_hooks() {
        $this->process_post_requests();
        add_shortcode('curriculo_experiencias', [$this, 'render_experiencias_curriculo']);
        add_shortcode('curriculo-experiencias', [$this, 'render_experiencias_curriculo']);
        add_shortcode('sistema_experiencias', [$this, 'render_panel']);
        add_shortcode('sistema-experiencias', [$this, 'render_panel']);
    }

    public function process_post_requests() {
        if (!is_user_logged_in()) {
            return;
        }

        if (!isset($_POST['acao_experiencias']) || !isset($_POST['_wpnonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'salvar_experiencia_acao')) {
            wp_die('Erro de segurança. Tente novamente.');
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        $action = sanitize_text_field($_POST['acao_experiencias']);
        $cargo = sanitize_text_field($_POST['cargo'] ?? '');

        if ($action === 'salvar_experiencia' && isset($_POST['experiencia_id'])) {
            $experiencia_id = intval($_POST['experiencia_id']);
            $this->model->atualizar($experiencia_id, $cargo);
            $this->redirect_success();
        }

        if ($action === 'adicionar_experiencia') {
            $this->model->cadastrar(get_current_user_id(), $cargo);
            $this->redirect_success();
        }
    }

    private function redirect_success() {
        $redirect_url = add_query_arg([
            'secao'   => 'experiencias',
            'status'  => 'sucesso',
        ], wp_unslash($_SERVER['REQUEST_URI']));

        wp_safe_redirect($redirect_url);
        exit;
    }

    private function get_experiencias() {
        return $this->model->buscar_por_usuario(get_current_user_id());
    }

    public function render_panel() {
        if (!is_user_logged_in()) {
            return '<p>Por favor, faça <a href="' . esc_url(home_url('/login')) . '">login</a>.</p>';
        }

        $experiencias = $this->get_experiencias();
        $status = isset($_GET['status']) && $_GET['status'] === 'sucesso';

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/painel-experiencias.php';
        return ob_get_clean();
    }

    public function render_experiencias_curriculo() {
        $experiencias = $this->model->buscar_todos();

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/curriculo-experiencias.php';
        return ob_get_clean();
    }
}