<?php
namespace Framework\Model;

class TestPosts{
	public $id;
	public $title;
	public $date;
	public $name;
	public $content;
}

class ActiveRecord{
	public static function find($what){
		$posts[1] = new TestPosts;
		$posts[2] = new TestPosts;
		
		$posts[1]->id = '1';
		$posts[1]->title = 'Post_title';
		$posts[1]->date = '25-02-2016';
		$posts[1]->name = 'PostName';
		$posts[1]->content = 'PostContent';
		
		$posts[2]->id = '2';
		$posts[2]->title = 'Post_title2';
		$posts[2]->date = '26-02-2016';
		$posts[2]->name = 'PostName2';
		$posts[2]->content = 'PostContent2';
		
		return $posts;
	}
}
