# README.md

PHP Composer Package - Myanmar National Registration Card. in from NRC card. General purpose library for Myanmar NRC Card. Get list of townships code used in NRC number format, validation NRC number inputs and intigrated in forms.  For full documentation pleser refer to DOCUMENTATION.md

- Special Thanks
- Installation
- Roadmap
- Contribution
- Usage



## Special Thanks

Htet Oo Zin / Myanmar NRC
https://github.com/htetoozin/Myanmar-NRC



## Installation

~~~
composer install
~~~



## Roadmap

- VanillaJS Library Myanmar National Registration Card
- JavaScript, Node.js Package

I am planning to release next two news release. Please join and congribute in this repository.

## Contributing

Interested in contributing to Architect? I would love your help. PHP Composer Package - Myanmar National Registration Card is an open source project, built one contribution at a time by users like you.

## Usage

### getNRC

**Example #1 Get all states and states' disticts short codes**

~~~php+HTML
<?php
  
$array = getNRC();
var_dump($array);

?>
~~~

The above example will output:

~~~php+HTML
array(2) {
  [0]=>
  array(9) {
    [0]=>
    array(4) {
      ["distict_id"]=>
      string(2) "24"
      ["township_en"]=>
      string(7) "BaLaKha"
      ["township_mm"]=>
      string(33) "(ဘလခ) ဘော်လခဲ"
      ["state_id"]=>
      string(1) "2"
    }
	...
~~~

**Example #2 Filter single or multiple states and states' disticts short codes**

~~~php+HTML
<?php
  
$array1 = getNRC(12);
var_dump($array1); // Output disticts with state_id 12 only

  
$array2 = getNRC([12,6,7]); // Output disticts with state_id 12, 6 and 7 only
var_dump($array2);

?>
~~~





# isNRC

**Example #1 Simple vaid and invalid examples**

~~~php+HTML
<?php
// This output will be valid
$state_id = 12;
$distict = "BaTaHta";
$reg_no = 010203;
$is_valid = isNRC($state_id,$distict,$reg_no,$lang);
var_dump($is_valid);

// This output will be invalid
$lang = "mm";
$is_valid = isNRC($state_id,$distict,$reg_no,$lang);
var_dump($is_valid);

?>
~~~

The above example will output:

~~~php+HTML
true
false
~~~



**Example #2 Commoon invalid examples comparing with valid examples**

~~~php+HTML
// Simple check with English Charaictes
$is_valid = isNRC("12","BaTaHta","010203");
var_dump($is_valid);

// Simple check with English Charaictes
$is_valid = isNRC("12","LaMaNa","010203","en");
var_dump($is_valid);

// Mixup Myannar and English numeric charaictes check
$is_valid = isNRC("12","ဗတထ","010203","mm");
var_dump($is_valid);

// Can mixup Myannar and English numeric charaictes
$is_valid = isNRC("12","BaTaHta",'၀၁၀၂၀၃','any');
var_dump($is_valid);

// Can mixup Myanamr and English charaictes for numeric string where lang is en or mm
$is_valid = isNRC("12","လမန",'၀၁၀၂၀၃',"mm");
var_dump($is_valid);

// Defined language and input must be relevent
$lang = "en";
$is_valid = isNRC($state_id,$distict,$reg_no,$lang);
var_dump($is_valid);

// Township codes and state_id must be relative
$is_valid = isNRC("6","BaTaHta",010203);
var_dump($is_valid);

// Reg no mush be 6 digit
$is_valid = isNRC("6","BaTaHta",001002003);
var_dump($is_valid);
~~~

The above example will output:

~~~php+HTML
bool(true)
bool(true)
bool(true)
bool(true)
bool(true)
bool(false)
bool(false)
bool(false)
~~~



 **Notes**

> Note:
>More examples available in **`repository/examples/`** directory.  These examples also available on **web demo**.



> Note:
>For full documentation pleser refer to DOCUMENTATION.md

