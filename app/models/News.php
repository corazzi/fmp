<?php

class News extends Base {

	protected $table = 'news';

	public $timestamps = false;



    public static $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    public static function read_all_feeds($feed_urls)
    {
        //read the urls
        $all_feeds = FeedReader::read($feed_urls);

        //get top three from each feed
        $all_feeds->set_item_limit(3);

        //strip nasty html tags 
        $all_feeds->strip_htmltags(array('img','embed','center','strong','iframe', 'h1', 'h2', 'h3', 'h4', 'h5', 'h6'));
        
        //initialise the above
        $all_feeds->init();

        //handle the content type
        $all_feeds->handle_content_type();
        
        //return the feeds
        return $all_feeds;
    }

}