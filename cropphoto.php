<?php 

    function image_carre($source, $destination, $image_type, $square_size, $image_width, $image_height, $quality){
        if($image_width <= 0 || $image_height <= 0){return false;} 
        
        if( $image_width > $image_height )
        {
            $y_offset = 0;
            $x_offset = ($image_width - $image_height) / 2;
            $s_size 	= $image_width - ($x_offset * 2);
        }else{
            $x_offset = 0;
            $y_offset = ($image_height - $image_width) / 2;
            $s_size = $image_height - ($y_offset * 2);
        }
        $new_canvas	= imagecreatetruecolor( $square_size, $square_size); 
        $color = imagecolorallocate($new_canvas, 255, 255, 255);
        imagefill ($new_canvas , 0 , 0 , $color);
        
        if(imagecopyresampled($new_canvas, $source, 0, 0, $x_offset, $y_offset, $square_size, $square_size, $s_size, $s_size)){
            save_image($new_canvas, $destination, $image_type, $quality);
        }

        return true;
    }


    function image_resize($source, $destination, $image_type, $max_size, $image_width, $image_height, $quality){
        
        if($image_width <= 0 || $image_height <= 0){return false;} 
        
        if($image_width <= $max_size && $image_height <= $max_size){
            if(save_image($source, $destination, $image_type, $quality)){
                return true;
            }
        }
        
        $image_scale	= min($max_size/$image_width, $max_size/$image_height);
        $new_width		= ceil($image_scale * $image_width);
        $new_height		= ceil($image_scale * $image_height);
        
        $new_canvas		= imagecreatetruecolor( $new_width, $new_height ); 
        $color = imagecolorallocate($new_canvas, 255, 255, 255);
        imagefill ($new_canvas , 0 , 0 , $color);
        
        if(imagecopyresampled($new_canvas, $source, 0, 0, 0, 0, $new_width, $new_height, $image_width, $image_height)){
            save_image($new_canvas, $destination, $image_type, $quality); 
        }

        return true;
    }



	function save_image($source, $destination, $image_type, $quality){
		switch(strtolower($image_type)){
			case 'image/png': 
				imagepng($source, $destination); return true; 
				break;
			case 'image/gif': 
				imagegif($source, $destination); return true; 
				break;          
			case 'image/jpeg': 
            case 'image/pjpeg': 
				imagejpeg($source, $destination, $quality); return true; 
				break;
			default: return false;
		}
	}

?>