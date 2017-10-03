<?php
/**
 * Handles flash notification throughout the application.
 *
 * @param  String $message           The primary message (i.e. Success!, Error!)
 * @param  String $secondary_message The secondary message (i.e. Customer created.)
 * @param  String $level             The CSS class name which determines the color of the message element.
 * @return null                      Flashes the data to the session.
 */
function flash($message, $secondary_message, $level = 'info')
{
    session()->flash('flash_message', $message);
    session()->flash('flash_secondary_message', $secondary_message);
    session()->flash('flash_message_level', $level);
}

/**
 * Formats activity log items for iteration.
 *
 * @param  String $description Activity type (created, updated, deleted, logged in, etc)
 * @param  String $subject     The model where the activity happened
 * @return String              A formatted string to call the appropriate view
 */
function formatActivityModelName($description, $subject)
{
    return str_replace(' ', '', $description) . '_' . strtolower(str_replace('App\\', '', $subject));
}
