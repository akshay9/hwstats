<?php

class ScriptController extends BaseController
{

    public function getIndex()
    {
        return Redirect::action('ScriptController@getHwplus');
    }

    public function getHwplus()
    {
        return View::make('hwplus', array('title' => 'Hitwicket+ Script' ));
    }

    public function getScript()
    {
        switch(Input::get('name')){
            case 'hwplus':
                Cache::put('script_hwplus_v1_1', (Cache::get('script_hwplus_v1_1', 0)+1), 64800);
                return Redirect::to("http://goo.gl/F1QZyK");
                break;

        }

    }
}