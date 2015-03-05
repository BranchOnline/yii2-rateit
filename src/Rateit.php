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

    /**
     * 
     * @var integer the step value 
     */
    public $step = 1;
    
    /**
     *
     * @var integer the minimum value
     */
    public $min = 0;
    
    /**
     *
     * @var integer the maximum value
     */
    public $max = 10;
    
    /**
     *
     * @var boolean when not readonly, whether to show the reset button
     */
    public $resetable = false;
    
    /**
     *
     * @var integer width of the (star) picture
     */
    public $star_width = 16;
    
    /**
     *
     * @var integer height of the (star) picture
     */
    public $star_height = 16;
    
    /**
     *
     * @var string optional extra class to be added to the rateit div.
     */
    public $rateit_class = null;
    
    /**
     * Initializes the widgets. Registers the assets.
     */
    public function init() {
        parent::init();
        
        $this->options['type'] = 'range';
        $this->options['step'] = $this->step;
        
        RateitAsset::register($this->getView());
    }

    /**
     * Runs the widgets. Renders the input field and the rateit div.
     */
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
