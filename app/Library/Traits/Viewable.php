<?php


namespace App\Library\Traits;


trait Viewable
{
    public function trackView($class)
    {
        \App\View::create([
            'viewable_type' => get_class($class),
            'viewable_id' => $class->id
        ]);
    }
}