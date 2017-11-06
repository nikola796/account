<?php namespace App\Events;

use App\Events\Event;

use Illuminate\Queue\SerializesModels;

use App\User;

class UserWasBanned extends Event {

	use SerializesModels;

	public $user;

    /**
     * Create a new event instance.
     *
     * @param User $user
     */
	public function __construct(User $user)
	{
		$this->user = $user;
	}

}