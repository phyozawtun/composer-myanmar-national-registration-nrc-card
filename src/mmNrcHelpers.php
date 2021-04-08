<?php
namespace mmNrc\mmNrcHelpers;

class mmNrcHelpers
{
      public static function function distictFiltered($disticts, $state_id, $disticts_filtered = null){
            $disticts_filtered = ($disticts_filtered===null)?new ArrayObject():$disticts_filtered;
            foreach ($disticts as $distict) {
                if($distict->state_id == $state_id){
                    //$disticts_filtered[] = $distict;
                    $disticts_filtered->append($distict);
                }
            }
            return $disticts_filtered;
      }


      public static function function mmToEnNum($num)
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


}
