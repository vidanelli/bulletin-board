<?php


use Phinx\Seed\AbstractSeed;

class AssetsSeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {
        $data = [
            [
                'name' => 'light-s.jpg',
                'path' => 'posts/1/',
                'created_at' => '2019-09-29 18:10:56',
                'updated_at' => '2019-09-29 18:10:56',
                'created_by_user_id' => 1,
                'updated_by_user_id' => 1,
            ],
            [
                'name' => 'angry-man.jpg',
                'path' => 'users/1/',
                'created_at' => '2019-10-02 19:47:32',
                'updated_at' => '2019-10-02 19:54:11',
                'created_by_user_id' => 1,
                'updated_by_user_id' => 1,
            ]
        ];

        $assets = $this->table('assets');
        $assets->insert($data)->save();
    }
}
