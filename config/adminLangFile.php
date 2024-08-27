<?php
return [
    'adminFile' => [
//        'admin'=> ['id'=> 'admin' , 'group'=>null ,'file_name'=> 'admin', 'name_en'=> "Admin Core" ,'name_ar'=> "لوحة التحكم " ],
//        'upFilter'=> ['id'=> 'upFilter' , 'group'=>'admin','sub_dir'=> 'config','file_name'=> 'upFilter','name'=>'Photo Filter','name_ar'=>'فلاتر الصور' ],
//        'dataTable'=> ['id'=> 'dataTable' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'dataTable','name'=>'dataTable','name_ar'=>'dataTable' ],
        'alertMass'=> ['id'=> 'alertMass' ,'group'=>'admin','file_name'=> 'alertMass','name_en'=>'Alert Mass','name_ar'=>'رسائل التحذير' ],

//        'filter'=> ['id'=> 'filter', 'group'=>'admin', 'file_name'=> 'formFilter','name_en'=>'Filter Form','name_ar'=>'فلتر' ],
        'settings'=> ['id'=> 'settings' , 'group'=>'admin' , 'sub_dir'=> 'config' , 'file_name'=> 'settings','name'=>'Settings','name_ar'=>'اعدادات الاقسام' ],
//        'deleteMass'=> ['id'=> 'deleteMass','group'=>'admin','file_name'=>'deleteMass','name'=>'Delete Mass','name_ar'=>'رسائل الحذف' ],
        'def' => ['id' => 'def', 'group' => 'admin', 'file_name' => 'def', 'name_en' => 'Default Variables', 'name_ar' => 'المتغيرات الاساسية'],
        'defCat' => ['id' => 'defCat', 'group' => 'admin', 'file_name' => 'defCat', 'name_en' => 'Variables', 'name_ar' => 'متغيرات'],
        'webConfig' => ['id' => 'webConfig', 'group' => 'admin', 'sub_dir' => 'config', 'file_name' => 'webConfig', 'name_en' => 'web Config', 'name_ar' => 'اعدادات الموقع'],
        'roles' => ['id' => 'roles', 'group' => 'admin', 'sub_dir' => 'config', 'file_name' => 'roles', 'name_en' => 'Permissions', 'name_ar' => 'الصلاحيات'],
        'form' => ['id' => 'form', 'group' => 'admin', 'file_name' => 'form', 'name_en' => 'Forms', 'name_ar' => 'الفورم'],
    ],

    'webFile' => [
//        'alertMass'=> ['id'=> 'alertMass','group'=>null , 'sub_dir'=> null ,'file_name'=> 'alertMass','name_en'=>'alertMass','name_ar'=>'alertMass'],
        'def' => ['id' => 'def', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'def', 'name_en' => 'Default Variables', 'name_ar' => 'المتغيرات الاساسية'],
        'menu' => ['id' => 'menu', 'group' => 'web', 'file_name' => 'menu', 'name_en' => 'Menu', 'name_ar' => 'القائمة'],
//        'Profile'=> ['id'=> 'Profile' , 'group'=>'web','file_name'=> 'profile','name_en'=>'Profile','name_ar'=>'الملف الشخصى' ],
        'ProfileMass' => ['id' => 'ProfileMass', 'group' => 'web', 'file_name' => 'profileMass', 'name_en' => 'Profile Mass', 'name_ar' => 'رسائل الملف الشخصى'],
//        'product'=> ['id'=> 'product','group'=>'web','file_name'=> 'proProduct','name_en'=>'Product','name_ar'=>'المنتجات' ],
//        'newsletter'=> ['id'=> 'newsletter' , 'group'=>'web' ,'file_name'=> 'newsletter','name_en'=>'Newsletter' ,'name_ar'=>'القائمة البريدية' ],
        'footer' => ['id' => 'footer', 'group' => 'web', 'file_name' => 'footer', 'name_en' => 'footer', 'name_ar' => 'footer'],
        'eicon' => ['id' => 'eicon', 'group' => 'web', 'file_name' => 'eicon', 'name_en' => 'eicon', 'name_ar' => 'eicon'],
        'contact' => ['id' => 'contact', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'contact', 'name_en' => 'Contact Us', 'name_ar' => 'Contact Us'],
        'blog' => ['id' => 'blog', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'blog', 'name_en' => 'Blog', 'name_ar' => 'Blog'],
        'err404' => ['id' => 'err404', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'err404', 'name_en' => 'err404', 'name_ar' => 'err404'],
        'Sort' => ['id' => 'Sort', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'sort', 'name_en' => 'Sort', 'name_ar' => 'Sort'],
        'Filter' => ['id' => 'Filter', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'filter', 'name_en' => 'Filter', 'name_ar' => 'Filter'],
        'Sidebar' => ['id' => 'Sidebar', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'sidebar', 'name_en' => 'Sidebar', 'name_ar' => 'Sidebar'],
        'product' => ['id' => 'product', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'product', 'name_en' => 'Product', 'name_ar' => 'Product'],
        'cart' => ['id' => 'cart', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'cart', 'name_en' => 'cart', 'name_ar' => 'cart'],
        'order' => ['id' => 'order', 'group' => 'web', 'sub_dir' => null, 'file_name' => 'order', 'name_en' => 'order', 'name_ar' => 'order'],

//        'layout'=> ['id'=> 'layout' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'layout','name'=>'Web Layout' ],
//        'search'=> ['id'=> 'search' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'search','name'=>'Search' ],
//        'home'=> ['id'=> 'home' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'home','name'=>'Home Page' ],
//        'var'=> ['id'=> 'var' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'var','name'=>'Var' ],
//        'Schema'=> ['id'=> 'Schema' , 'group'=>'web' , 'sub_dir'=> null , 'file_name'=> 'schema','name'=>'Schema' ],
    ],


];
