<?php

if (!defined('ABSPATH')) {
    exit;
}

class ContatoController
{
    private $destinatario = 'rosianecristinasi2013@gmail.com';
    private $ultimo_status = '';

    public function __construct()
    {
        add_action('init', [$this, 'processar_formulario']);
        add_shortcode('formulario_contato', [$this, 'render_form']);
        add_shortcode('contato', [$this, 'render_form']);
    }

    public function processar_formulario()
    {
        if (!isset($_POST['contato_submit'])) {
            return;
        }

        if (!isset($_POST['_wpnonce']) || !wp_verify_nonce($_POST['_wpnonce'], 'contato_form')) {
            wp_die('Erro de segurança. Tente novamente.');
        }

        $nome = isset($_POST['nome']) ? sanitize_text_field(wp_unslash($_POST['nome'])) : '';
        $email = isset($_POST['email']) ? sanitize_email(wp_unslash($_POST['email'])) : '';
        $mensagem = isset($_POST['mensagem']) ? sanitize_textarea_field(wp_unslash($_POST['mensagem'])) : '';

        if (empty($nome) || empty($email) || empty($mensagem) || !is_email($email)) {
            $this->ultimo_status = 'erro';
            return;
        }

        $assunto = sprintf('Novo contato do site: %s', $nome);
        $corpo = "Nome: {$nome}\nEmail: {$email}\n\nMensagem:\n{$mensagem}";
        $headers = [
            'Content-Type: text/plain; charset=UTF-8',
            'Reply-To: ' . $email,
        ];

        $enviado = wp_mail($this->destinatario, $assunto, $corpo, $headers);
        $this->ultimo_status = $enviado ? 'sucesso' : 'erro';
    }

    public function render_form()
    {
        ob_start();
        include GERENCIADOR_SAAS_PATH . 'views/formulario-contato.php';
        return ob_get_clean();
    }
}
