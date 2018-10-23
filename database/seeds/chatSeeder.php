<?php

use Illuminate\Database\Seeder;

class chatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('chats')->insert([
            ['name'=> '1 Hello, this is a test chat', 'chat_image'=> '', 'message_from'=> 3, 'message_to'=> 2, 'created_at'=> \Carbon::now()->addDay(-3) ],
            ['name'=> '2 Hello, this is a test chat', 'chat_image'=> '', 'message_from'=> 3, 'message_to'=> 2, 'created_at'=> \Carbon::now()->addDay(-2) ],
            ['name'=> '3 Hello, this is a test chat', 'chat_image'=> '', 'message_from'=> 2, 'message_to'=> 3, 'created_at'=> \Carbon::now()->addDay(-1) ],
            ['name'=> '4 Hello, this is a test chat', 'chat_image'=> '', 'message_from'=> 3, 'message_to'=> 2, 'created_at'=> \Carbon::now()->addDay(-1) ],
            ['name'=> '5 Hello, this is a test chat', 'chat_image'=> '', 'message_from'=> 2, 'message_to'=> 3, 'created_at'=> \Carbon::now()->addDay(-1) ],
            ['name'=> '6 Hello, this is a test chat', 'chat_image'=> '', 'message_from'=> 2, 'message_to'=> 3, 'created_at'=> \Carbon::now()->addDay(-1) ],
            ['name'=> '7 Hello, this is a test chat', 'chat_image'=> '', 'message_from'=> 3, 'message_to'=> 2, 'created_at'=> \Carbon::now()->addDay(-2) ],
            ['name'=> '8 Hello, this is a test chat', 'chat_image'=> '', 'message_from'=> 3, 'message_to'=> 2, 'created_at'=> \Carbon::now()->addDay(-3) ],
            ['name'=> '9 Hello, this is a test chat', 'chat_image'=> '', 'message_from'=> 3, 'message_to'=> 2, 'created_at'=> \Carbon::now()->addDay(-4) ],
        ]);
        
    }
}
