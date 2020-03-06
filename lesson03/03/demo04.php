<?php

namespace lessons03\example03\demo04;

trait FilterTrait
{
    public function upload($file)
    {
        return $file;
    }
}

class Post
{
    use FilterTrait;
}

$post = new Post();
echo  $post->upload(123) . PHP_EOL;