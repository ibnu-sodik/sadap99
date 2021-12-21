<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// require_once("vendor/autoload.php");

/**
 * CodeIgniter TinyPNG Library
 *
 * @version 0.0.1
 * @package	CI TinyPNG
 * @author	Marcos Santana
 * @copyright	Copyright (c) 2018
 * @license	https://opensource.org/licenses/MIT	MIT License
 * @since	Version 0.0.1
 * 
 */


class Tiny_png
{
	public function __construct($api)
	{
		require_once("tinify/Tinify/Exception.php");
		require_once("tinify/Tinify/ResultMeta.php");
		require_once("tinify/Tinify/Result.php");
		require_once("tinify/Tinify/Source.php");
		require_once("tinify/Tinify/Client.php");
		require_once("tinify/Tinify.php");

		try {
			\Tinify\setKey($api['api_key']);
		} catch(\Tinify\AccountException $e) {
			print("Account Error: " . $e->getMessage());
		}
	}

	/**
	 * Test connection with API
	 */

	public function testConnection()
	{
		try {
			\Tinify\validate();
			return "Authenticated";
		} catch(\Tinify\AccountException $e) {
			return "Account Error: " . $e->getMessage();
		} catch(Exception $e) {
			return "General Error: " . $e->getMessage();
		}
	}

	/**
	 * Get number of compressed files
	 */

	public function countCompressed()
	{
		\Tinify\validate();
		return \Tinify\compressionCount();
	}

	/**
	 * Compress image and save in server
	 * $path (string) original image locate
	 * $new_path (string) location where image was saved
	 */

	public function fileCompress($path, $new_path)
	{
		try {
			$source = \Tinify\fromFile($path);
			$source->toFile($new_path);
		} catch(\Tinify\ClientException $e){
			return $e->getMessage();
		} catch(\Tinify\ServerException $e) {
			return $e->getMessage();
		} catch(\Tinify\ConnectionException $e) {
			return $e->getMessage();
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * Compress image and store in buffer
	 * $path (string) original image locate
	 */

	public function bufferCompress($path)
	{
		try {
			$source = file_get_contents($path);
			return \Tinify\fromBuffer($source)->toBuffer();
		} catch(\Tinify\ClientException $e){
			return $e->getMessage();
		} catch(\Tinify\ServerException $e) {
			return $e->getMessage();
		} catch(\Tinify\ConnectionException $e) {
			return $e->getMessage();
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * Compress image from URL and save in server
	 * $url (string) original image URL
	 * $new_path (string) location where image was saved
	 */

	public function urlCompress($url, $new_path)
	{
		try {
			$source = \Tinify\fromUrl($url);
			$source->toFile($path);
		} catch(\Tinify\ClientException $e){
			return $e->getMessage();
		} catch(\Tinify\ServerException $e) {
			return $e->getMessage();
		} catch(\Tinify\ConnectionException $e) {
			return $e->getMessage();
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * Resize image and save in server
	 * $path (string) original image locate
	 * $new_path (string) location where image was saved
	 * $method (string) method of resize image: 'scale', 'fit', 'cover', 'thumb' 
	 * $width (integer) width of new image
	 * $height (integer) height of new image
	 */

	public function fileResize($path, $new_path, $method, $width = 0, $height = 0)
	{
		try {
			$source = \Tinify\fromFile($path);
			$array = array(
				'method' => $method,
				'width' => $width,
				'height' => $height
			);
			if($method == 'scale') {
				if($width == 0 && $height != 0)
					unset($array['width']);
				else if($width != 0 && $height == 0)
					unset($array['height']);
				else
					unset($array);
			}
			if(isset($array)){
				$resize = $source->resize($array);
				$resize->toFile($new_path);
			} else {
				$source->toFile($new_path);
			}
		} catch(\Tinify\ClientException $e){
			return $e->getMessage();
		} catch(\Tinify\ServerException $e) {
			return $e->getMessage();
		} catch(\Tinify\ConnectionException $e) {
			return $e->getMessage();
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * Resize image and store in buffer
	 * $path (string) original image locate
	 * $method (string) method of resize image: 'scale', 'fit', 'cover', 'thumb' 
	 * $width (integer) width of new image
	 * $height (integer) height of new image
	 */

	public function bufferResize($path, $method, $width = 0, $height = 0)
	{
		try {
			$array = array(
				'method' => $method,
				'width' => $width,
				'height' => $height
			);
			if($method == 'scale') {
				if($width == 0 && $height != 0)
					unset($array['width']);
				else if($width != 0 && $height == 0)
					unset($array['height']);
				else
					unset($array);
			}
			if(isset($array)){
				$resize = $source->resize($array);
				return \Tinify\fromBuffer($resize)->toBuffer();
			} else {
				return \Tinify\fromBuffer($source)->toBuffer();
			}
				
		} catch(\Tinify\ClientException $e){
			return $e->getMessage();
		} catch(\Tinify\ServerException $e) {
			return $e->getMessage();
		} catch(\Tinify\ConnectionException $e) {
			return $e->getMessage();
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}

	/**
	 * Resize image from URL and save in server
	 * $url (string) original image URL
	 * $new_path (string) location where image was saved
	 * $method (string) method of resize image: 'scale', 'fit', 'cover', 'thumb' 
	 * $width (integer) width of new image
	 * $height (integer) height of new image
	 */

	public function urlResize($url, $new_path, $method, $width = 0, $height = 0)
	{
		try {
			$source = \Tinify\fromUrl($url);
			$array = array(
				'method' => $method,
				'width' => $width,
				'height' => $height
			);
			if($method == 'scale') {
				if($width == 0 && $height != 0)
					unset($array['width']);
				else if($width != 0 && $height == 0)
					unset($array['height']);
				else
					unset($array);
			}
			if(isset($array)){
				$resize = $source->resize($array);
				$resize->toFile($new_path);
			} else {
				$source->toFile($new_path);
			}
		} catch(\Tinify\ClientException $e){
			return $e->getMessage();
		} catch(\Tinify\ServerException $e) {
			return $e->getMessage();
		} catch(\Tinify\ConnectionException $e) {
			return $e->getMessage();
		} catch(Exception $e) {
			return $e->getMessage();
		}
	}
}