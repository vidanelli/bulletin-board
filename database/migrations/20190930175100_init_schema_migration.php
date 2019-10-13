<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class InitSchemaMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
     *
     * The following commands can be used in this method and Phinx will
     * automatically reverse them when rolling back:
     *
     *    createTable
     *    renameTable
     *    addColumn
     *    addCustomColumn
     *    renameColumn
     *    addIndex
     *    addForeignKey
     *
     * Any other destructive changes will result in an error when trying to
     * rollback the migration.
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change()
    {
        $assets = $this->table('assets');
        $assets->addColumn('name', 'string', [
                'limit' => 255,
                'default' => ''
            ])
            ->addColumn('path', 'string', [
                'limit' => 255,
                'default' => ''
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => '0000-00-00 00:00:00'
            ])
            ->addColumn('updated_at', 'datetime', [
                'default' => '0000-00-00 00:00:00',
                'null' => true
            ])
            ->addColumn('created_by_user_id', 'integer', [
                'limit' => 11,
                'default' => 0
            ])
            ->addColumn('updated_by_user_id', 'integer', [
                'limit' => 11,
                'default' => 0
            ])
            ->addColumn('active', 'boolean', [
                'limit' => 1,
                'default' => 1
            ])
            ->addColumn('deleted', 'boolean', [
                'limit' => 1,
                'default' => 0
            ])
            ->create();

        $posts = $this->table('posts');
        $posts->addColumn('name', 'string', [
                'limit' => 255,
                'default' => ''
            ])
            ->addColumn('description', 'text', [
                'limit' => MysqlAdapter::TEXT_MEDIUM,
                'default' => ''
            ])
            ->addColumn('image_id', 'integer', [
                'limit' => 11,
                'default' => 0,
                'null' => true
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => '0000-00-00 00:00:00'
            ])
            ->addColumn('updated_at', 'datetime', [
                'default' => '0000-00-00 00:00:00',
                'null' => true
            ])
            ->addColumn('created_by_user_id', 'integer', [
                'limit' => 11,
                'default' => 0
            ])
            ->addColumn('active', 'boolean', [
                'limit' => 1,
                'default' => 1
            ])
            ->addColumn('deleted', 'boolean', [
                'limit' => 1,
                'default' => 0
            ])
            ->create();

        $userPageComments = $this->table('user_page_comments');
        $userPageComments->addColumn('user_page_id', 'integer', [
                'limit' => 11,
                'default' => 0
            ])->addColumn('author', 'string', [
                'limit' => 255,
                'default' => ''
            ])
            ->addColumn('message', 'text', [
                'limit' => MysqlAdapter::TEXT_MEDIUM,
                'default' => ''
            ])
            ->addColumn('rating', 'boolean', [
                'limit' => 1,
                'default' => 0
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => '0000-00-00 00:00:00'
            ])
            ->create();

        $userTokens = $this->table('user_tokens');
        $userTokens->addColumn('token', 'string', [
                'limit' => 64,
                'default' => ''
            ])
            ->addColumn('user_id', 'integer', [
                    'limit' => 11,
                    'default' => 0
                ])
            ->addColumn('expires', 'datetime', [
                'default' => '0000-00-00 00:00:00'
            ])
            ->addColumn('user_agent', 'text', [
                'limit' => MysqlAdapter::TEXT_MEDIUM,
                'null' => true
            ])
            ->addColumn('ip', 'string', [
                'limit' => 45,
                'default' => '',
                'null' => true
            ])
            ->create();

        $users = $this->table('users');
        $users->addColumn('email', 'string', [
                'limit' => 255,
                'default' => ''
            ])
            ->addColumn('password', 'string', [
                'limit' => 255,
                'default' => ''
            ])
            ->addColumn('first_name', 'string', [
                'limit' => 255,
                'default' => ''
            ])
            ->addColumn('last_name', 'string', [
                'limit' => 255,
                'default' => '',
                'null' => true
            ])
            ->addColumn('gender', 'string', [
                'limit' => 255,
                'default' => '',
                'null' => true
            ])
            ->addColumn('birthday', 'date', [
                'default' => '0000-00-00',
                'null' => true
            ])
            ->addColumn('location', 'string', [
                'limit' => 255,
                'default' => '',
                'null' => true
            ])
            ->addColumn('about_me', 'text', [
                'limit' => MysqlAdapter::TEXT_MEDIUM,
                'default' => '',
                'null' => true
            ])
            ->addColumn('avatar', 'integer', [
                'limit' => 11,
                'default' => 0
            ])
            ->addColumn('created_at', 'datetime', [
                'default' => '0000-00-00 00:00:00'
            ])
            ->addColumn('updated_at', 'datetime', [
                'default' => '0000-00-00 00:00:00'
            ])
            ->addColumn('ip', 'string', [
                'limit' => 45,
                'default' => '',
                'null' => true
            ])
            ->addColumn('active', 'boolean', [
                'limit' => 1,
                'default' => 1
            ])
            ->create();
    }
}
