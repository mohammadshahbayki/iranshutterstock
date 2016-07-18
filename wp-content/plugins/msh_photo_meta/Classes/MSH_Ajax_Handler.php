<?php
use PHPImageWorkshop\ImageWorkshop;


class MSH_Ajax_Handler
{
    private $result;

    function  __construct()
    {
        $this->result = array('success' => 0, 'data' => '');
        add_action('wp_ajax_create_thumbnail', array($this, 'get_info'));
    }

    public function response()
    {
        wp_send_json($this->result);
    }

    public function get_info()
    {
        $url = MSH_Configs::getInstance()->getOption('prefix_url');
        $url .= '/';
        $url .= $_POST['pic_url'];
        $url = esc_url_raw($url);
        $this->result = $this->get_photo_info($url);
        $thumbnail = $this->get_thembnail($url, $this->result['width'], $this->result['height'], $this->result['image_id'], $this->result['type']);
        $this->result['thumbnail'] = '<img src="' . $thumbnail . '"/>';
        wp_send_json($this->result);
    }

    public function get_photo_info($url)
    {
        list($width, $height, $type, $attr) = getimagesize($url);
        $imageTypeArray = array
        (
            0 => 'UNKNOWN',
            1 => 'GIF',
            2 => 'JPEG',
            3 => 'PNG',
            4 => 'SWF',
            5 => 'PSD',
            6 => 'BMP',
            7 => 'TIFF_II',
            8 => 'TIFF_MM',
            9 => 'JPC',
            10 => 'JP2',
            11 => 'JPX',
            12 => 'JB2',
            13 => 'SWC',
            14 => 'IFF',
            15 => 'WBMP',
            16 => 'XBM',
            17 => 'ICO',
            18 => 'COUNT'
        );
        $size = getimagesize($url);
        $type = $imageTypeArray[$size[2]];
        $pos = ($width >= $height) ? 'افقی' : 'عمودی';
        $img_size = get_headers($url, 1);
        $img_size = $img_size["Content-Length"];
//  $layer = ImageWorkshop::initFromResourceVar($image);
        $img_dpi = get_dpi($url);
// end picture size
// explode url
        $url_data = explode('/', $url);
        $image_title = $url_data[count($url_data) - 1];
        $image_id_array = explode('_', $image_title);
        $image_id = explode('.', $image_id_array[count($image_id_array) - 1])[0];
        return array('width' => $width, 'height' => $height, 'dpi' => $img_dpi[0], 'size' => number_format($img_size / 1024, 2), 'image_id' => $image_id, 'type' => $type, 'pos' => $pos);
    }

    public function get_thembnail($url, $width, $height, $image_id, $type)
    {
        $folder = '';
        $file_name = $file_name = "shutterstock_" . $image_id . "." . $type;

        $pimage_path = MSHPM_PLUGINS_DIR_PATH . '/images-folder/' . 'shutterstock_' . $image_id . '.' . $type;
        if (file_exists($pimage_path))
            $t = filemtime($pimage_path);
        if (!file_exists($pimage_path) || $t > $t + 3600) {

            $Layer = PHPImageWorkshop\ImageWorkshop::initFromPath($url);
            $Layer->resizeInPixel(($width / $height) * 300, 300, true, 0, 0, 'MM');
//    $Layer->resizeInPercent(10,10);
            $textLayer = PHPImageWorkshop\ImageWorkshop::initTextLayer('© IRAN-SHUTTERSTOCK'
                , MSHPM_PLUGINS_DIR_PATH . '/admin/fonts/terran3dital.ttf',
                22,
                'ffffff',
                calculAngleBtwHypoAndLeftSide($Layer->getWidth(), $Layer->getHeight()));
// Some funky opacity
            $textLayer->opacity(40);
// We add the $textLayer on the norway layer, in its middle
            $Layer->addLayer(1, $textLayer, 0, 0, 'MM');
            $folder = MSHPM_PLUGINS_DIR_PATH . "images-folder";
            $Layer->save($folder, $file_name);
        }
        return MSHPM_PLUGINS_DIR_URL . "images-folder" . '/' . $file_name;
    }

    public function calculAngleBtwHypoAndLeftSide($bottomSideWidth, $leftSideWidth)
    {
        $hypothenuse = sqrt(pow($bottomSideWidth, 2) + pow($leftSideWidth, 2));
        $bottomRightAngle = acos($bottomSideWidth / $hypothenuse) + 180 / pi();
        return -round(90 - $bottomRightAngle);
    }

    public function get_dpi($filename)
    {
        // open the file and read first 20 bytes.
        $a = fopen($filename, 'r');
        $string = fread($a, 20);
        fclose($a);

        // get the value of byte 14th up to 18th
        $data = bin2hex(substr($string, 14, 4));
        $x = substr($data, 0, 4);
        $y = substr($data, 4, 4);
        return array(hexdec($x), hexdec($y));
    }

}