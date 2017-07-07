<?php

use Illuminate\Database\Seeder;

class ProposalsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        factory(\App\Core\Messenger\Models\Proposal::class, 20)->create()
            ->each(function (\App\Core\Messenger\Models\Proposal $p) use ($faker) {
                $author_id = $p->author_id;

                $message = $p->messages()->create([
                    'user_id' => 2,
                    'body' => implode(' ', $faker->sentences(2)),
                ]);

                $receiver = \App\Core\Messenger\Models\Participant::create(
                    [
                        'proposal_id' => $p->id,
                        'user_id' => 2,
                        'last_read' => new \Carbon\Carbon()
                    ]
                );

                $sender = \App\Core\Messenger\Models\Participant::create(
                    [
                        'proposal_id' => $p->id,
                        'user_id' => $author_id,
                        'last_read' => new \Carbon\Carbon()
                    ]
                );
            });
    }
}
