<?php

if (!defined('ABSPATH')) {
    exit;
}

class CompetenciasController
{
    private $model;

    public function __construct()
    {
        $this->model = new CompetenciaModel();
        add_action('init', [$this, 'init_hooks']);
    }

    public function init_hooks()
    {
        $this->process_post_requests();
        add_shortcode('sistema_competencias', [$this, 'render_panel']);
        add_shortcode('curriculo_competencias', [$this, 'render_curriculo_competencias']);
    }

    public function process_post_requests()
    {
        if (!is_user_logged_in()) {
            return;
        }

        if (!isset($_POST['acao_competencias']) || !isset($_POST['_wpnonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'salvar_competencia_acao')) {
            wp_die('Erro de segurança. Tente novamente.');
        }

        if (!gerenciador_saas_user_can_manage()) {
            return;
        }

        $action = sanitize_text_field($_POST['acao_competencias']);
        $icon = sanitize_text_field($_POST['icon'] ?? '');
        $titulo = sanitize_text_field($_POST['titulo'] ?? '');
        $descricao = wp_kses_post(wp_unslash($_POST['descricao'] ?? ''));

        if ($action === 'salvar_competencia' && isset($_POST['competencia_id'])) {
            $competencia_id = intval($_POST['competencia_id']);
            $this->model->atualizar($competencia_id, $icon, $titulo, $descricao);
            $this->redirect_success();
        }

        if ($action === 'excluir_competencia' && isset($_POST['competencia_id'])) {
            $competencia_id = intval($_POST['competencia_id']);
            $this->model->excluir($competencia_id);
            $this->redirect_success();
        }

        if ($action === 'adicionar_competencia') {
            $this->model->cadastrar(get_current_user_id(), $icon, $titulo, $descricao);
            $this->redirect_success();
        }
    }

    private function redirect_success()
    {
        $redirect_url = add_query_arg([
            'secao'  => 'competencias',
            'status' => 'sucesso',
        ], wp_unslash($_SERVER['REQUEST_URI']));

        wp_safe_redirect($redirect_url);
        exit;
    }

    private function get_competencias()
    {
        return $this->model->buscar_por_usuario(get_current_user_id());
    }

    public function render_panel()
    {
        if (!is_user_logged_in()) {
            return '<p>Por favor, faça <a href="' . esc_url(home_url('/login')) . '">login</a>.</p>';
        }

        $competencias = $this->get_competencias();
        $status = isset($_GET['status']) && $_GET['status'] === 'sucesso';

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/painel-competencias.php';
        return ob_get_clean();
    }

    public function render_curriculo_competencias()
    {
        $competencias = $this->model->buscar_todos();

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/curriculo-competencias.php';
        return ob_get_clean();
    }
}
