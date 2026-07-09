<?php

if (!defined('ABSPATH')) {
    exit;
}

class FormacaoController {
    private $model;

    public function __construct() {
        $this->model = new FormacaoModel();
        add_action('init', [$this, 'init_hooks']);
    }

    public function init_hooks() {
        $this->process_post_requests();
        add_shortcode('sistema_formacoes', [$this, 'render_panel']);
        add_shortcode('curriculo_formacoes', [$this, 'render_formacoes_curriculo']);
      
    }

    public function process_post_requests() {
        if (!is_user_logged_in()) {
            return;
        }

        if (!isset($_POST['acao_formacao']) || !isset($_POST['_wpnonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'salvar_formacao_acao')) {
            wp_die('Erro de segurança. Tente novamente.');
        }

        if (!current_user_can('manage_options')) {
            return;
        }

        $action = sanitize_text_field($_POST['acao_formacao']);
        $curso = sanitize_text_field($_POST['curso'] ?? '');
        $instituicao = sanitize_text_field($_POST['instituicao'] ?? '');
        $grau = sanitize_text_field($_POST['grau'] ?? '');
        $titulo = sanitize_text_field($_POST['titulo'] ?? '');
        $status = sanitize_text_field($_POST['status'] ?? 'concluido');
        $ano_conclusao = intval($_POST['ano_conclusao'] ?? 0);

        if ($action === 'salvar_formacao' && isset($_POST['formacao_id'])) {
            $formacao_id = intval($_POST['formacao_id']);
            $this->model->atualizar($formacao_id, $curso, $instituicao, $grau, $titulo, $status, $ano_conclusao);
            $this->redirect_success();
        }

        if ($action === 'excluir_formacao' && isset($_POST['formacao_id'])) {
            $formacao_id = intval($_POST['formacao_id']);
            $this->model->excluir($formacao_id);
            $this->redirect_success();
        }

        if ($action === 'adicionar_formacao') {
            $this->model->cadastrar(get_current_user_id(), $curso, $instituicao, $grau, $titulo, $status, $ano_conclusao);
            $this->redirect_success();
        }
    }

    private function redirect_success() {
        $redirect_url = add_query_arg('formacao_success', '1', wp_get_referer());
        wp_safe_redirect($redirect_url);
        exit;
    }

    private function get_formacoes() {
        return $this->model->buscar_por_usuario(get_current_user_id());
    }

    public function render_panel() {
        if (!is_user_logged_in()) {
            return '<p>Por favor, faça <a href="' . esc_url(home_url('/login')) . '">login</a>.</p>';
        }

        $formacoes = $this->get_formacoes();
        $status = isset($_GET['formacao_success']) && $_GET['formacao_success'] === '1';
        $formacao_em_edicao = null;

        if (!empty($_GET['editar'])) {
            $formacao_id = intval($_GET['editar']);
            foreach ($formacoes as $formacao) {
                if (intval($formacao['id']) === $formacao_id) {
                    $formacao_em_edicao = $formacao;
                    break;
                }
            }
        }

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/painel-formacao.php';
        return ob_get_clean();
    }

    public function render_formacoes_curriculo() {
        $formacoes = $this->model->buscar_todos();

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/curriculo-formacao.php';
        return ob_get_clean();
    }
}