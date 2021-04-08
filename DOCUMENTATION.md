# DOCUMENTATION.md

Myanmar National Registration Card. 

# getNRC

getNRC - Get states and states' disticts short codes as array.

### Description

~~~php
getNRC ( null|int|array $state_id, bool|null $associative)
~~~

Use for Myanmar Citizen NRC system. Return states and states' disticts short codes as array.

### Parameters

**state_id**

​			Default is **`null`**. When **`null`** return all states and states' disticts short codes. When filter a single state or multiple states, return only requested states and states' disticts short codes.

**associative**

​			When **`true`** and **`null`**, objects will be returned as associative arrays; when **`false`**, objects will be returned as objects.

### Return Values

Returns the value in associative arrays or objects. 

### Examples

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

### Notes

> **Note:**
> More examples available in **`repository/examples/`** directory.  These examples also available on <u>web demo</u>.



# isNRC

isNRC - Check input NRC number is valid.

### Description

~~~php
isNRC ( numeric_strings $state_id, string $distict, numeric_strings $reg_no, string|null $lang)
~~~

Use for Myanmar Citizen NRC system. When value is **valid**, return as **`true`**; when value is **invalid**, return as **`false`**.

### Parameters

**state_id**

​			Prefer **`numeric_strings`**

**district**

​			Prefer **`numeric_strings`**

**reg_no**

​			Prefer **`numeric_strings`**

**lang**

​			Defaule value is **en**. When **en**, require input values as ASCII charaicter; when value is **mm**, require input values as Myanmar Unicode string; when value is **any**, require input value as ASCII charaicter or Myanmar Unicode string.

### Return Value

Returns the value in **`bool`**. When the values of **`state_id`** and **`district`** is not matched, returned as **`false`**; when the values of **`reg_no`** is not numeric, returned as **`false`**; when the values of **`reg_no`** is not 6 digit, returned as **`false`**; when the **`lang`** value and rest of values not matched, returned as **`false`**.

### Examples

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



Notes

> > Note:
>> More examples available in **`repository/examples/`** directory.  These examples also available on **web demo**.



