<?php


class Loader
{
    public function __construct()
    {
        // The constructor remains lightweight.
    }

    public function run()
    {
        $this->load_dependencies();
        $this->init_hooks();

        if (function_exists('error_log')) {
            error_log('[Gerenciador Saas] Loader::run executed.');
        }
    }

    private function load_dependencies()
    {
        $files = [
            GERENCIADOR_SAAS_PATH . 'models/IdiomaModel.php',
            GERENCIADOR_SAAS_PATH . 'controllers/DashboardController.php',
            GERENCIADOR_SAAS_PATH . 'controllers/Login.php',
            GERENCIADOR_SAAS_PATH . 'controllers/IdiomasController.php',
            GERENCIADOR_SAAS_PATH . 'controllers/CompetenciasController.php',
            GERENCIADOR_SAAS_PATH . 'models/ExperienciaModel.php',
            GERENCIADOR_SAAS_PATH . 'controllers/ExperienciasController.php',
            GERENCIADOR_SAAS_PATH . 'controllers/FormacaoController.php',
            GERENCIADOR_SAAS_PATH . 'models/FormacaoModel.php',

        ];

        foreach ($files as $file) {
            if (file_exists($file)) {
                require_once $file;
                continue;
            }

            if (function_exists('error_log')) {
                error_log('[Gerenciador Saas] Missing file: ' . $file);
            }
        }
    }

    private function init_hooks()
    {
        if (class_exists('DashboardController')) {
            new DashboardController();
        } else {
            if (function_exists('error_log')) {
                error_log('[Gerenciador Saas] DashboardController class not found.');
            }
        }

        if (class_exists('IdiomasController')) {
            new IdiomasController();
        } else {
            if (function_exists('error_log')) {
                error_log('[Gerenciador Saas] IdiomasController class not found.');
            }
        }

        if (class_exists('ExperienciasController')) {
            new ExperienciasController();
        } else {
            if (function_exists('error_log')) {
                error_log('[Gerenciador Saas] ExperienciasController class not found.');
            }
        }

        if (class_exists('FormacaoController')) {
            new FormacaoController();
        } else {
            if (function_exists('error_log')) {
                error_log('[Gerenciador Saas] FormacaoController class not found.');
            }
        }
    }
}
