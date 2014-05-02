<?php 

class Snippet extends Base {

	protected $table = 'snippets';
 
    // Sluggable by @cviebrock
    // simple and easy way for unique slugs
    public static $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

}