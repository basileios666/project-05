<?php
function langs($phrase){
    static $lang = array(
        //navbar
        'HOME' => 'Home',
        'SETTING' => 'Setting',
        'LOGOUT' => 'Logout',
        // title
        'DEFAULT' => 'Title',
        'LOGIN' => 'Login',
        'DASHBOARD' => 'Dashboard',
        'MEMBERS' => 'Members',
    );
    return $lang[$phrase];
}