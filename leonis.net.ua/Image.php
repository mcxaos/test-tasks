<?php

class Image implements ImageInterface
{
	private $file;
	/**
	 * Open Image
	 * @param  str $filename 
	 */
	public function open($filename)
	{
		$this->file = $filename;
		return fopen($filename,"r");
	}

	/**
	 * Get width of image
	 * @return int/float
	 */
	public function getWidth()
	{
		$size =GetImageSize($this->file);
		return $size[0];
	}

	/**
	 * Get height of image
	 * @return int/float
	 */
	public function getHeight()
	{
		$size =GetImageSize($this->file);
		return $size[1];
	}

	/**
	 * Get type of image
	 * @return string jpeg/gif/png...
	 */
    public function getType()
    {
    	return image_type_to_extension (exif_imagetype($this->file));
    }
	
	/**
	 * Check file
	 * @return boolean
	 */
	public function isImage()
	{
		return preg_match('/^image/', $this->file['type']);
	}

	/**
	 * Save to new file
	 * @param  string $filepath   
	 * @param  string $filename   
	 * @param  MIME type of the image $image_type 
	 * @return string filename
	 */
	public function save($filepath, $filename, $image_type = IMAGETYPE_JPEG)
	{		
		$filename = $filename . '.' . $this->getWidth() . 'x' . $this->getHeight(). $this->getType();
		copy($this->file, $filepath.$filename);
		return $filename;
	}

}