<?php

if (!defined('ABSPATH')) {
    exit;
}

class CursoModel
{
    private $table;
    private $wpdb;

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->table = $wpdb->prefix . 'curriculo_cursos';
    }

    public function criar_tabela()
    {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $charset_collate = $this->wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->table} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario_id BIGINT UNSIGNED NOT NULL,
            icon VARCHAR(255) NOT NULL,
            curso VARCHAR(255) NOT NULL,
            instituicao VARCHAR(255) NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id),
            KEY usuario_id (usuario_id)
        ) $charset_collate;";

        dbDelta($sql);
    }

    public function cadastrar($usuario_id, $icon, $curso, $instituicao)
    {
        return $this->wpdb->insert(
            $this->table,
            [
                'usuario_id'   => $usuario_id,
                'icon'         => $icon,
                'curso'        => $curso,
                'instituicao'  => $instituicao,
            ],
            ['%d', '%s', '%s', '%s']
        );
    }

    public function atualizar($id, $icon, $curso, $instituicao)
    {
        return $this->wpdb->update(
            $this->table,
            [
                'icon'         => $icon,
                'curso'        => $curso,
                'instituicao'  => $instituicao,
            ],
            ['id' => $id],
            ['%s', '%s', '%s'],
            ['%d']
        );
    }

    public function excluir($id)
    {
        return $this->wpdb->delete(
            $this->table,
            ['id' => $id],
            ['%d']
        );
    }

    public function buscar_por_usuario($usuario_id)
    {
        return $this->wpdb->get_results(
            $this->wpdb->prepare(
                "SELECT * FROM {$this->table} WHERE usuario_id = %d ORDER BY created_at DESC",
                $usuario_id
            ),
            ARRAY_A
        );
    }

    public function buscar_todos()
    {
        return $this->wpdb->get_results(
            "SELECT * FROM {$this->table} ORDER BY created_at DESC",
            ARRAY_A
        );
    }
}
