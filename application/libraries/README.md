# TinyPNG Library
Library from CodeIgniter to extends tinypng


## Installation
* Download Tiny_png.php class and tinify directory
* Uncompress all files into application/library CodeIgniter directory 

### Requirements
* CodeIgniter 3.0 or higher
* Not tested on CodeIgniter 4 yet

## How to Use
* Call library in your Controller
```php
$this->load->library('tinypng', array('api_key' => 'YOUR_API_KEY'));
```

* Call a desired compression method
Example
```php 
fileCompress('path_of_original_file_in_your_server/image.png', 'path_of_new_tinified_file/tiny_image.png');
```

## Avaliable Methods
### Connections
```php
testConnection();

countCompressed();

```

### Compress Image
```php
fileCompress($original_image, $new_image);
// Compress image and save in server
// $path (string) original image locate
// $new_path (string) locate where image as saved

bufferCompress($path)
// Compress image and store in buffer
// $path (string) original image locate

urlCompress($url, $new_path)
// Compress image from URL and save in server
// $url (string) original image URL
// $new_path (string) locate where a image as saved
```

### Resize Image
NOTE: to 'scale' method, enter with $width OR $heigh value = 0

EXAMPLE: 
fileResize($path, $new_path, 'scale', 150, 0);

```php
fileResize($path, $new_path, $method, $width, $height)
// Resize image and save in server
// $path (string) original image locate
// $new_path (string) location where image was saved
// $method (string) method of resize image: 'scale', 'fit', 'cover', 'thumb' 
// $width (integer) width of new image
// $height (integer) height of new image

bufferResize($path, $method, $width, $height)
// Resize image and store in buffer
// $path (string) original image locate
// $method (string) method of resize image: 'scale', 'fit', 'cover', 'thumb' 
// $width (integer) width of new image
// $height (integer) height of new image

urlResize($url, $new_path, $method, $width, $height)
// Resize image from URL and save in server
// $path (string) original image locate
// $new_path (string) location where image was saved
// $method (string) method of resize image: 'scale', 'fit', 'cover', 'thumb' 
// $width (integer) width of new image
// $height (integer) height of new image
```

## Contributing
Pull requests are welcome. For major changes, please open an issue first to discuss what you would like to change.

Please make sure to update tests as appropriate.

## License
[MIT](https://choosealicense.com/licenses/mit/)
