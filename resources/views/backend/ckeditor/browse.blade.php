<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>{{ env('APP_NAME') }}</title>
<link href="https://fonts.googleapis.com/css?family=Raleway:600,900" rel="stylesheet">
<script type="text/javascript">
function select_image(img_url) {
var CKEditorFuncNum = <?php echo $_GET['CKEditorFuncNum']; ?>;
	window.parent.opener.CKEDITOR.tools.callFunction(CKEditorFuncNum, img_url, '' );
	self.close();
}
</script>
<style type="text/css">
	* {
  box-sizing: border-box;
  margin: 0;
  padding: 0;
}

body {
  font-family: Raleway;
  background-color: #fff;
}

.heading {
    text-align: center;
    font-size: 2.0em;
    letter-spacing: 1px;
    padding: 40px;
    color: #000;
}

.gallery-image {
  padding: 20px;
  display: flex;
  flex-wrap: wrap;
  justify-content: center;
}

.gallery-image img {
  height: auto;
  width: 350px;
  transform: scale(1.0);
  transition: transform 0.4s ease;
}

.img-box {
  box-sizing: content-box;
  margin: 10px;
  height: auto;
  max-width: 350px;
  overflow: hidden;
  display: inline-block;
  color: white;
  position: relative;
  background-color: white;
}

.caption {
  position: absolute;
  bottom: 5px;
  left: 20px;
  opacity: 0.0;
  transition: transform 0.3s ease, opacity 0.3s ease;
}

.transparent-box {
  height: auto;
  width: 350px;
  background-color:rgba(0, 0, 0, 0);
  position: absolute;
  top: 0;
  left: 0;
  transition: background-color 0.3s ease;
}

.img-box:hover img { 
  transform: scale(1.1);
}

.img-box:hover .transparent-box {
  background-color:rgba(0, 0, 0, 0.5);
}

.img-box:hover .caption {
  transform: translateY(-20px);
  opacity: 1.0;
}

.img-box:hover {
  cursor: pointer;
}

.caption > p:nth-child(2) {
  font-size: 0.8em;
}

.opacity-low {
  opacity: 0.5;
}
</style>
</head>
<body>
	 <p class="heading">Browse Image</p>
	  <div class="gallery-image">
	  	@if(count($image_arr) > 0)
	@foreach($image_arr as $image)
	@php 
			$thumb_img_url = $image['thumb'];
			$img_url = $image['image'];
		@endphp
	    <a href="javascript:select_image('{{ $img_url }}');">
	    	<div class="img-box">
	      <img src="{{ $thumb_img_url }}" alt="{{ $image['image_name'] }}" />
	      <div class="transparent-box">
	        <div class="caption">
	          <p>{{ $image['image_name'] }}</p>
	        </div>
	      </div> 
	    </div>
	  </a>
	    @endforeach
@endif
	  </div>
</body>
</html>