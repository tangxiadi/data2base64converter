<?php
error_reporting(E_ALL^E_NOTICE^E_WARNING);
$text = ( isset( $_REQUEST['text'] ) && ! empty( $_REQUEST['text'] ) ) ? $_REQUEST['text'] : '';
$filename = ( isset( $_REQUEST['filename'] ) && ! empty( $_REQUEST['filename'] ) ) ? $_REQUEST['filename'] : '';
$url = "";
$err = 0;
$imgflag = 1;
function judge_image($filename) {
	if ( substr($filename,0,4) == "http" ) {
		if ( get_headers($filename) ) {
			return true;
		} else {
			return false;
		}
	}else if ( file_exists($filename) ) {
		return true;
	}else {
		return false;
	}
}
if ( ! empty( $filename ) ) {
	if ( judge_image($filename) ) {
		switch ( strtolower( pathinfo( $filename, PATHINFO_EXTENSION ) ) ) {
			case 'png':
				$data = "image/png";
				break;
			case 'gif':
				$data = "image/gif";
				break;
			case 'jpg':
				$data = "image/jpeg";
				break;
			case 'jpeg':
				$data = "image/jpeg";
				break;
			case 'bmp':
				$data = "image/bmp";
				break;
			default:
				$err = 1;
				$url = "<strong>Failure</strong>: " . $filename . " <strong>Not Image!</strong>";
		}
		if ( ! $err ) {
			$content = file_get_contents( $filename );
			$code = base64_encode( $content );
			$url = "data:" . $data . ";base64," . $code;
		}
	} else {
		$err = 1;
		$url = "<strong>Failure</strong>: " . $filename . " <strong>Not Exist!</strong>";
	}
}
if ( ! empty( $text ) ) {
		$code = base64_encode( $text );
		$url = "data:text/txt" . ";base64," . $code;
		$imgflag = 0;
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Convert Image or Text to Base64 strings for HTML/CSS embedding</title>
<meta name="keywords" content="data uris, image embed, base64, converter">
<meta name="description" content="Converts image or text into a base64 string with ready-to-use HTML and CSS output">
</head>

<body>
<h1>Convert Image or Text into a Base64 string</h1>
<b>Image:</b>
<form method="get" action="">
	<input type="text" name="filename" value="<?php echo $filename; ?>" style="width:70%">
	<button type="submit">Submit</button>
</form>
<b>Text:</b>
<form method="get" action="">
	<textarea name="text" style="width:70%;height:60px;"><?php echo $text; ?></textarea>
	<button type="submit">Submit</button>
</form>
<br>
<?php if ( ! empty( $url ) ) : ?>
	<?php if ( ! $err ) : ?>
		<textarea style="width:99%;height:180px;"><?php echo $url; ?></textarea>
		<?php if ( $imgflag ) : ?>
			<b>Image Preview: </b>
			<p>Base64 Image: <p><img alt="" src="<?php echo $url; ?>">
			<p>Source Image: <p><img alt="" src="<?php echo $filename; ?>">
		<?php endif; ?>
	<?php endif; ?>
	<?php if ( $err ) : ?>
		<?php echo $url; ?>
	<?php endif; ?>
<?php endif; ?>
</body>
</html>