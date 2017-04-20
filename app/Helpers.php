<?php

    function flash($message, $secondary_message, $level = 'info')
    {
        session()->flash('flash_message', $message);
        session()->flash('flash_secondary_message', $secondary_message);
        session()->flash('flash_message_level', $level);
    }

    function formatActivityModelName($description, $subject)
    {
        $formatted = str_replace(' ', '', $description) . '_' . strtolower(str_replace('App\\', '', $subject)); 
        return $formatted;
    }
