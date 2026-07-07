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

require_once GERENCIADOR_SAAS_PATH . 'core/Loader.php';
//require_once GERENCIADOR_SAAS_PATH . 'models/IdiomaModel.php';

$saas_plugin = new Loader();
$saas_plugin->run();

// Garante páginas necessárias e inicializa páginas
gerenciamento_saas_ensure_login_page();
gerenciamento_saas_ensure_idiomas_page();
gerenciamento_saas_ensure_competencias_page();
gerenciamento_saas_ensure_cursos_page();
gerenciamento_saas_ensure_contato_page();

function gerenciamento_saas_ensure_idiomas_page()
{
    if (!function_exists('get_page_by_path')) {
        return;
    }

    $slug = 'idiomas';
    if (!get_page_by_path($slug)) {
        wp_insert_post([
            'post_title'   => 'Idiomas',
            'post_name'    => $slug,
            'post_content' => '[sistema_idiomas]',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
    else {
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
function gerenciador_saas_activate() {
    // Ensure dependencies are loaded so rewrite rules are added
    $loader = new Loader();
    $loader->run();
    // Create required pages if they don't exist yet
    $required_pages = [
        'sistema-painel' => '[sistema_painel]',
        'login' => '[login_usuario]',
        'competencias' => '[sistema_competencias]',
        'contato' => '[formulario_contato]',
    ];

    foreach ($required_pages as $slug => $content) {
        if (!get_page_by_path($slug)) {
            wp_insert_post([
                'post_title'   => ucwords(str_replace('-', ' ', $slug)),
                'post_name'    => $slug,
                'post_content' => $content,
                'post_status'  => 'publish',
                'post_type'    => 'page',
            ]);
        }
    }

    gerenciador_saas_create_schema();
    flush_rewrite_rules();
}

function gerenciador_saas_create_schema() {
    $models = [
        new IdiomaModel(),
        new FormacaoModel(),
        new CompetenciaModel(),
        new CursoModel(),
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
            'post_title'   => 'Competências',
            'post_name'    => $slug,
            'post_content' => '[sistema_competencias]',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    } else {
        $page = get_page_by_path($slug);
        if ($page && strpos($page->post_content, '[sistema_competencias]') === false) {
            wp_update_post([
                'ID'           => $page->ID,
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
            'post_title'   => 'Cursos',
            'post_name'    => $slug,
            'post_content' => '[sistema_cursos]',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    } else {
        $page = get_page_by_path($slug);
        if ($page && strpos($page->post_content, '[sistema_cursos]') === false) {
            wp_update_post([
                'ID'           => $page->ID,
                'post_content' => '[sistema_cursos]',
            ]);
        }
    }
}

function gerenciamento_saas_ensure_contato_page()
{
    if (!function_exists('get_page_by_path')) {
        return;
    }

    $slug = 'contato';
    if (!get_page_by_path($slug)) {
        wp_insert_post([
            'post_title'   => 'Contato',
            'post_name'    => $slug,
            'post_content' => '[formulario_contato]',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    } else {
        $page = get_page_by_path($slug);
        if ($page && strpos($page->post_content, '[formulario_contato]') === false) {
            wp_update_post([
                'ID'           => $page->ID,
                'post_content' => '[formulario_contato]',
            ]);
        }
    }
}

register_deactivation_hook(__FILE__, 'gerenciador_saas_deactivate');
function gerenciador_saas_deactivate() {
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
            'post_title'   => 'Login',
            'post_name'    => $slug,
            'post_content' => '[login_usuario]',
            'post_status'  => 'publish',
            'post_type'    => 'page',
        ]);
    }
}

add_action('init', 'gerenciador_saas_init_schema');
function gerenciador_saas_init_schema()
{
    gerenciador_saas_create_schema();
}
//http://localhost:8080/?saas_dashboard=1
//[sistema_idiomas_progress]
//Proximo delete e update