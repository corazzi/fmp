<?php

class News extends Base {

	protected $table = 'news';

	public $timestamps = false;

    // Sluggable by @cviebrock
    // simple and easy way for unique slugs
    public static $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    public static function read_all_feeds($feed_urls)
    {

        $all_feeds = FeedReader::read($feed_urls);
        $all_feeds->set_item_limit(3);
        $all_feeds->strip_htmltags(array('img','embed','center','strong','iframe', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'));
        $all_feeds->init();
        $all_feeds->handle_content_type();

        return $all_feeds;

    }

}