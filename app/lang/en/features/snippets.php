<?php

return array(

        'create' => array(
                'error'   => 'There was a problem while trying to save your snippet, please try again.',
                'success' => 'Snippet successfully saved!',
        ),

        'update' => array(
                'error'   => 'There was a problem updating that snippet, please try again.',
                'success' => 'Snippet updated successfully!',
        ),

        'update_check' => array(
                'error'   => 'You cant edit a snippet you dont own!',
        ),

        'view_check' => array(
                'error'   => 'You cant view other peoples snippets.',
        ),

        'delete' => array(
                'success' => 'Snippet successfully deleted!',
        ),

        'delete_check' => array(
                'error' => 'You cant delete other peoples snippets, thats just rude!',
        ),

        'not_found' => array(
                'error' => 'That snippet does not exist.',
        ),

        'private' => array(
                'info' => 'You cannot view private snippets in the public snippets section.',
        ),


        'public' => array(
                'info' => 'That snippet can seen in the public snippets section: <a href="snippets/public">Click Here</a>',
        ),
);