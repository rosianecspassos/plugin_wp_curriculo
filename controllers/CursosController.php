<?php

if (!defined('ABSPATH')) {
    exit;
}

class CursosController
{
    private $model;

    public function __construct()
    {
        $this->model = new CursoModel();
        add_action('init', [$this, 'init_hooks']);
    }

    public function init_hooks()
    {
        $this->process_post_requests();
        add_shortcode('sistema_cursos', [$this, 'render_panel']);
        add_shortcode('curriculo_cursos', [$this, 'render_curriculo_cursos']);
    }

    public function process_post_requests()
    {
        if (!is_user_logged_in()) {
            return;
        }

        if (!isset($_POST['acao_cursos']) || !isset($_POST['_wpnonce'])) {
            return;
        }

        if (!wp_verify_nonce($_POST['_wpnonce'], 'salvar_curso_acao')) {
            wp_die('Erro de segurança. Tente novamente.');
        }

        if (!gerenciador_saas_user_can_manage()) {
            return;
        }

        $action = sanitize_text_field($_POST['acao_cursos']);
        $icon = sanitize_text_field($_POST['icon'] ?? '');
        $curso = sanitize_text_field($_POST['curso'] ?? '');
        $instituicao = sanitize_text_field($_POST['instituicao'] ?? '');

        if ($action === 'salvar_curso' && isset($_POST['curso_id'])) {
            $curso_id = intval($_POST['curso_id']);
            $this->model->atualizar($curso_id, $icon, $curso, $instituicao);
            $this->redirect_success();
        }

        if ($action === 'excluir_curso' && isset($_POST['curso_id'])) {
            $curso_id = intval($_POST['curso_id']);
            $this->model->excluir($curso_id);
            $this->redirect_success();
        }

        if ($action === 'adicionar_curso') {
            $this->model->cadastrar(get_current_user_id(), $icon, $curso, $instituicao);
            $this->redirect_success();
        }
    }

    private function redirect_success()
    {
        $redirect_url = add_query_arg([
            'secao' => 'cursos',
            'status' => 'sucesso',
        ], wp_unslash($_SERVER['REQUEST_URI']));

        wp_safe_redirect($redirect_url);
        exit;
    }

    private function get_cursos()
    {
        return $this->model->buscar_por_usuario(get_current_user_id());
    }

    public function render_panel()
    {
        if (!is_user_logged_in()) {
            return '<p>Por favor, faça <a href="' . esc_url(home_url('/login')) . '">login</a>.</p>';
        }

        $cursos = $this->get_cursos();
        $status = isset($_GET['status']) && $_GET['status'] === 'sucesso';

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/painel-cursos.php';
        return ob_get_clean();
    }

    public function render_curriculo_cursos()
    {
        $cursos = $this->model->buscar_todos();

        ob_start();
        include plugin_dir_path(__FILE__) . '../views/curriculo-cursos.php';
        return ob_get_clean();
    }
}
