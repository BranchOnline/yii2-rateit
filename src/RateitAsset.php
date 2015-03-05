<?php

namespace branchonline\rateit;

use yii\web\AssetBundle;

/**
 * Description of RateitAsset
 *
 * @author jap
 */
class RateitAsset extends AssetBundle {

    /**
     * Set up CSS and JS asset arrays based on the base-file names
     *
     * @param string $type whether 'css' or 'js'
     * @param array $files the list of 'css' or 'js' basefile names
     */
    protected function setupAssets($type, $files = []) {
        $srcFiles = [];
        foreach ($files as $file) {
            $srcFiles[] = "{$file}.{$type}";
        }

        if (empty($this->$type)) {
            $this->$type = $srcFiles;
        }
    }

    /**
     * @inheritdoc
     */
    public function init() {
        $this->setSourcePath('@vendor/branchonline/yii2-rateit/src/assets');
        $this->setupAssets('css', ['rateit']);
        $this->setupAssets('js', ['jquery.rateit.min']);
        parent::init();
    }

    /**
     * Sets the source path if empty
     * @param string $path the path to be set
     */
    protected function setSourcePath($path) {
        if (empty($this->sourcePath)) {
            $this->sourcePath = $path;
        }
    }

    /**
     * @inheritdoc
     */
    public $depends = [
        'yii\web\JqueryAsset',
    ];

}
