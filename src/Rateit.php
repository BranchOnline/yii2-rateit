<?php

namespace branchonline\rateit;

use yii\helpers\Html;
use yii\widgets\InputWidget;

/**
 * The Rateit widget is a wrapper for the jquery rateit library.
 * 
 * Usage:
 * echo branchonline\rateit\Rateit::widget([
 *     'name' => 'my-rateit-field',
 *     'value' => 4, //optional ofcoure
 * ]);
 *
 * @author Jap Mul
 */
class Rateit extends InputWidget {

    public $step = 1;
    
    public $min = 0;
    
    public $max = 10;
    
    public $resetable = false;
    
    public $star_width = 16;
    
    public $star_height = 16;
    
    public $rateit_class = null;
    
    public function init() {
        parent::init();
        
        $this->options['type'] = 'range';
        $this->options['step'] = $this->step;
        
        RateitAsset::register($this->getView());
    }

    public function run() {
        $id = $this->getId();
        if($this->hasModel()) {
            echo Html::activeTextInput($this->model, $this->attribute, $this->options);
        } else {
            echo Html::textInput($this->name, $this->value, $this->options);
        }
        
        echo Html::tag('div', null, [
            'class' => 'rateit ' . $this->rateit_class,
            'data-rateit-backingfld' => '#' . $id,
            'data-rateit-resetable' => $this->resetable ? 'true' : 'false',
            'data-rateit-min' => $this->min,
            'data-rateit-max' => $this->max,
            'data-rateit-starwidth' => $this->star_width,
            'data-rateit-starheight' => $this->star_height,
        ]);
    }
}
