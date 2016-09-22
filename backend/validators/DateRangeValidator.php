<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 9/21/2016
 * Time: 1:52 AM
 */

namespace backend\validators;

use yii\validators\Validator;

class DateRangeValidator extends Validator
{
    public function validateAttribute($model, $attribute)
    {
        if (strtotime($model->$attribute) < strtotime('now')) {
            $this->addError($model, $attribute, 'Invalid Date.');
        }
    }
}