<?php
namespace mmNrc;

class mmNrc
{
    /*
    *
    * getNRC ( null|int|array $state_id, bool|null $associative)
    * **************************************/


    // distictFiltered()
    // Filter disticts by state_id
    private static function distictFiltered($disticts, $state_id, $disticts_filtered = null){
          $disticts_filtered = ($disticts_filtered===null)?new ArrayObject():$disticts_filtered;
          foreach ($disticts as $distict) {
              if($distict->state_id == $state_id){
                  //$disticts_filtered[] = $distict;
                  $disticts_filtered->append($distict);
              }
          }
          return $disticts_filtered;
    }


    // getNRC()
    // Get state_id and disticts
    public static function getNRC($state_id=null, $associative = false){

          $json = file_get_contents(__DIR__."/nrc.json");
          $json = json_decode($json, false);

          // Return all
          if($state_id==null){
            $result = $json;
          }

          // Single state_id filter
          if (is_numeric($state_id)) {
            $disticts = $json;
            $disticts_filtered = distictFiltered($disticts,$state_id);
            $result = $disticts_filtered;
          }

          // Multiple state_ids filter
          if (is_array($state_id)) {
            $state_ids = $state_id;
            $disticts = $json;
            $disticts_filtered = new ArrayObject();
            foreach ($state_ids as $row_state_id) {
              $disticts_filtered = distictFiltered($disticts,$row_state_id,$disticts_filtered);
            }
            $result = $disticts_filtered;
          }

          $result_obj = $result;
          $result_array = json_decode(json_encode($result), true);

          if($associative){
              return $result_array;
          }else{
              return $result_obj;
          }
    }


    /*
    *
    * isNRC ( int $state_id, string $distict, num $reg_no, string|null $lang)
    * **************************************/


    private static function mmToEnNum($num)
    {
        $num = str_replace("၁","1", $num);
        $num = str_replace("၂","2", $num);
        $num = str_replace("၃","3", $num);
        $num = str_replace("၄","4", $num);
        $num = str_replace("၅","5", $num);
        $num = str_replace("၆","6", $num);
        $num = str_replace("၇","7", $num);
        $num = str_replace("၈","8", $num);
        $num = str_replace("၉","9", $num);
        $num = str_replace("၀","0", $num);

        return $num;
    }


    public static function isNRC($state_id, $distict, $reg_no, $lang = "en"){


          // Convert Myanmar Num to Eng Num
          $state_id = mmToEnNum($state_id);
          $reg_no = mmToEnNum($reg_no);


          // Check $is_state_id
          // is numeric string
          if(!is_numeric($state_id)){
              return false;
          }
          // is between 1 ~ 14
          $is_between_1_n_14 = ($state_id>=1&&$state_id<=11)?false:true;
          if(!$is_between_1_n_14){
              return false;
          }


          // Check $is_mm_township_code
          // is check all are Myanmar Unicode charaicter
          $regexMM = '/[\x{1000}-\x{109f}\x{aa60}-\x{aa7f}]+/u';
          if(preg_match($regexMM,$distict)){
              $is_mm_township_code = true;
          }else{
              $is_mm_township_code = false;
          }



          // Check $is_en_township_code
          // is check all are ASCII charaicter
          if(ctype_alpha($distict)){
              $is_en_township_code = true;
          }else{
              $is_en_township_code = false;
          }


          // Check $reg_no_valid
          // is numeric string
          if(!is_numeric($reg_no)){
              return false;
          }


          // is have 6 digit
          $reg_no_length = strlen($reg_no);
          if(!$reg_no_length==6){
              return false;
          }else{
              // is not six digit
          }


          //Check language
          // $lang
          // if en,
          if($lang=="en"){
              // check is all are ASCII charaicter
              // check is en distict exit
              // if this two work, return true
              $is_lang_relevent = ($lang=="en"&&$is_en_township_code==true)?true:fasle;
              if(!$is_lang_relevent){
                  return false;
              }
          }


          // if mm,
          if($lang=="mm"){
              // check is all are Myanmar Unicode charaicter
              // check is mm distict exit
              // if this two work, return true
              $is_lang_relevent = ($lang=="mm"&&$is_mm_township_code==true)?true:false;
              if(!$is_lang_relevent){
                  return false;
              }
          }


          // if any,
          if($lang=="any"){
              // check all are ascii or Myanmar Unicode charaicter
              // check is mm distict or endistict exit
              // do nothing
          }


          // check township code exit in given id
          $list_json = file_get_contents("nrc.json");
          $list_json = json_decode($list_json, false);
          $list_townships = $list_json;
          $disticts_filtered = distictFiltered($list_townships,$state_id);
          $found_en_township_code = false;
          $found_mm_township_code = false;


          foreach ($disticts_filtered as $row_township) {
              // found en township code
              if($row_township->township_en==$distict){
                  $found_en_township_code = true;
              }
              // found mm township code
              // Comment for this moment use it on php 8
              // $str_contains = str_contains($distict,$row_township->township_mm);
              $is_found_string = preg_match("/{$distict}/i",$row_township->township_mm);
              $is_found_string = ($is_found_string!==false)?true:false;
              if($is_found_string){
                  $found_mm_township_code = true;
              }
          }


          // Found township code
          // both not found
          if(!$found_en_township_code&&!$found_mm_township_code){
              return false;
          }


          // mm and not found mm
          if($lang=="mm"&&!$found_mm_township_code){
              return false;
          }


          // en and not found en
          if($lang=="en"&&!$found_en_township_code){
              return false;
          }


          return true;
    }


}
