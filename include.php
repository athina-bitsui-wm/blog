<?php
$database->query('SELET blog_post * FROM blog_post_tags LEFT JOIN (blog_post) ON (blog_post_tags.blog_post_id = blog_post.id) WHERE blog_post_tag.tag_id=');