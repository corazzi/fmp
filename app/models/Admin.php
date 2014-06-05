<?php 

class Admin extends Base {
 
     public static function getSnippetsAllYay($snippet_id)
     {
     	$yay_votes = DB::table('snippets_rating')->where('snippet_id', $snippet_id)->lists('good');

     	$total = array_sum($yay_votes);

     	return $total;

     }

     public static function getSnippetsAllNay($snippet_id)
     {
     	$nay_votes = DB::table('snippets_rating')->where('snippet_id', $snippet_id)->lists('bad');

     	$total = array_sum($nay_votes);

     	return $total;

     }

     public static function getSnippetsFavorites($snippet_id)
     {
     	$favorites = DB::table('snippets_favorite')->where('snippet_id', $snippet_id)->count();

     	return $favorites;
     }


     public static function getGuidesAllYay($guide_id)
     {
     	$yay_votes = DB::table('guides_rating')->where('guide_id', $guide_id)->lists('good');

     	$total = array_sum($yay_votes);

     	return $total;

     }

     public static function getGuidesAllNay($guide_id)
     {
     	$nay_votes = DB::table('guides_rating')->where('guide_id', $guide_id)->lists('bad');

     	$total = array_sum($nay_votes);

     	return $total;

     }

     public static function getGuidesFavorites($guide_id)
     {
     	$favorites = DB::table('guides_favorite')->where('guide_id', $guide_id)->count();

     	return $favorites;
     }


}