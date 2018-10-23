<?php

use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('messages')->insert([
            ['name'=> 'Bring me a Hair dryer', 'message_from'=> 1, 'message_to'=> 3, 'is_reply'=> 0, 'message_id'=> null, 'details'=> 'This is a details area'],
            ['name'=> 'Bring me a Hair dryer', 'message_from'=> 3, 'message_to'=> 1, 'is_reply'=> 1, 'message_id'=> 1, 'details'=> 'This is a Reply area'],
            ['name'=> 'Bring me a Hair dryer', 'message_from'=> 1, 'message_to'=> 3, 'is_reply'=> 1, 'message_id'=> 1, 'details'=> 'This is a Reply of a reply area'],
            ['name'=> 'Bring me a Hair dryer', 'message_from'=> 2, 'message_to'=> 3, 'is_reply'=> 0, 'message_id'=> null, 'details'=> 'This is a details area'],
            ['name'=> 'Bring me a Hair dryer', 'message_from'=> 3, 'message_to'=> 2, 'is_reply'=> 1, 'message_id'=> 4, 'details'=> 'This is a Reply area'],
            ['name'=> 'Bring me a Hair dryer', 'message_from'=> 2, 'message_to'=> 3, 'is_reply'=> 1, 'message_id'=> 4, 'details'=> 'This is a Reply of a reply area'],
            ['name'=> 'Bring me a Hair dryer', 'message_from'=> 1, 'message_to'=> 3, 'is_reply'=> 0, 'message_id'=> null, 'details'=> 'This is a details area'],
            ['name'=> 'Bring me a Hair dryer', 'message_from'=> 3, 'message_to'=> 1, 'is_reply'=> 1, 'message_id'=> 7, 'details'=> 'This is a Reply area'],
            ['name'=> 'Bring me a Hair dryer', 'message_from'=> 1, 'message_to'=> 3, 'is_reply'=> 1, 'message_id'=> 7, 'details'=> 'This is a Reply of a reply area'],
        ]);
        
    }
}
