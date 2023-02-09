<?php

/**
 * セレクトタグ生成関数
 * @param string $inputName
 * @param array $srcArray
 * @param string $selectedIndex
 * @return string
 */
function arrayToSelect(string $inputName, string $isInvalid, array $srcArray, string $selectedIndex = ''): string
{
    $temphtml = '<select class="form-select form-control rounded-3'.$isInvalid.'" name="'.$inputName.'" id="validationServer01">' . PHP_EOL;
    foreach ($srcArray as $key => $val) {
        if ($key == $selectedIndex) {
            $selectedText = 'selected';
        } else {
            $selectedText = '';
        }
        $temphtml .='<option value="'.$key.'"'.$selectedText.'>'.$val.'</option>' . PHP_EOL;
    }
    $temphtml .= '</select>' . PHP_EOL;

    return $temphtml;
}
