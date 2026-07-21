<?php
if (!defined('ABSPATH')) {
    exit;
}

class PortifolioController
{
    private $model;

    public function __construct()
    {
        $this->model = new PortifolioModel();
        add_action('init', [$this, 'init_hooks']);
    }

    public function init_hooks()
    {
        $this->process_post_requests();
        add_shortcode('sistema_portifolio', [$this, 'render_panel']);
        add_shortcode('curriculo_portifolio', [$this, 'render_curriculo_portifolio']);
    }

    public function process_post_requests()
    {
        if (!is_user_logged_in()) {
            return;
        }

        if (!isset($_POST['acao_portifolio']) || !isset($_POST['_wpnonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'salvar_portifolio_acao')) {
            wp_die('Erro de segurança. Tente novamente.');
        }

        if (!gerenciador_saas_user_can_manage()) {
            return;
        }

        $action = sanitize_text_field($_POST['acao_portifolio']);
        $titulo = sanitize_text_field($_POST['titulo'] ?? '');
        $descricao = sanitize_textarea_field($_POST['descricao'] ?? '');
        $imagem = esc_url_raw($_POST['imagem'] ?? '');
        $link_projeto = esc_url_raw($_POST['link_projeto'] ?? '');
        $link_github = esc_url_raw($_POST['link_github'] ?? '');

        if ($action === 'salvar_portifolio' && isset($_POST['portifolio_id'])) {
            $id = intval($_POST['portifolio_id']);
            $this->model->atualizar($id, $titulo, $descricao, $imagem, $link_projeto, $link_github);
            $this->redirect_success();
        }

        if ($action === 'excluir_portifolio' && isset($_POST['portifolio_id'])) {
            $id = intval($_POST['portifolio_id']);
            $this->model->excluir($id);
            $this->redirect_success();
        }

        if ($action === 'adicionar_portifolio') {
            $this->model->cadastrar(get_current_user_id(), $titulo, $descricao, $imagem, $link_projeto, $link_github);
            $this->redirect_success();
        }
    }

    private function redirect_success()
    {
        $redirect_url = add_query_arg([
            'secao' => 'portifolio',
            'status' => 'sucesso',
        ], wp_unslash($_SERVER['REQUEST_URI']));

        wp_safe_redirect($redirect_url);
        exit;
    }

    private function get_portifolio()
    {
        return $this->model->buscar_por_usuario(get_current_user_id());
    }

    public function render_panel()
    {
        if (!is_user_logged_in()) {
            return '<p>Por favor, faça <a href="' . esc_url(home_url('/login')) . '">login</a>.</p>';
        }

        $portifolio = $this->get_portifolio();
        $status = isset($_GET['status']) && $_GET['status'] === 'sucesso';

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/painel-portifolio.php';
        return ob_get_clean();
    }

    public function render_curriculo_portifolio()
    {
        $portifolio = $this->model->buscar_todos();

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/curriculo-portifolio.php';
        return ob_get_clean();
    }
}