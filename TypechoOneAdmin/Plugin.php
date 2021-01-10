<?php
if (!defined('__TYPECHO_ROOT_DIR__')) exit;

/**
 * TypechoOneAdmin Typecho 博客页面美化插件，提供多种美化样式。登录来自泽泽社长(qqdie)，页面美化来自<a href="https://github.com/yn-zxj/Typecho_Admin_Theme">yn-zxj purple</a>
 * 仅在 php 7 测试过
 * @package TypechoOneAdmin
 * @author gogobody
 * @version 1.0.0
 * @link https://github.com/gogobody/TypechoOneAdmin.git
 */

class TypechoOneAdmin_Plugin implements Typecho_Plugin_Interface
{
    public static $file_map = [];

    /**
     * @return array
     */
    public static function getFileMap()
    {
        return self::$file_map;
    }

    /**
     * @param array $file_map
     */
    public static function setFileMap($file_map)
    {
        self::$file_map = $file_map;
    }

    /**
     * 激活插件方法,如果激活失败,直接抛出异常
     *
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function activate()
    {
        $plugin_path = dirname(__FILE__);

        Typecho_Plugin::factory('admin/header.php')->header_2000 = array('TypechoOneAdmin_Plugin', 'renderHeader');
        Typecho_Plugin::factory('admin/footer.php')->end_2000 = array('TypechoOneAdmin_Plugin', 'renderFooter');
        if(file_exists("var/Widget/Menu.php")){
            //挂载menu.php
            rename("var/Widget/Menu.php", "var/Widget/Menu.php.bak");
            copy("usr/plugins/TypechoOneAdmin/var/Widget/Menu.php", "var/Widget/Menu.php");
        }


        $admin_files = self::readdir($plugin_path.'/admin/');
        self::setFileMap($admin_files);

        foreach ($admin_files as $tmp_file){
            $tmp_file_path = "usr/plugins/TypechoOneAdmin/admin/".$tmp_file;
            $target_file_path = "admin/".$tmp_file;
            $target_file_bak = "admin/".$tmp_file.".bak";

            if(file_exists($target_file_path)){
                //挂载
                rename($target_file_path, $target_file_bak);
                copy($tmp_file_path, $target_file_path);
            }
        }

    }

    /**
     * 禁用插件方法,如果禁用失败,直接抛出异常
     *
     * @static
     * @access public
     * @return void
     * @throws Typecho_Plugin_Exception
     */
    public static function deactivate()
    {
        //还原Menu.php
        if(file_exists("var/Widget/Menu.php.bak")){
            unlink("var/Widget/Menu.php");
            rename("var/Widget/Menu.php.bak", "var/Widget/Menu.php");
        }
        $plugin_path = dirname(__FILE__);

        $admin_files = self::readdir($plugin_path.'/admin/');

        foreach ($admin_files as $tmp_file){
            $target_file_path = "admin/".$tmp_file;
            $target_file_bak = "admin/".$tmp_file.".bak";

            if(file_exists($target_file_bak)){
                unlink($target_file_path);
                rename($target_file_bak, $target_file_path);
            }
        }
    }

