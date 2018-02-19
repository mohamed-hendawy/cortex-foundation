<?php

declare(strict_types=1);

use Illuminate\Database\Seeder;

class CortexFoundationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Bouncer::allow('admin')->to('access-adminarea');

        Bouncer::allow('admin')->to('list', config('medialibrary.media_model'));
        Bouncer::allow('admin')->to('create', config('medialibrary.media_model'));
        Bouncer::allow('admin')->to('update', config('medialibrary.media_model'));
        Bouncer::allow('admin')->to('delete', config('medialibrary.media_model'));
        Bouncer::allow('admin')->to('audit', config('medialibrary.media_model'));
    }
}