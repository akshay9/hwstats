<?php

class Player extends Eloquent {

	protected $table = "players";

    public function bat_perfo()
    {
        return $this->hasMany('bat_perfo', 'player_id', 'player_id');
    }

    public function bowl_perfo()
    {
        return $this->hasMany('bowl_perfo', 'player_id', 'player_id');
    }

}


?>