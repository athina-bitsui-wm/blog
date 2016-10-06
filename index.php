<?php
require 'classes/database.php';
require 'classes/tags.php';
$database = new Database;
$post = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

if(@$_POST['delete']){
    $delete_id = $post['delete_id'];
    $database->query('DELETE FROM blog_posts WHERE id = :id');
    $database->bind(':id', $delete_id);
    $database->execute();
}
if(@$post['update']){
    $id = $post['id'];
    $title = $post['title'];
    $posts = $post['posts'];

    $database->query('UPDATE blog_posts SET title = :title, posts = :posts WHERE');
    $database->bind(':title', $title);
    $database->bind(':posts', $posts);
    $database->bind(':id', $id);
    $database->execute();
}
if(@$post['submit']){
    $title = $post['title'];
    $posts = $post['posts'];

    $database->query('INSERT INTO blog_posts (title, posts) VALUES(:title, :posts)');
    $database->bind(':title', $title);
    $database->bind(':posts', $posts);
    $database->execute();
    if($database->lastInsertId()){
        echo '<p>Post Added!</p>';
    }
}

$database->query('SELECT * FROM blog_posts');
$rows = $database->resultset();

$Tags = new Tags();
$Tags->query('SELECT * FROM blog_posts');
$rows = $Tags->resultset();
?>

<a href="blog_page.php">blog page</a>
 <h2>Add Post</h2>

    <form method="post" action="<?php $_SERVER['PHP_SELF']; ?>">
        <label>Post Id</label><br />
        <input type="text" name="id" placeholder="Specify Id" /><br /><br />

        <label>Post Title</label><br />
        <input type="text" name="title" placeholder="Add a Title..." /><br /><br />

        <label>Post Body</label><br />
        <textarea name="posts"></textarea><br /><br />
        <input type="submit" name="submit" value="Submit" />
    </form>

    <div>
        <?php foreach($rows as $row) : ?>
            <h3><?php echo $row['title']; ?></h3>
            <p><?php echo $row['posts']; ?></p>
            <p>Tag : <?php echo $row['tags']; ?></p>
            <br/>
            <form method="post" action="<?php $_SERVER['PHP_SELF']?>">
                <!-- the button can delete from the post now -->
                <input type="hidden" name="delete_id" value="<?php echo $row['id']; ?>">
                <input type="submit" name="delete" value="Delete" />
            </form>
        <?php endforeach; ?>
    </div>