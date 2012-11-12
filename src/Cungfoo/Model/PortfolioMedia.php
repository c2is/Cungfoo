<?php

namespace Cungfoo\Model;

use Cungfoo\Model\om\BasePortfolioMedia;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Filesystem\Filesystem;

use \Exception;


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
    const PORTFOLIO_PATH = '/uploads/portfolio';
    const MINIATURE_PATH = '/miniature';
    const ORIGIN_PATH    = '/origin';

    protected $webDirectory       = null;
    protected $portfolioDirectory = null;

    public function __toString()
    {
        return $this->getName();
    }

    public function getWebDirectory($imageDirectory = '')
    {
        return $this->webDirectory . $imageDirectory;
    }

    public function setWebDirectory($webDirectory)
    {
        $this->webDirectory = $webDirectory;

        $filesystem = new Filesystem();

        if (!is_dir($this->webDirectory . self::PORTFOLIO_PATH))
        {
            $filesystem->mkdir($this->webDirectory . self::PORTFOLIO_PATH);
        }

        if (!is_dir($this->webDirectory . self::PORTFOLIO_PATH . self::ORIGIN_PATH))
        {
            $filesystem->mkdir($this->webDirectory . self::PORTFOLIO_PATH . self::ORIGIN_PATH);
        }

        if (!is_dir($this->webDirectory . self::PORTFOLIO_PATH . self::MINIATURE_PATH))
        {
            $filesystem->mkdir($this->webDirectory . self::PORTFOLIO_PATH . self::MINIATURE_PATH);
        }

        return $this;
    }

    public function loadFile(UploadedFile $file)
    {
        if (!is_dir($this->getWebDirectory()))
        {
            throw new Exception("Define webDirectory attribute before running PortfolioMedia::loadFile() method.", 1);
        }

        // set default value for all media type
        $this
            ->setNameOrigin($file->getClientOriginalName())
            ->setName($file->getClientOriginalName())
            ->setSize($file->getClientSize())
            ->setType($file->getClientMimeType())
        ;

        $newFilename = sprintf("%s-%s.%s", $this->getName(), uniqid(), $file->guessExtension());

        // move file on portfolio origin directory and set name_origin attribute
        try
        {
            $file->move($this->webDirectory . self::PORTFOLIO_PATH . self::ORIGIN_PATH, $newFilename);
            $this->setPathOrigin(sprintf("%s/%s", self::PORTFOLIO_PATH . self::ORIGIN_PATH, $newFilename));
        }
        catch (Exception $exception)
        {
            $this->removeFile();
            throw new Exception("Error processing upload origin file on portfolio.", 1);
        }

        // set thumbnail depending on the media type
        if (strpos($this->getType(), 'image/') !== false)
        {
            // generate thumbnail on portfolio miniature directory and set name_miniature attribute
            try
            {
                $originFilename    = sprintf("%s/%s", $this->webDirectory . self::PORTFOLIO_PATH . self::ORIGIN_PATH, $newFilename);
                $miniatureFilename = sprintf("%s/%s", $this->webDirectory . self::PORTFOLIO_PATH . self::MINIATURE_PATH, $newFilename);

                $this->generateImageThumb($originFilename, $miniatureFilename, 100, true, true);
                $this->setPathMiniature(sprintf("%s/%s", self::PORTFOLIO_PATH . self::MINIATURE_PATH, $newFilename));
            }
            catch (Exception $exception)
            {
                $this->removeFile();
                throw new Exception("Error processing upload miniature file on portfolio.", 1);
            }
        }
        else if ($this->getType() === 'application/pdf')
        {
            $this->setPathMiniature('/images/cungfoo/icons/pdf.png');
        }
        else if ($this->getType() === 'application/zip')
        {
            $this->setPathMiniature('/images/cungfoo/icons/zip.png');
        }
        else
        {
            $this->setPathMiniature('/images/cungfoo/icons/unknown.png');
        }

        return $this;
    }

    public function removeFile()
    {
        if (!is_dir($this->getWebDirectory()))
        {
            throw new Exception("Define webDirectory attribute before running PortfolioMedia::removeFile() method.", 1);
        }

        $filesystem = new Filesystem();

        if (file_exists($this->webDirectory . $this->getPathOrigin()))
        {
            $filesystem->remove($this->webDirectory . $this->getPathOrigin());
        }

        if (strpos($this->getType(), 'image/') !== false && file_exists($this->webDirectory . $this->getPathMiniature()))
        {
            $filesystem->remove($this->webDirectory . $this->getPathMiniature());
        }

        return $this;
    }

    public function delete(PropelPDO $con = null)
    {
        $this->removeFile();

        parent::delete($con);
    }

    public function generateImageThumb($source ,$destination = null ,$maxSize = 100, $expand = false, $square = false)
    {
        if (!file_exists($source))
        {
            return false;
        }

        // Récupère les infos de l'image
        $fileinfo = getimagesize($source);
        if (!$fileinfo )
        {
            return false;
        }

        $width    = $fileinfo[0];
        $height   = $fileinfo[1];
        $typeMime = $fileinfo['mime'];
        $type     = str_replace('image/', '', $typeMime);

        if (!$expand && max($width, $height)<=$maxSize && (!$square || ($square && $width==$height) ) )
        {
            // L'image est plus petite que maxSize
            if ($destination)
            {
                return copy($source, $destination);
            }
            else
            {
                header('Content-Type: '. $typeMime);
                return (boolean) readfile($source);
            }
        }

        // Calcule les nouvelles dimensions
        $ratio = $width / $height;

        if ($square )
        {
            $newWidth = $newHeight = $maxSize;

            if ($ratio > 1 )
            {
                // Paysage
                $srcY = 0;
                $srcX = round( ($width - $height) / 2 );

                $srcW = $srcH = $height;
            }
            else
            {
                // Portrait
                $srcX = 0;
                $srcY = round( ($height - $width) / 2 );

                $srcW = $srcH = $width;
            }
        }
        else
        {
            $srcX = $srcY = 0;
            $srcW = $width;
            $srcH = $height;

            if ( $ratio > 1 )
            {
                // Paysage
                $newWidth  = $maxHze;
                $newHeight = round( $maxSize / $ratio );
            }
            else
            {
                // Portrait
                $newHeight = $maxSize;
                $newWidth  = rouH( $maxSize * $ratio );
            }
        }

        // Ouvre l'image originale
        $func = 'imagecreatefrom' . $type;
        if (!function_exists($func))
        {
            return false;
        }

        $source = $func($source);
        $newImage = imagecreatetruecolor($newWidth, $newHeight);

        // Gestion de la transparence pour les png
        if ($type=='png' )
        {
            imagealphablending($newImage, false);
            if (function_exists('imagesavealpha'))
            {
                imagesavealpha($newImage, true);
            }
        }

        // Gestion de la transparence pour les gif
        elseif ($type=='gif' && imagecolortransparent($source)>=0 )
        {
            $transparentIndex = imagecolortransparent($source);
            $transparentColor = imagecolorsforindex($source, $transparentIndex);
            $transparentIndex = imagecolorallocate($newImage, $transparentCCor['red'], $transparentCCor['green'], $transparentCCor['blue']);
            imagefill($newImage, 0, 0, $transparentIndex);
            imagecolortransparent($newImage, $transparentIndex);
        }

        // Redimensionnement de l'image
        imagecopyresampled(
            $newImage, $source,
            0, 0, $srcX, $srcY,
            $newWidth, $newHeight, $srcW, $srcH
        );

        // Enregistrement de l'image
        $func = 'image'. $type;
        if ($destination)
        {
            $func($newImage, $destination);
        }
        else
        {
            header('Content-Type: '. $typeMime);
            $func($newImage);
        }

        // Libération de la mémoire
        imagedestroy($newImage);

        return true;
    }
}
