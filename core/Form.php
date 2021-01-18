<?php


namespace Core;


class Form
{

    /**
     * @param string $name
     * @param string $labelText
     * @param string $inputType
     * @param array $additionalOptions
     */
    public static function renderGroup(string $name, string $labelText, string $inputType = 'text', array $additionalOptions = ['class' => '', 'describedBy' => '', 'selectOptions' => [], 'value' => '', 'required' => false])
    {

        $checkboxClass = $inputType === 'checkbox' ? 'form__group--checkbox' : '';
        $additionalClasses = isset($additionalOptions['class']) ? $additionalOptions['class'] : '';
        echo "<div class='form__group $checkboxClass $additionalClasses'>";

        $isPassword = $inputType === 'password';

        $label = "<label for='$name'>$labelText</label>";

        $required = $additionalOptions['required'] === true ? 'required' : '';


        $ariaDescribedBy = '';
        $oldValue = '';

        if (self::checkIfOptionIsSet($additionalOptions, 'describedBy')) {
            $ariaDescribedBy = "aria-describedby='${additionalOptions['describedBy']}'";
        }

        if (self::checkIfOptionIsSet($additionalOptions, 'value')) {
            $oldValue = $additionalOptions['value'];
        } else {
            $oldValue = !$isPassword ? Session::old("$name", '') : '';
        }

        if ($inputType === 'checkbox') {
            $checkedString = $oldValue === 'on' ? 'checked' : '';
            echo "<input type='$inputType' name='$name' id='$name' $checkedString />";
            echo $label;
        } elseif ($inputType === 'textarea') {
            echo $label;
            echo "<textarea rows='6' name='$name' id='$name' class='form__input' $ariaDescribedBy>$oldValue</textarea>";
        } elseif ($inputType === 'select') {
            echo $label;
            echo "<select name='$name' id='$name' class='form__input' $ariaDescribedBy>";
            if (count($additionalOptions['selectOptions']) > 0) {
                foreach ($additionalOptions['selectOptions'] as $key => $option) {
                    $checked = '';
                    if ($oldValue === $key) {
                        $checked = 'selected';
                    }
                    echo "<option value='$key' $checked>$option</option>";
                }
            }
            echo "</select>";
        } elseif ($inputType === 'price') {
            echo $label;
            $oldValue = $oldValue === '' ? 0 : $oldValue;
            echo "<input type='number' min='0.00' step='0.01' name='$name' id='$name' class='form__input form__input--price' value='$oldValue' $ariaDescribedBy/>";
        } elseif ($inputType === 'number') {
            echo $label;
            $oldValue = $oldValue === '' ? 0 : $oldValue;
            echo "<input type='number' min='0' step='1' name='$name' id='$name' class='form__input' value='$oldValue' $ariaDescribedBy/>";
        } else {
            echo "<label for='$name'>$labelText</label>";
            echo "<input type='$inputType' name='$name' id='$name' class='form__input' value='$oldValue' $ariaDescribedBy $required/>";
        }

        echo "</div>";
    }

    /**
     * @param array $additionalOptions
     * @param string $value
     * @return bool
     *
     * Checks if a value exists in $additionalOptions
     */
    private static function checkIfOptionIsSet(array $additionalOptions, string $value): bool
    {
        return isset($additionalOptions[$value]) && strlen($additionalOptions[$value]) > 0;
    }

    public static function renderRadioGroup(string $name, array $values)
    {
        foreach ($values as $key => $value) {
            $id = $name . '-' . $key;
            echo  "<div class='form__group form__group--radio'>";
            echo "<input type='radio' name='$name' id='$id' value='$key'>";
            echo "<div class='form__group--radio-checkmark'>";
            echo View::getIcon('checkmark');
            echo "</div>";
            echo "<label for='$id' class='form__group--radio-label'>$value</label>";
            echo "</div>";
        }
    }
}