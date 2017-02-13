<?php

interface ImageInterface {

	/**
	 * Open Image
	 * @param  str $filename 
	 */
	public function open($filename);

	/**
	 * Get width of image
	 * @return int/float
	 */
	public function getWidth();

	/**
	 * Get height of image
	 * @return int/float
	 */
	public function getHeight();

	/**
	 * Get type of image
	 * @return string jpeg/gif/png...
	 */
    public function getType();
	
	/**
	 * Check file
	 * @return boolean
	 */
	public function isImage();

	/**
	 * Save to new file
	 * @param  string $filepath   
	 * @param  string $filename   
	 * @param  MIME type of the image $image_type 
	 * @return string filename
	 */
	public function save($filepath, $filename, $image_type = IMAGETYPE_JPEG);
}