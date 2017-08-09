<?php

namespace Magestudy\Crud\Helper;

use Exception;
use Magento\Framework\App\Filesystem\DirectoryList;
use Magento\Framework\Filesystem;
use Magento\Framework\Filesystem\Io\File;
use Magento\Framework\Image\AdapterFactory;
use Magento\MediaStorage\Model\File\UploaderFactory;

class ImageLoader
{
    /**
     * @var \Magento\Framework\Filesystem\Directory\ReadInterface
     */
    protected $_mediaDirectory;

    /**
     * @var UploaderFactory
     */
    protected $_uploaderFactory;

    /**
     * @var AdapterFactory
     */
    protected $_adapterFactory;

    /**
     * @var File
     */
    protected $_file;

    /**
     * @param Filesystem $filesystem
     * @param UploaderFactory $uploaderFactory
     * @param AdapterFactory $adapterFactory
     * @param File $file
     */
    public function __construct(
        Filesystem $filesystem,
        UploaderFactory $uploaderFactory,
        AdapterFactory $adapterFactory,
        File $file
    ) {
        $this->_mediaDirectory = $filesystem->getDirectoryRead(DirectoryList::MEDIA);
        $this->_uploaderFactory = $uploaderFactory;
        $this->_adapterFactory = $adapterFactory;
        $this->_file = $file;
    }

    /**
     * @param string $imagePath
     * @param mixed $imageUrl
     * @throws Exception
     * @return string|null
     */
    public function loadImage($imagePath, $imageUrl = null)
    {
        if (!isset($_FILES['image'])) {
            return null;
        }
        try {
            $path = $this->_mediaDirectory->getAbsolutePath($imagePath);
            if (isset($_FILES['image']['name']) && strlen($_FILES['image']['name'])) {

                /** @var \Magento\MediaStorage\Model\File\Uploader $uploader */
                $uploader = $this->_uploaderFactory->create(['fileId' => 'image']);
                $uploader->setAllowedExtensions(['jpg', 'jpeg', 'gif', 'png']);

                /** @var \Magento\Framework\Image\Adapter\AdapterInterface $imageAdapter */
                $imageAdapter = $this->_adapterFactory->create();
                $uploader->addValidateCallback('image', $imageAdapter, 'validateUploadFile');
                $uploader->setAllowRenameFiles(true);
                $uploader->setFilesDispersion(true);
                $result = $uploader->save($path);
                return $imagePath . $result['file'];
            } else {
                if ($imageUrl && is_array($imageUrl)) {
                    if ($imageUrl['delete'] == "1") {
                        $imageUrl = $this->_mediaDirectory->getAbsolutePath() . $imageUrl['value'];
                        $this->_file->rm($imageUrl);
                        return null;
                    }
                }
            }
        } catch (\Exception $e) {
            throw new Exception('Can\'t save image.');
        }
        return $imageUrl;
    }
}