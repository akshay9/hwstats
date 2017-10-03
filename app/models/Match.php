<?php

class Match extends Eloquent {

	protected $table = "matches";
	
	public function teamname($id)
    {
        return $this->hasOne('teams', 'name', 'team'.$id.'_id');
    }

}


?>