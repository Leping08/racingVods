<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Collection;

class NewRacesReport extends Mailable
{
    use Queueable, SerializesModels;
    /**
     * @var Collection
     */
    private $races;


    /**
     * NewRacesReport constructor.
     * @param Collection $races
     */
    public function __construct(Collection $races)
    {
        $this->races = $races;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('emails.newRacesReport')
                    ->with([
                        'races' => $this->races
                    ]);
    }
}
