<?php 

use Carbon\Carbon;

class Snippet extends Eloquent {

	protected $table = 'snippets';
 
    // Sluggable by @@cviebrock
    // simple and easy way for unique slugs
    public static $sluggable = array(
        'build_from' => 'title',
        'save_to'    => 'slug',
    );

    protected function getHumanTimestampAttribute($column)
    {
        if ($this->attributes[$column])
        {
            return Carbon::parse($this->attributes[$column])->diffForHumans();
        }

        return null;
    }

    public function getHumanCreatedAtAttribute()
    {
        return $this->getHumanTimestampAttribute("created_at");
    }

    public function getHumanUpdatedAtAttribute()
    {
        return $this->getHumanTimestampAttribute("updated_at");
    } 
	
}