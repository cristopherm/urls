<?php

/**
 * Flash the current success message.
 *
 * @param  string $message
 */
function flashSuccess(string $message)
{
    session()->flash('success', $message);
}