    /**
     * 获取插件配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form 配置面板
     * @return void
     */
    public static function config(Typecho_Widget_Helper_Form $form)
    {

        ?>
        <link rel="stylesheet" href="<?php Helper::options()->pluginUrl(); ?>/TypechoOneAdmin/assets/css/login.css?20191123">
        <?php

        $url = Helper::options()->pluginUrl . '/TypechoOneAdmin/';
        $zz1 = '<div class="zz">素雅山水</div>';
        $zz2 = '<div class="zz">蓝天群山</div>';
        $zz3 = '<div class="zz">早春印象</div>';
        $zz4 = '<div class="zz">海洋巨人</div>';
        $zz5 = '<div class="zz">绿意之方</div>';
        $zz6 = '<div class="zz">暗之色系</div>';
        $zz7 = '<div class="zz">亮之色系</div>';
        $zz8 = '<div class="zz">黑客帝国</div>';
        $zz9 = '<div class="zz">高斯模糊</div>';
        $zz10 = '<div class="zz">空白样式<br>不使用内置样式</div>';

        echo '<div class="container"><div class="typecho-page-title"><h6> -- 登录注册样式修改自泽泽社长(qqdie)</h6></div></div>';
        $bgfengge = new Typecho_Widget_Helper_Form_Element_Radio(
            'bgfengge', array(
            'suya' => _t('<div class="kuai"><img src="' . $url . '/assets/images/suya.jpg" loading="lazy">' . $zz1 . '</div>'),
            'BlueSkyAndMountains' => _t('<div class="kuai"><img src="' . $url . '/assets/images/BlueSkyAndMountains.jpg" loading="lazy">' . $zz2 . '</div>'),
            'Earlyspringimpression' => _t('<div class="kuai"><img src="' . $url . '/assets/images/Earlyspringimpression.jpg" loading="lazy">' . $zz3 . '</div>'),
            'MarineGiant' => _t('<div class="kuai"><img src="' . $url . '/assets/images/MarineGiant.jpg" loading="lazy" loading="lazy">' . $zz4 . '</div>'),
            'lv' => _t('<div class="kuai tags"><img src="' . $url . '/assets/images/lv.jpg" loading="lazy">' . $zz5 . '</div>'),
            'black' => _t('<div class="kuai"><img src="' . $url . '/assets/images/black.jpg" loading="lazy" loading="lazy">' . $zz6 . '</div>'),
            'white' => _t('<div class="kuai"><img src="' . $url . '/assets/images/white.jpg" loading="lazy">' . $zz7 . '</div>'),
            'heike' => _t('<div class="kuai tags"><img src="' . $url . '/assets/images/heike.jpg" loading="lazy">' . $zz8 . '</div>'),
            'mohu' => _t('<div class="kuai"><img src="' . $url . '/assets/images/mohu.jpg" loading="lazy">' . $zz9 . '</div>'),
            'kongbai' => _t('<div class="kuai"><img src="' . $url . '/assets/images/kongbai.jpg" loading="lazy">' . $zz10 . '</div>'),
        ), 'suya', _t('登陆/注册页面样式'), _t(''));
        $bgfengge->setAttribute('id', 'yangshi');
        $form->addInput($bgfengge);

        $bgUrl = new Typecho_Widget_Helper_Form_Element_Text('bgUrl', NULL, NULL, _t('自定义背景图'), _t('选中上方的基础样式后，可以在这里填写图片地址自定义背景图；<b>注意</b>：带有【动态】标识的风格不支持自定义背景图。'));
        $form->addInput($bgUrl);

        $diycss = new Typecho_Widget_Helper_Form_Element_Textarea('diycss', NULL, NULL, '自定义样式', _t('上边的样式选择【空白样式】，然后在这里自己写css美化注册/登录页面；<b>注意</b>：该功能与【自定义背景图】功能冲突，使用该功能时如果想设置背景图请写css里面。'));
        $form->addInput($diycss);

    }

    /**
     * 个人用户的配置面板
     *
     * @access public
     * @param Typecho_Widget_Helper_Form $form
     * @return void
     */
    public static function personalConfig(Typecho_Widget_Helper_Form $form)
    {
    }

    /**
     *
     * 函数名:readdir($dir)
     * 作用:读取目录所有的文件名
     * 参数:$dir 目录地址
     * 返回值:文件名数组
     *
     * */
    public static function readdir($dir) {
        $handle=opendir($dir);
        $i=0;
        while(!!$file = readdir($handle)) {
            if (($file!=".")and($file!="..")) {
                $list[$i]=$file;
                $i=$i+1;
            }
        }
        closedir($handle);
        return $list;
    }

