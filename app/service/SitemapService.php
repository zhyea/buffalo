<?php
defined('_APP_PATH_') or exit('You shall not pass!');


class SitemapService
{


    public function genGoogleSitemap()
    {
        $path = _ROOT_DIR_ . DIRECTORY_SEPARATOR . 'sitemap.xml';
        del_file($path);
        $data_array = array(
            array(
                'title' => 'title1',
                'content' => 'content1',
                'pubdate' => '2009-10-11',
            ),
            array(
                'title' => 'title2',
                'content' => 'content2',
                'pubdate' => '2009-11-11',
            )
        );
//  属性数组
        $attribute_array = array(
            'title' => array(
                'size' => 1
            )
        );

        $string = <<<XML
<?xml version='1.0' encoding='utf-8'?>
<article>
</article>
XML;


        $xml = simplexml_load_string($string);
        foreach ($data_array as $data) {
            $item = $xml->addChild('item');
            if (is_array($data)) {
                foreach ($data as $key => $row) {
                    $node = $item->addChild($key, $row);
                    if (isset($attribute_array[$key]) && is_array($attribute_array[$key])) {
                        foreach ($attribute_array[$key] as $akey => $aval) {
                            //  设置属性值
                            $node->addAttribute($akey, $aval);
                        }
                    }
                }
            }
        }
        echo $xml->asXML();

    }


}