<?php

if (!defined('ABSPATH')) {
    exit;
}

$status = isset($this->ultimo_status) ? $this->ultimo_status : '';
?>

<div class="formulario-contato" style="max-width: 600px; margin: 20px 0;">
    <?php if ($status === 'sucesso') : ?>
        <div style="padding: 12px; background: #d4edda; color: #155724; border: 1px solid #c3e6cb; margin-bottom: 15px;">
            Mensagem enviada com sucesso! Responderemos em breve.
        </div>
    <?php elseif ($status === 'erro') : ?>
        <div style="padding: 12px; background: #f8d7da; color: #721c24; border: 1px solid #f5c6cb; margin-bottom: 15px;">
            Não foi possível enviar sua mensagem. Tente novamente mais tarde.
        </div>
    <?php endif; ?>

    <form method="post" action="">
        <?php wp_nonce_field('contato_form'); ?>

        <p>
            <label for="nome-contato">Nome</label><br>
            <input type="text" id="nome-contato" name="nome" required style="width: 100%; padding: 8px;">
        </p>

        <p>
            <label for="email-contato">E-mail</label><br>
            <input type="email" id="email-contato" name="email" required style="width: 100%; padding: 8px;">
        </p>

        <p>
            <label for="mensagem-contato">Mensagem</label><br>
            <textarea id="mensagem-contato" name="mensagem" rows="6" required style="width: 100%; padding: 8px;"></textarea>
        </p>

        <p>
            <button class="btn-primary" type="submit" name="contato_submit" value="1" style="background-color: #2563eb; color: #ffffff; border: 1px solid #2563eb; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Enviar mensagem</button>
        </p>
    </form>
</div>
