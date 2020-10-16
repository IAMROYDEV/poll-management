<?php

return [

    // Titles
    'showing-all-polls'     => 'Showing All Polls',
    'polls-menu-alt'        => 'Show Polls Management Menu',
    'create-new-poll'       => 'Create New Poll',
    'show-deleted-polls'    => 'Show Deleted Poll',
    'editing-poll'          => 'Editing Poll :name',
    'showing-poll'          => 'Showing Poll :name',
    'showing-poll-title'    => ':name\'s Information',

    // Flash Messages
    'createSuccess'   => 'Successfully created poll! ',
    'updateSuccess'   => 'Successfully updated poll! ',
    'deleteSuccess'   => 'Successfully deleted poll! ',
    'deleteSelfError' => 'You cannot delete yourself! ',

    'polls-table' => [
        'caption'   => '{1} :pollscount poll total|[2,*] :pollscount total polls',
        'id'        => 'ID',
        'name'      => 'Poll name',
        'description'     => 'Description',
        'activated'     => 'Activated',
        'created'   => 'Created',
        'updated'   => 'Updated',
        'actions'   => 'Actions',
        'updated'   => 'Updated',
    ],

    // Show Poll Tab
    'viewProfile'            => 'View Profile',
    'editPoll'               => 'Edit Poll',
    'deletePoll'             => 'Delete Poll',
    'pollsBackBtn'           => 'Back to Polls',
    'pollsPanelTitle'        => 'Poll Information',
    'labelPollName'          => 'Pollname:',
    'labelEmail'             => 'Email:',
    'labelFirstName'         => 'First Name:',
    'labelLastName'          => 'Last Name:',
    'labelRole'              => 'Role:',
    'labelStatus'            => 'Status:',
    'labelAccessLevel'       => 'Access',
    'labelPermissions'       => 'Permissions:',
    'labelCreatedAt'         => 'Created At:',
    'labelUpdatedAt'         => 'Updated At:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpEmail'           => 'Email Signup IP:',
    'labelIpConfirm'         => 'Confirmation IP:',
    'labelIpSocial'          => 'Socialite Signup IP:',
    'labelIpAdmin'           => 'Admin Signup IP:',
    'labelIpUpdate'          => 'Last Update IP:',
    'labelDeletedAt'         => 'Deleted on',
    'labelIpDeleted'         => 'Deleted IP:',
    'pollsDeletedPanelTitle' => 'Deleted Poll Information',
    'pollsBackDelBtn'        => 'Back to Deleted Polls',

    'successRestore'    => 'Poll successfully restored.',
    'successDestroy'    => 'Poll record successfully destroyed.',
    'errorPollNotFound' => 'Poll not found.',

    'labelPollLevel'  => 'Level',
    'labelPollLevels' => 'Levels',



    'buttons' => [
        'create-new'    => '<i class="fa fa-plus-square fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Create</span><span class="hidden-xs hidden-sm hidden-md">Poll</span>',
        'delete'        => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs hidden-sm">Delete</span><span class="hidden-xs hidden-sm hidden-md"> Poll</span>',
        'show'          => '<i class="fa fa-eye fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Show</span><span class="hidden-xs hidden-sm hidden-md"> Poll</span>',
        'edit'          => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs hidden-sm">Edit</span><span class="hidden-xs hidden-sm hidden-md"> Poll</span>',
        'back-to-polls' => '<span class="hidden-sm hidden-xs">Back to </span><span class="hidden-xs">Polls</span>',
        'back-to-poll'  => 'Back  <span class="hidden-xs">to Poll</span>',
        'delete-poll'   => '<i class="fa fa-trash-o fa-fw" aria-hidden="true"></i>  <span class="hidden-xs">Delete</span><span class="hidden-xs"> Poll</span>',
        'edit-poll'     => '<i class="fa fa-pencil fa-fw" aria-hidden="true"></i> <span class="hidden-xs">Edit</span><span class="hidden-xs"> Poll</span>',
    ],

    'tooltips' => [
        'delete'        => 'Delete',
        'show'          => 'Show',
        'edit'          => 'Edit',
        'create-new'    => 'Create New Poll',
        'back-polls'    => 'Back to polls',
        'email-poll'    => 'Email :poll',
        'submit-search' => 'Submit Polls Search',
        'clear-search'  => 'Clear Search Results',
    ],

    'messages' => [
        'pollNameTaken'          => 'Pollname is taken',
        'pollNameRequired'       => 'Pollname is required',
        'fNameRequired'          => 'First Name is required',
        'lNameRequired'          => 'Last Name is required',
        'emailRequired'          => 'Email is required',
        'emailInvalid'           => 'Email is invalid',
        'passwordRequired'       => 'Password is required',
        'PasswordMin'            => 'Password needs to have at least 6 characters',
        'PasswordMax'            => 'Password maximum length is 20 characters',
        'captchaRequire'         => 'Captcha is required',
        'CaptchaWrong'           => 'Wrong captcha, please try again.',
        'roleRequired'           => 'Poll role is required.',
        'poll-creation-success'  => 'Successfully created poll!',
        'update-poll-success'    => 'Successfully updated poll!',
        'delete-success'         => 'Successfully deleted the poll!',
        'cannot-delete-yourself' => 'You cannot delete yourself!',
    ],

    'show-poll' => [
        'id'                => 'Poll ID',
        'name'              => 'Pollname',
        'email'             => '<span class="hidden-xs">Poll </span>Email',
        'role'              => 'Poll Role',
        'created'           => 'Created <span class="hidden-xs">at</span>',
        'updated'           => 'Updated <span class="hidden-xs">at</span>',
        'labelRole'         => 'Poll Role',
        'labelAccessLevel'  => '<span class="hidden-xs">Poll</span> Access Level|<span class="hidden-xs">Poll</span> Access Levels',
    ],

    'search'  => [
        'title'             => 'Showing Search Results',
        'found-footer'      => ' Record(s) found',
        'no-results'        => 'No Results',
        'search-polls-ph'   => 'Search Polls',
    ],

    'modals' => [
        'delete_poll_message' => 'Are you sure you want to delete :poll?',
    ],
];
