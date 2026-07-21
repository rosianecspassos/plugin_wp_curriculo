<?php

if (!defined('ABSPATH')) {
    exit;
}

class IdiomaModel
{
    private $table;
    private $wpdb;

    public function __construct()
    {
        global $wpdb;

        $this->wpdb = $wpdb;
        $this->table = $wpdb->prefix . 'curriculo_idiomas';
    }

    public function criar_tabela()
    {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $charset_collate = $this->wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->table} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario_id BIGINT UNSIGNED NOT NULL,
            nome VARCHAR(100) NOT NULL,
            nivel TINYINT UNSIGNED NOT NULL DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

            PRIMARY KEY (id),
            KEY usuario_id (usuario_id)

        ) $charset_collate;";

        dbDelta($sql);
    }

    public function cadastrar($usuario_id, $nome, $nivel)
    {
        return $this->wpdb->insert(
            $this->table,
            [
                'usuario_id' => $usuario_id,
                'nome' => $nome,
                'nivel' => $nivel
            ],
            [
                '%d',
                '%s',
                '%d'
            ]
        );
    }

    public function atualizar($id, $nome, $nivel)
    {
        return $this->wpdb->update(
            $this->table,
            [
                'nome' => $nome,
                'nivel' => $nivel
            ],
            [
                'id' => $id
            ],
            [
                '%s',
                '%d'
            ],
            [
                '%d'
            ]
        );
    }

    public function excluir($id)
    {
        return $this->wpdb->delete(
            $this->table,
            [
                'id' => $id
            ],
            [
                '%d'
            ]
        );
    }

    public function buscar_por_usuario($usuario_id)
    {
        return $this->wpdb->get_results(
            $this->wpdb->prepare(
                "SELECT *
                 FROM {$this->table}
                 WHERE usuario_id = %d
                 ORDER BY nivel DESC",
                $usuario_id
            ),
            ARRAY_A
        );
    }

    public function buscar_por_id($id)
    {
        return $this->wpdb->get_row(
            $this->wpdb->prepare(
                "SELECT *
                 FROM {$this->table}
                 WHERE id = %d",
                $id
            ),
            ARRAY_A
        );
    }

    public function buscar_todos()
    {
        return $this->wpdb->get_results(
            "SELECT * FROM {$this->table} ORDER BY nivel DESC",
            ARRAY_A
        );
    }
}
?>