    /**
     * 插件实现方法
     *
     * @access public
     * @return string
     */
    public static function renderHeader($hed)
    {
        $options = Helper::options();

        $url = $options->pluginUrl . '/TypechoOneAdmin/';
        list($prefixVersion, $suffixVersion) = explode('/', $options->version);

        if (!Typecho_Widget::widget('Widget_User')->hasLogin()) {
            $skin = Typecho_Widget::widget('Widget_Options')->plugin('TypechoOneAdmin')->bgfengge;
            $diycss = Typecho_Widget::widget('Widget_Options')->plugin('TypechoOneAdmin')->diycss;
            if ($skin == 'kongbai') {
                $hed = $hed . '<style>' . $diycss . '</style>';
            } else {
                if ($skin == 'heike') {
                    $hed = $hed . '<link rel="stylesheet" href="' . $url . 'assets/skin/' . $skin . '.css?20191125">';
                } else {
                    $bgUrl = Typecho_Widget::widget('Widget_Options')->plugin('TypechoOneAdmin')->bgUrl;
                    $zidingyi = "";
                    if ($bgUrl) {
                        $zidingyi = "<style>body,body::before{background-image: url(" . $bgUrl . ")}</style>";
                    }
                    $hed = $hed . '<link rel="stylesheet" href="' . $url . 'assets/skin/' . $skin . '.css?20191125">' . $zidingyi;
                }
            }

            echo $hed;
        }else{
            /* 添加 purple style */
            $hed = $hed . '<link rel="stylesheet" href="' . $url . 'assets/css/style.min.css?v=' . $suffixVersion.'">';
            $hed = $hed.'<link rel="stylesheet" href="' . $url . 'assets/vendors/mdi/css/materialdesignicons.min.css?v=' . $suffixVersion.'">';
            $hed = $hed.'<link rel="stylesheet" href="' . $url . 'assets/vendors/css/vendor.bundle.base.css?v=' . $suffixVersion.'">';
            $hed = $hed.'<script src="' . $url . 'assets/vendors/js/vendor.bundle.base.js?v=' . $suffixVersion.'"></script>';
            $hed = $hed.'<script src="' . $url . 'assets/js/off-canvas.js?v=' . $suffixVersion.'"></script>';
            $hed = $hed.'<script src="' . $url . 'assets/js/hoverable-collapse.js?v=' . $suffixVersion.'"></script>';
        }

        return $hed;
    }

    public static function renderFooter()
    {
        $options = Helper::options();

        $url = $options->pluginUrl . '/TypechoOneAdmin/';
        list($prefixVersion, $suffixVersion) = explode('/', $options->version);
        if (!Typecho_Widget::widget('Widget_User')->hasLogin()) {
            $url = Helper::options()->pluginUrl . '/TypechoOneAdmin/';
            $skin = Typecho_Widget::widget('Widget_Options')->plugin('TypechoOneAdmin')->bgfengge;
            $ft = '';
            if ($skin == 'heike') {
                $ft = '<canvas id="canvas"></canvas><script type="text/javascript">window.onload=function(){var canvas=document.getElementById("canvas");var context=canvas.getContext("2d");var W=window.innerWidth;var H=window.innerHeight;canvas.width=W;canvas.height=H;var fontSize=16;var colunms=Math.floor(W/fontSize);var drops=[];for(var i=0;i<colunms;i++){drops.push(0)}var str="111001101000100010010001111001111000100010110001111001001011110110100000";function draw(){context.fillStyle="rgba(0,0,0,0.05)";context.fillRect(0,0,W,H);context.font="700 "+fontSize+"px  微软雅黑";context.fillStyle="#00cc33";for(var i=0;i<colunms;i++){var index=Math.floor(Math.random()*str.length);var x=i*fontSize;var y=drops[i]*fontSize;context.fillText(str[index],x,y);if(y>=canvas.height&&Math.random()>0.99){drops[i]=0}drops[i]++}}function randColor(){var r=Math.floor(Math.random()*256);var g=Math.floor(Math.random()*256);var b=Math.floor(Math.random()*256);return"rgb("+r+","+g+","+b+")"}draw();setInterval(draw,30)};</script>';
            }
            if ($skin == 'lv') {
                $ft = '<ul class="bg-bubbles"><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li><li></li></ul>';
            }
            echo $ft;
        }else{
            echo '<script src="' . $url . 'assets/js/misc.js?v=' . $suffixVersion.'"></script>';
        }

    }


}
