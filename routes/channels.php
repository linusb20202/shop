<?php

use Illuminate\Support\Facades\Broadcast;
/*
|--------------------------------------------------------------------------
| Broadcast Channels
|--------------------------------------------------------------------------
|
| Here you may register all of the event broadcasting channels that your
| application supports. The given channel authorization callbacks are
| used to check if an authenticated user can listen to the channel.
|
*/

Broadcast::channel('messages.{id}', function ($user, $id) {
    return $user->id === (int) $id;
});

Broadcast::channel('login', function ($user) {
    return $user;
});

Broadcast::channel('typingTo.{id}', function ($user) {
    return $user;

});