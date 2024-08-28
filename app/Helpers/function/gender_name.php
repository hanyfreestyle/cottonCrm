<?php

use Illuminate\Support\Facades\File;

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('maleNames')) {
    function maleNames() {
        $mergedList = [];
        $mergedList = array_merge($mergedList, getNameFromFile('male'));
        $mergedList = array_merge($mergedList, getNameFromFile('male_christian'));

        $newList = [
            'الاستاذ', 'اللواء', 'المهندس', 'الدكتور', 'استاذ', 'ابو', 'الحاج', 'مهندس', 'دكتور', 'المستشار', 'العميد',
            'مستشار', 'قبطان', 'الكابتن', 'العقيد', 'مستر', 'أستاذ', 'الرائد', 'كابتن', 'عقيد', 'القبطان',
            'عم', 'عميد', 'لواء', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '',
        ];
        $mergedList = array_merge($mergedList, $newList);


        $normalizedList = array_map(function ($name) {
            $name = changeHamza($name);
            return trim($name);
        }, $mergedList);

        $normalizedList = array_filter($normalizedList);
        $normalizedList = array_unique($normalizedList);

        return $normalizedList;

    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('femaleNames')) {
    function femaleNames() {

        $mergedList = [];
        $mergedList = array_merge($mergedList, getNameFromFile('female'));
        $mergedList = array_merge($mergedList, getNameFromFile('female_christian'));

        $newList = [
            'مدام', 'الحاجة', 'الاستاذة', 'الدكتورة', 'ام', 'أستاذة', 'مهندسة', 'ميس', 'بنت', 'جدة', 'حجة', 'حرم', 'دكتورة'
        ];
        $mergedList = array_merge($mergedList, $newList);

        // توحيد الأسماء عبر إزالة الهمزة
        $normalizedList = array_map(function ($name) {
            $name = changeHamza($name);
            return trim($name);
        }, $mergedList);

        $normalizedList = array_filter($normalizedList);
        $normalizedList = array_unique($normalizedList);
        return $normalizedList;
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('guessGender')) {
    function guessGender($fullName) {
        $maleNames = maleNames();
        $femaleNames = femaleNames();

        $nameParts = explode(' ', trim($fullName));
        $firstName = $nameParts[0];
        $firstName = changeHamza($firstName);

        if (in_array($firstName, $maleNames)) {
            return 1;
        } elseif (in_array($firstName, $femaleNames)) {
            return 2;
        } else {
            return null;
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getNameFromFile')) {
    function getNameFromFile($file) {
        $filename = public_path("assets/admin/genderName/$file.txt");
        if (File::isFile($filename)) {
            $fileContent = file_get_contents($filename);
            $namesArray = explode(PHP_EOL, $fileContent);
            return $namesArray;
        } else {
            return [];
        }
    }
}

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('getNameFromFile')) {
    function getNameFromFile($file) {
        $filename = public_path("assets/admin/genderName/$file.txt");
        if (File::isFile($filename)) {
            $fileContent = file_get_contents($filename);
            $namesArray = explode(PHP_EOL, $fileContent);
            return $namesArray;
        } else {
            return [];
        }
    }
}
#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
if (!function_exists('changeHamza')) {
    function changeHamza($name) {

        $rep = [
            'أ',
            'إ',
            'آ' ,
            'ة',
            'ي',
        ];
        $rep_r = [
            'ا',
            'ا',
            'ا',
            'ه',
            'ى',
        ];
        $name = str_replace($rep, $rep_r, $name);
        return $name;
    }
}








#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||

#@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@>>>>>>>>>>>>>>>>>>>>>>>>>>>>>
#||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||||
