<?php

use Illuminate\Database\Seeder;

class blogCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        DB::table('comments')->insert([
            ['blog_id'=> '1', 'name'=> 'I am a comment', 'is_published'=> 1, 'user_id'=> 1   , 'is_reply'=> 0, 'comment_id'=> null, 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 2],
            ['blog_id'=> '1', 'name'=> 'I am a comment', 'is_published'=> 1, 'user_id'=> null, 'is_reply'=> 1, 'comment_id'=> 1   , 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 5],
            ['blog_id'=> '1', 'name'=> 'I am a comment', 'is_published'=> 0, 'user_id'=> 1   , 'is_reply'=> 1, 'comment_id'=> 1   , 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 2],
            ['blog_id'=> '3', 'name'=> 'I am a comment', 'is_published'=> 0, 'user_id'=> 1   , 'is_reply'=> 0, 'comment_id'=> null, 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 5],
            ['blog_id'=> '3', 'name'=> 'I am a comment', 'is_published'=> 1, 'user_id'=> 1   , 'is_reply'=> 1, 'comment_id'=> 3   , 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 1],
            ['blog_id'=> '3', 'name'=> 'I am a comment', 'is_published'=> 1, 'user_id'=> 1   , 'is_reply'=> 1, 'comment_id'=> 3   , 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 5],
            ['blog_id'=> '3', 'name'=> 'I am a comment', 'is_published'=> 1, 'user_id'=> null, 'is_reply'=> 0, 'comment_id'=> null, 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 2],
            ['blog_id'=> '2', 'name'=> 'I am a comment', 'is_published'=> 1, 'user_id'=> null, 'is_reply'=> 0, 'comment_id'=> null, 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 4],
            ['blog_id'=> '2', 'name'=> 'I am a comment', 'is_published'=> 1, 'user_id'=> null, 'is_reply'=> 0, 'comment_id'=> null, 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 2],
            ['blog_id'=> '2', 'name'=> 'I am a comment', 'is_published'=> 1, 'user_id'=> null, 'is_reply'=> 0, 'comment_id'=> null, 'commenter_name'=> 'the someone', 'commenter_email'=> 'someone@somemail.com', 'rate'=> 5],
        ]);
        
    }
}
