<?php
namespace Admin\Controller;
use Think\Controller;
class PluginController extends Controller {
    private $pdo;
    static $user;
    public function _initialize(){
        $this->pdo=$pdo=db();
        self::$user=my();
        $this->assign("siteTitle","后台管理");

    }
    public function index(){
        $plugins=array();
        $arr=scandir(BLOG_PATH."/Plugin");
        foreach($arr as $plugin){
            if($plugin==".." || $plugin=="."){
                continue ;
            }
            $dir=BLOG_PATH."/Plugin/".$plugin;
            if(!is_dir($dir) or !is_file($dir."/init.php")){
                 continue;
            }
            $tags=token_get_all(file_get_contents($dir."/init.php"));
            $arr2=array();
            foreach($tags as $tag){
                if(token_name($tag[0]) == "T_DOC_COMMENT" or token_name($tag[0]) == "T_ML_COMMENT" or token_name($tag[0])=="T_COMMENT"){
                    $arr2=explode("\n",$tag[1]);
                    break ;
                }
            };
            if(count($arr2)==0){
                continue ;
            }
            $info=array();
            foreach($arr2 as $data){
                $offset=strpos($data,":");
                if($offset===false){
                    continue ;
                }
                $key=trim(substr($data,0,$offset));
                $value=substr($data,$offset+1);
                $info[$key]=$value;
            }
            $info["status"]="close";
            $plugins[$plugin]=$info;
        }
        $plugins_=unserialize($this->pdo->query("SELECT * FROM `blog_setting` WHERE `key`='plugins' ")->fetch()["value"]);
        foreach($plugins_ as $plugin=>$set){
            if($set["status"]=="open"){
                if(isset($plugins[$plugin])){
                    $plugins[$plugin]["status"]="open";
                }else{
                    unset($plugins_[$plugin]);
                    $this->pdo->exec("UPDATE `blog_setting` SET `value`='".str_replace("'","\\'",serialize($plugins_))."' WHERE `key`='plugins' ");
                }

            }
        }
        $this->assign("plugins",$plugins);
        $this->display();
    }
    public function open($package){
            $dir=BLOG_PATH."/Plugin/".$package;
            if(!is_dir($dir) or !is_file($dir."/init.php")){
            $this->redirect('/Admin/Plugin/index');
                 return ;
            }
        $plugins=unserialize($this->pdo->query("SELECT * FROM `blog_setting` WHERE `key`='plugin' ")->fetch()["value"]);
        $plugins[$package]["status"]="open";
        $this->pdo->exec("UPDATE `blog_setting` SET `value`='".str_replace("'","\\'",serialize($plugins))."' WHERE `key`='plugins' ");
            $this->redirect('/Admin/Plugin/index');
                 return ;

    }
    public function close($package){
            $dir=BLOG_PATH."/Plugin/".$package;
            if(!is_dir($dir) or !is_file($dir."/init.php")){
            $this->redirect('/Admin/Plugin/index');
                 return ;
            }
        $plugins=unserialize($this->pdo->query("SELECT * FROM `blog_setting` WHERE `key`='plugin' ")->fetch()["value"]);
        $plugins[$package]["status"]="close";
        $this->pdo->exec("UPDATE `blog_setting` SET `value`='".str_replace("'","\\'",serialize($plugins))."' WHERE `key`='plugins' ");
            $this->redirect('/Admin/Plugin/index');
                 return ;

    }
    public function uninstall($plugin){
        function rm_rf($path){
             if(is_dir($path)){
                 $file_list= scandir($path);
                 foreach ($file_list as $file){
                     if( $file!='.' && $file!='..'){
                         if(!rm_rf($path.'/'.$file)){
                             return false;
                         }
                     }
                 }
                 return rmdir($path);
             } else {
                 return unlink($path);    //这两个地方最好还是要用@屏蔽一下warning错误,看着闹心
             }
        }
        $path=BLOG_PATH."/Plugin/".$plugin;
        if(is_dir($path)){
            if(!rm_rf($path)){
                $this->error("卸载失败，请手动删除",'/Admin/Plugin/index');
            }
        }
        $plugins=unserialize($this->pdo->query("SELECT * FROM `blog_setting` WHERE `key`='plugin' ")->fetch()["value"]);
        if(isset($plugins[$plugin])){
            unset($plugins[$plugin]);
            $this->pdo->exec("UPDATE `blog_setting` SET `value`='".str_replace("'","\\'",serialize($plugins))."' WHERE `key`='plugins' ");
        }
        $this->redirect('/Admin/Plugin/index');
        return ;
    }
}
