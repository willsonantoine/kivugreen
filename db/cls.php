<?php

class Cls extends Http
{

    public   function getImg($img)
    {
        return ($img == null || $img == '') ?  URL_IMAGES . 'default.png' : URL_IMAGES . $img ;
    }

    public function getVal($array, $val, $isImage)
    {
        $array = (object) $array;

        if ($isImage == false) {
            $value  = (strlen($array->$val) > 0) ? $array->$val : '';
        } else {
            $value = $this->getImg($array->$val);
        }

        return $value;
    }

    function filter_callback($element)
    {
        if (isset($element->foo) && $element->foo == 'some_value') {
            return TRUE;
        }
        return FALSE;
    }

    public function getItem($array, $ref)
    {

       
        $val = [];
        foreach ($array as $key => $value) {

            if ($value->id_ref == $ref) {
                
                $val = $value;
            }
        }

        return  $val;
    }

    public function getImgItem($value_item)
    {
        $tab = [];
        foreach (json_decode($value_item->file) as $key => $value) {
            $tab[] = URL_IMAGES . $value;
        }

        return $tab;
    }
}
