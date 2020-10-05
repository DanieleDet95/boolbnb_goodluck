<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Suite;

class SendNewEliminated extends Mailable
{
    use Queueable, SerializesModels;

    protected $eliminated = null;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Suite $suite)
    {
      $this->eliminated = $suite;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      $eliminated = $this->eliminated;

      return $this->view('admin.email.messages.elimina', compact('eliminated'));
    }
}
