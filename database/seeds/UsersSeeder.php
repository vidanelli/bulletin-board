<?php


use Phinx\Seed\AbstractSeed;

class UsersSeeder extends AbstractSeed
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
                'email' => 'danelli@danelli.com',
                'password' => '$2y$08$bUxtZXJ6ZjBQMHR2NlVmTOKL3KUbJ6.yRQfC0ULzNhgkiEevr4CrK',
                'first_name' => 'Daniil',
                'last_name' => 'Savin',
                'gender' => 'Male',
                'birthday' => '1991-04-18',
                'location' => 'SPB',
                'about_me' => 'Programmer',
                'avatar' => '2',
                'created_at' => '2019-10-02 11:45:22',
                'updated_at' => '2019-10-02 19:54:11',
            ]
        ];

        $users = $this->table('users');
        $users->insert($data)->save();
    }
}
