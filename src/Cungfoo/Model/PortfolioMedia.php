<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BasePortfolioMedia;


/**
 * Skeleton subclass for representing a row from the 'portfolio_media' table.
 *
 *
 *
 * You should add additional methods to this class to meet the
 * application requirements.  This class will only be generated as
 * long as it does not already exist in the output directory.
 *
 * @package    propel.generator.Cungfoo.Model
 */
class PortfolioMedia extends BasePortfolioMedia
{
    /**
     * @param \Symfony\Component\Form\Form $form
     * @return void
     */
    public function uploadFile(\Symfony\Component\Form\Form $form)
    {
        if (!file_exists($this->getUploadRootDir() . '/' . $form['file']->getData()))
        {
            list($width, $height) = getimagesize($form['file']->getData()->getPathName());

            $this->setWidth($width);
            $this->setHeight($height);
            $this->setType($form['file']->getData()->getClientMimeType());
            $this->setSize($this->convertFileSize($form['file']->getData()->getClientSize()));
        }

        parent::uploadFile($form);
    }

    public function convertFileSize($bytes)
    {
        switch ($bytes) {
            case $bytes > 1024*1024*1024:
                return round($bytes/1024/1024/1024, 2) ." Go";
            case $bytes > 1024*1024:
                return round($bytes/1024/1024, 2) ." Mo";
            case $bytes > 1024:
                return round($bytes/1024, 2) ." Ko";
            default:
                return $bytes;
        }
    }

    public function getUploadDir()
    {
        return 'portfolio';
    }

    public function getUploadRootDir()
    {
        return __DIR__.'/../../../web/'.$this->getUploadDir();
    }
}
