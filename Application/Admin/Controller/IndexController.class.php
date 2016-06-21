<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    private $pdo;
    static $user;
    static public function isAdmin(){
        
    }
    public function _initialize(){
        $this->pdo=$pdo=db();
        if(!isset($_SESSION["UID"]) && ACTION_NAME  != "login"){
            $this->redirect('/Admin/Index/login');
            return ;
        }
        $UID=(int)$_SESSION["UID"];
        $rs=$pdo->query("SELECT * FROM  `blog_user` WHERE `UID`='$UID' ");
        if($rs->rowCount()<=0 && ACTION_NAME  != "login"){
            $this->redirect('/Admin/Index/login');
            return ;
        }
        $user=$rs->fetch(\PDO::FETCH_ASSOC);
        if($user["password"]!=$_SESSION["password"] && ACTION_NAME  != "login"){
            $this->redirect('/Admin/Index/login');
            return ;
        }
        self::$user=$user;
        $this->assign("siteTitle","后台管理");
        
    }
    public function login(){
        if(!IS_POST){
            $this->assign("adminLogin",true);
            $this->display();
            return ;
        }
        if(get_magic_quotes_gpc()){
            $name=$_POST["name"];
            $password=md5($_POST["password"]);
        }else{
            $name=str_replace(array("'","\"","\n","\r"."\t"),array("\'","\\\"","","",""),$_POST["name"]);
            $password=md5(str_replace(array("'","\"","\n","\r"."\t"),array("\\'","\\\"","","",""),$_POST["password"]));
        }
        $rs=$this->pdo->query("SELECT * FROM  `blog_user` WHERE `name`='$name' and `password`='$password' ");
        if($rs->rowCount()<=0){
            $this->error("用户名或密码错误");
            return ;
        }
        $user=$rs->fetch(\PDO::FETCH_ASSOC);
        $_SESSION["UID"]=$user["UID"];
        $_SESSION["password"]=$user["password"];
        $this->success("登陆成功",__APP__."/Admin/Index/index");
    }
    public function index(){
        $q=$this->pdo->query("SELECT * FROM `blog_post` LEFT JOIN `blog_user` ON `blog_user`.`UID` = `blog_post`.`UID` WHERE `blog_post`.`type`='post' ");
        $list=array();
        $category=array(
            0=>""
            );
        while($rs=$q->fetch(\PDO::FETCH_ASSOC)){
            $rs["title"]=htmlentities($rs["title"]);
            $rs["content"]=htmlentities($rs["content"]);
            $rs["gravatar"]="http://cdn.v2ex.com/gravatar/".md5(strtolower( trim($rs["email"])))."?s=80&r=G&d=";
            if($rs["MID"]==""){
                $rs["MID"]=0;
            }
            if(isset($category[$rs["MID"]])){
                $rs["category"]=$category[$rs["MID"]];
            }else{
                $qq=$this->pdo->query("SELECT * FROM `blog_meta` WHERE `MID`='".$rs['MID']."' ");
                $meta=$qq->fetch(\PDO::FETCH_ASSOC);
                if($meta){
                    $category[$meta["MID"]]=$meta["name"];
                    $rs["category"]=$meta["name"];
                }else{
                    $rs["category"]="";
                    $category[$meta["MID"]]="";
                }
                
            }
            $list[]=$rs;
        }
        //var_dump($list);
        $this->assign("rs",$list);
        $this->display();
    }
    public function exitAdmin(){
        unset($_SESSION["password"]);
        $this->success("正在返回首页",__APP__);
    }
    public function changePassword(){
        if(!IS_POST){
            $this->display();
            return ;
        }
            if($_POST["password"]==""){
                $this->error("密码不能为空");
                
            }else{
                $password=md5(str_replace(array("'","\"","\n","\r"."\t"),array("\\'","\\\"","","",""),$_POST["password"]));
                $UID=self::$user['UID'];
                $this->pdo->exec("UPDATE `blog_user` SET `password`='$password' WHERE `UID`='$UID' " );
                $this->success("请重新登陆",__APP__."/Admin/Index/index");
                
            }
        
    }
    public function setting(){
        $this->display();
    }
}