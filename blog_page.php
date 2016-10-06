<?php
require 'classes/database.php';
require 'classes/tags.php';
$database = new Database;
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

class blogPost
{
    private $id;
    public $title;
    public $post;
    public $author;
    public $date_post;

    function __construct($inId = null, $inTitle = null, $inPost = null, $inAuthorId = null, $inDatePost = null)
    {
        $this->id->$inId;
        $this->title->$inTitle;
        $this->post->$inPost;
        $this->author->$inAuthorId;
        $this->date_post->$inDatePost;
    }
}
if(@$post['update']){
    $id = $post['id'];
    $title = $post['title'];
    $posts = $post['posts'];
    $date_post = $post['date_post'];

    $database->query('UPDATE blog_posts SET title = :title, posts = :posts WHERE');
    $database->bind(':title', $title);
    $database->bind(':posts', $posts);
    $database->bind(':id', $id);
    $database->execute();
}
$database->query('SELECT * FROM blog_posts');
$rows = $database->resultset();

$Tags = new Tags();
$Tags->query('SELECT * FROM blog_posts');
$rows = $Tags->resultset();
?>
    <h1>Travel-Blog</h1>

    <h1>Posts</h1>
    <div>
        <?php foreach($rows as $row) : ?>
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['posts']; ?></p>
            <p>Tag : <?php echo $row['tags']; ?></p>
        <?php endforeach; ?>
    </div>