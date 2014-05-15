<?php

class Guide extends Base {

	protected $table = 'guides';

    // Sluggable by @cviebrock
    // simple and easy way for unique slugs
    public static $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );


   function RepoMarkdown($content)
   {
    
        $custom_blocks = array('[code]', '[/code]', '[b]','[/b]','[i]','[/i]'); //custom mark down
        $converted_html = array('<pre><code>', '</code></pre>', '<b>', '</b>', '<em>', '</em>'); //html 
        $guide_content = str_replace($custom_blocks, $converted_html, $content); // replace markup up with valid html

        return $guide_content; // return the converted string
   } 

   public static function blankRepoMarkdown($content)
   {
   	    $custom_blocks = array('[code]', '[/code]', '[b]','[/b]','[i]','[/i]'); //custom mark down
        $converted_html = ''; // blanks
        $combined_content = str_replace($custom_blocks, $converted_html, $content);// convert to blanks
        $guide_content = substr($combined_content, 0, 700);

        return $guide_content; //return 
   }




}