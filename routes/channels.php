<?php

use Illuminate\Support\Facades\Broadcast;

Broadcast::channel('App\Events\ProjectUpdated', function () {
    return true; // Allow anyone to listen to the 'projects' channel
});
