<?php
/*
Plugin Name: Gerenciador Saas
Description: Sistema SaaS com painel externo.
Version: 1.0
Author: Rosiane Passos
*/

if (!defined('ABSPATH')) {
    exit;
}

define('GERENCIADOR_SAAS_PATH', plugin_dir_path(__FILE__));
define('GERENCIADOR_SAAS_URL', plugin_dir_url(__FILE__));

function gerenciador_saas_ensure_user_role()
{
    if (!function_exists('add_role') || !function_exists('get_role')) {
        return;
    }

    $role = get_role('usuarios_internos');

    if (null === $role) {
        add_role('usuarios_internos', 'Usuário Interno', [
            'read' => true,
            'edit_posts' => true,
            'upload_files' => true,
            'gerenciar_curriculo_saas' => true,
        ]);
    } else {
        $role->add_cap('gerenciar_curriculo_saas');
        $role->add_cap('read');
        $role->add_cap('edit_posts');
        $role->add_cap('upload_files');
    }

    $admin_role = get_role('administrator');
    if ($admin_role) {
        $admin_role->add_cap('gerenciar_curriculo_saas');
    }
}

function gerenciador_saas_user_can_manage($user = null)
{
    if ($user && is_object($user) && isset($user->allcaps)) {
        if (!empty($user->allcaps['gerenciar_curriculo_saas']) || !empty($user->allcaps['manage_options'])) {
            return true;
        }

        if (is_array($user->roles) && in_array('administrator', $user->roles, true)) {
            return true;
        }

        return false;
    }

    return current_user_can('gerenciar_curriculo_saas') || current_user_can('manage_options') || current_user_can('edit_pages');
}

add_action('init', 'gerenciador_saas_ensure_user_role');

require_once GERENCIADOR_SAAS_PATH . 'core/Loader.php';

$saas_plugin = new Loader();
$saas_plugin->run();

// Garante páginas necessárias e inicializa páginas
gerenciamento_saas_ensure_login_page();
gerenciamento_saas_ensure_idiomas_page();
gerenciamento_saas_ensure_competencias_page();
gerenciamento_saas_ensure_cursos_page();
gerenciamento_saas_ensure_portifolio_page();

function gerenciamento_saas_ensure_idiomas_page()
{
    if (!function_exists('get_page_by_path')) {
        return;
    }

    $slug = 'idiomas';
    if (!get_page_by_path($slug)) {
        wp_insert_post([
            'post_title' => 'Idiomas',
            'post_name' => $slug,
            'post_content' => '[sistema_idiomas]',
            'post_status' => 'publish',
            'post_type' => 'page',
        ]);
    } else {
        $page = get_page_by_path($slug);
        if ($page && strpos($page->post_content, '[sistema_idiomas]') === false) {
            wp_update_post([
                'ID' => $page->ID,
                'post_content' => '[sistema_idiomas]'
            ]);
        }
    }
}

// Flush rewrite rules on activation/deactivation to register the public route
register_activation_hook(__FILE__, 'gerenciador_saas_activate');
function gerenciador_saas_activate()
{
    // Ensure dependencies are loaded so rewrite rules are added
    $loader = new Loader();
    $loader->run();
    gerenciador_saas_ensure_user_role();

    // Create required pages if they don't exist yet
    $required_pages = [
        'sistema-painel' => '[sistema_painel]',
        'login' => '[login_usuario]',
        'competencias' => '[sistema_competencias]',
        //'contato' => '[formulario_contato]',
        'portifolio' => '[sistema_portifolio]',
    ];

    foreach ($required_pages as $slug => $content) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_title' => ucwords(str_replace('-', ' ', $slug)),
                'post_name' => $slug,
                'post_content' => $content,
                'post_status' => 'publish',
                'post_type' => 'page',
            ]);
        }
    }

    gerenciador_saas_create_schema();
    flush_rewrite_rules();
}

function gerenciador_saas_create_schema()
{
    $models = [
        new IdiomaModel(),
        new FormacaoModel(),
        new CompetenciaModel(),
        new CursoModel(),
        new ExperienciaModel(),
        new PortifolioModel(),
    ];

    foreach ($models as $model) {
        if (method_exists($model, 'criar_tabela')) {
            $model->criar_tabela();
        }
    }
}

function gerenciamento_saas_ensure_competencias_page()
{
    if (!function_exists('get_page_by_path')) {
        return;
    }

    $slug = 'competencias';
    if (!get_page_by_path($slug)) {
        wp_insert_post([
            'post_title' => 'Competências',
            'post_name' => $slug,
            'post_content' => '[sistema_competencias]',
            'post_status' => 'publish',
            'post_type' => 'page',
        ]);
    } else {
        $page = get_page_by_path($slug);
        if ($page && strpos($page->post_content, '[sistema_competencias]') === false) {
            wp_update_post([
                'ID' => $page->ID,
                'post_content' => '[sistema_competencias]',
            ]);
        }
    }
}

function gerenciamento_saas_ensure_cursos_page()
{
    if (!function_exists('get_page_by_path')) {
        return;
    }

    $slug = 'cursos';
    if (!get_page_by_path($slug)) {
        wp_insert_post([
            'post_title' => 'Cursos',
            'post_name' => $slug,
            'post_content' => '[sistema_cursos]',
            'post_status' => 'publish',
            'post_type' => 'page',
        ]);
    } else {
        $page = get_page_by_path($slug);
        if ($page && strpos($page->post_content, '[sistema_cursos]') === false) {
            wp_update_post([
                'ID' => $page->ID,
                'post_content' => '[sistema_cursos]',
            ]);
        }
    }
}



function gerenciamento_saas_ensure_portifolio_page()
{
    if (!function_exists('get_page_by_path')) {
        return;
    }

    $slug = 'portifolio';
    $shortcode = '[sistema_portifolio]';
    if (!get_page_by_path($slug)) {
        wp_insert_post([
            'post_title' => 'Portfólio',
            'post_name' => $slug,
            'post_content' => $shortcode,
            'post_status' => 'publish',
            'post_type' => 'page',
        ]);
    } else {
        $page = get_page_by_path($slug);
        if ($page && strpos($page->post_content, $shortcode) === false) {
            wp_update_post([
                'ID' => $page->ID,
                'post_content' => $shortcode
            ]);
        }
    }
}

register_deactivation_hook(__FILE__, 'gerenciador_saas_deactivate');
function gerenciador_saas_deactivate()
{
    flush_rewrite_rules();
}

function gerenciamento_saas_ensure_login_page()
{
    if (!function_exists('get_page_by_path')) {
        return;
    }

    $slug = 'login';
    if (!get_page_by_path($slug)) {
        wp_insert_post([
            'post_title' => 'Login',
            'post_name' => $slug,
            'post_content' => '[login_usuario]',
            'post_status' => 'publish',
            'post_type' => 'page',
        ]);
    }
}

add_action('init', 'gerenciador_saas_init_schema');
function gerenciador_saas_init_schema()
{
    gerenciador_saas_create_schema();
}
//http://localhost:8080/?saas_dashboard=1
