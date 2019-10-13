<?php


use Phinx\Seed\AbstractSeed;

class UserPageCommentsSeeder extends AbstractSeed
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
                'user_page_id' => 1,
                'author' => 'Daniil',
                'message' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                'rating' => 4,
                'created_at' => '2019-09-29 12:39:42',
            ],
            [
                'user_page_id' => 1,
                'author' => 'Anton',
                'message' => 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.',
                'rating' => 5,
                'created_at' => '2019-09-30 14:07:53',
            ]
        ];

        $userPageComments = $this->table('user_page_comments');
        $userPageComments->insert($data)->save();
    }
}
