<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * An Eloquent Model: 'View'
 * This model is used to track when other
 * models are being viewed on the site
 *
 * @property integer $id
 * @property string $viewable_type
 * @property integer $viewable_id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Carbon $deleted_at
 */

class View extends Model
{
    protected $fillable = [
        'viewable_type',
        'viewable_id'
    ];

    public function viewable()
    {
        return $this->morphTo();
    }
}
