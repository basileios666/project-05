<?php
function langs($phrase){
    static $lang = array(
        //navbar
        'HOME' => 'الرئيسية',
        'SETTING' => 'الاعدادات',
        'LOGOUT' => 'خروج',
        //title
        'DEFAULT' => 'عنوان',
        'LOGIN' => 'تسجيل دخول',
        'DASHBOARD' => 'لوحة التحكم',
        'MEMBERS' => 'الاعضاء',
    );
    return $lang[$phrase];
}