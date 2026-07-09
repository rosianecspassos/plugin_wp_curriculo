<?php

if (!defined('ABSPATH')) {
    exit;
}

class FormacaoModel
{
    private $table;
    private $wpdb;

    public function __construct()
    {
        global $wpdb;

        $this->wpdb = $wpdb;
        $this->table = $wpdb->prefix . 'curriculo_formacoes';
    }

    public function criar_tabela()
    {
        require_once ABSPATH . 'wp-admin/includes/upgrade.php';

        $charset_collate = $this->wpdb->get_charset_collate();

        $sql = "CREATE TABLE {$this->table} (
            id BIGINT UNSIGNED NOT NULL AUTO_INCREMENT,
            usuario_id BIGINT UNSIGNED NOT NULL,
            curso VARCHAR(255) NOT NULL,
            instituicao VARCHAR(255) NOT NULL,
            grau VARCHAR(100) NOT NULL,
            titulo VARCHAR(100) NOT NULL,
            status VARCHAR(20) NOT NULL DEFAULT 'concluido',
            ano_conclusao SMALLINT UNSIGNED NOT NULL DEFAULT 0,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,

            PRIMARY KEY (id),
            KEY usuario_id (usuario_id)

        ) $charset_collate;";

        dbDelta($sql);
        $this->garantir_coluna_status();
    }

    public function garantir_coluna_status()
    {
        $coluna = $this->wpdb->get_results($this->wpdb->prepare("SHOW COLUMNS FROM {$this->table} LIKE %s", 'status'));

        if (!empty($coluna)) {
            return;
        }

        $this->wpdb->query("ALTER TABLE {$this->table} ADD COLUMN status VARCHAR(20) NOT NULL DEFAULT 'concluido'");
    }

    public function cadastrar($usuario_id, $curso, $instituicao, $grau, $titulo, $status, $ano_conclusao)
    {
        return $this->wpdb->insert(
            $this->table,
            [
                'usuario_id'    => $usuario_id,
                'curso'         => $curso,
                'instituicao'   => $instituicao,
                'grau'          => $grau,
                'titulo'        => $titulo,
                'status'        => $status,
                'ano_conclusao' => $ano_conclusao,
            ],
            ['%d', '%s', '%s', '%s', '%s', '%s', '%d']
        );
    }

    public function atualizar($id, $curso, $instituicao, $grau, $titulo, $status, $ano_conclusao)
    {
        return $this->wpdb->update(
            $this->table,
            [
                'curso'         => $curso,
                'instituicao'   => $instituicao,
                'grau'          => $grau,
                'titulo'        => $titulo,
                'status'        => $status,
                'ano_conclusao' => $ano_conclusao,
            ],
            ['id' => $id],
            ['%s', '%s', '%s', '%s', '%s', '%d'],
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
                "SELECT * FROM {$this->table} WHERE usuario_id = %d ORDER BY ano_conclusao DESC, created_at DESC",
                $usuario_id
            ),
            ARRAY_A
        );
    }

    public function buscar_todos()
    {
        return $this->wpdb->get_results(
            "SELECT * FROM {$this->table} ORDER BY ano_conclusao DESC, created_at DESC",
            ARRAY_A
        );
    }
}
