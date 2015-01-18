# Data to Base64 Converter
Convert Image or Text to Base64 string.

## Image
Common image converted Base64 string. Supported image formats: **JPEG**/**PNG**/**GIF**/**BMP**

Pictures can be a local server file (Path), or a network server file (Url).

Recommend picture size does not exceed 1MB. Because image is too big converted Base64 string will be very long, resulting in printed difficulty.

## Text
Any Plain text converted Base64 string.

Recommended that the text length is not too long. Because text is too length converted Base64 string will be very long, resulting in printed difficulty.

--------------------

### Prompt
- Converted have "data" link head, can be opened directly in the browser as a link.
- The converted data more than 33% raw data.
- Image URL must have "http://" head.
