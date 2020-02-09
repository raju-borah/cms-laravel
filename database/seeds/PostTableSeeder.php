<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $category1=Category::create([
            'name'=>'news'
        ]);
        $category2=Category::create([
            'name'=>'Programming'
        ]);
        $author1=User::create([
            'name'=>'dexter',
            'email'=>'dex658@gmail.com',
            'password'=> Hash::make('password'),
        ]);
        $author2=User::create([
            'name'=>'dex',
            'email'=>'dex@gmail.com',
            'password'=> Hash::make('password'),
        ]);

        $post1=Post::create([
            'title'=>'Bootstrap',
            'description'=>'Lorem Ipsum is simply dum',
            'contents'=>'Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the li',
            'category_id'=>1,
            'image'=>'posts/1.jpg',
            'user_id'=>$author1->id

        ]);
        $post2=$author2->posts()->create([
            'title'=>'JavaScript',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,',
            'contents'=>'Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the li',
            'category_id'=>2,
            'image'=>'posts/2.jpg'
        ]);
        $post3=$author2->posts()->create([
            'title'=>'Wordpress',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,',
            'contents'=>'Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the li',
            'category_id'=>2,
            'image'=>'posts/3.jpg'
        ]);
        $post4=$author1->posts()->create([
            'title'=>'Java',
            'description'=>'Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s,',
            'contents'=>'Why do we use it?It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the li',
            'category_id'=>2,
            'image'=>'posts/4.jpg'

        ]);

        $tag1=Tag::create([
            'name'=>'javaScript'
        ]);
        $tag2=Tag::create([
            'name'=>'programming'
        ]);
        $tag3=Tag::create([
            'name'=>'job'
        ]);

        $post1->tags()->attach([$tag1->id,$tag2->id]);
        $post2->tags()->attach([$tag1->id,$tag3->id]);
        $post3->tags()->attach([$tag3->id,$tag2->id]);
        $post4->tags()->attach([$tag1->id,$tag2->id]);
    }
}
