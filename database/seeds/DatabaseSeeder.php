<?php

use App\TriggerAddress;
use App\User;
use Illuminate\Contracts\Auth\Registrar;
use Illuminate\Database\Seeder;
use Illuminate\Database\Eloquent\Model;

class DatabaseSeeder extends Seeder {

    /**
     * @var Registrar
     */
    private $registrar;

    public function __construct(Registrar $registrar)
    {
        $this->registrar = $registrar;
    }

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		Model::unguard();

        User::truncate();
        TriggerAddress::truncate();

        $user = $this->registrar->create([
            'name' => 'Jon',
            'email' => 'jonlambert94@gmail.com',
            'password' => 'test'
        ]);

        $user->addTriggerAddress('mail-noreply@google.com');
        $user->addTriggerAddress('jonlambert94@googlemail.com');



		// $this->call('UserTableSeeder');
	}

}
