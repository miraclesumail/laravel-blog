<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\Models\players;
use App\Models\Animals;
use App\Models\privilege;
use App\Models\members;
use App\Models\phone;
use App\Models\engineer;
use App\Models\country;
use App\Models\positions;
use App\Models\jobs;
use App\Models\account;
use App\Events\MessagePushed;

class studentController extends Controller
{
    //private static $lock;

    // public function __construct(){
        
    //     $this->lock = new MemcacheLock;
    // }

    public function index(){
        $students = DB::table('student')->get();
        //dd($students);
        return json_encode($students);
    }   

    //测试一对一 查询  哪个表设置了外键  
    public function testOnetoOne(){
        return json_encode(phone::find(1)->engineer);
    }

    public function players(){
        $players = DB::table('players')->get();
        return json_encode($players);
    }

    public function createPlayer(Request $request){
        // 获得是name age gender数组键值对
        $params = $request->only(['name', 'age', 'gender']);
        //var_dump($params['name']);
        $player = new players;

        $player->name = $params['name'];
        $player->age = $params['age'];
        $player->gender = $params['gender'];
        $player->save();

        broadcast(new MessagePushed(date('Y-m-d h:i:s A').": BIG NEWS!", 'wdeefcfff'));
       //dd($request->all());
    }

    public function signin(Request $request){
    //     $asd = privilege::getPrilegeByRole(3);
    //     //dd($asd);
    //    // return json_encode($asd);
    //     $arr = array();
    //          foreach ($asd as $k => $v) {
    //            $arr[] = $v;
    //            //dd($v);
    //          }
    //          return json_encode($arr);
       $params = $request->only(['name', 'password']);
       $name = $params['name'];
    
       //dd($name);
       $password = $params['password'];
       if(members::exist($name)){
          if(members::judge($name, $password)){
              //再去查询 菜单之类的
              $role = members::getRoleByName($name);
              $asd = privilege::getPrilegeByRole($role);
              $arr = array();
                   foreach ($asd as $k => $v) {
                     $arr[] = $v;
                     //dd($v);
                   }
                   
              $response = array(
                  "status" => 200,
                  "data" => $arr
              );
              return json_encode($response);
          }else{

          }
       }

    }

    public function getAniCount(){
        return json_encode(Animals::getTotalType());
    }

    public function getAniByType(Request $request, $type, $count=3, $page=1){
        //dd(count(Animals::getAnimalByType($type)));
        //int
        //dd($request->get('per'));
        $per = $request->get('per') ? intval($request->get('per')) : 3;
        //$count = $request->get('count') ? intval($request->get('per')) : 3;
        $response = array(
            //"total" => ceil(count(Animals::getAniCount($type))/$per),
            "total" => ceil(Animals::getAniCount($type)/$count),
            "current" => intVal($page),
            "data" => Animals::getAnimalByType($type,$count, $page)
        );

        return json_encode($response);
    }

    // public function signin(){
    //     dd(privilege::getPrilegeByRole(1));
    // }

    public function player(Request $request, $id){
        $player = DB::table('players')->where('id', $request->route('id'))->first();
        return json_encode($player);
    }

    public function test_obj(){
        $qq = array(
            "ww" => 123,
            "qq" => 333
        );
        dd(gettype($qq));
        // dd(((object)$qq)->ww);
        //return json_encode((object)$qq);
    }

    public function upload(Request $request){
        //return json_encode('wwww');
        $aa = 'axiba';
        $files = $request->file("file");
        $i = 0;
        
        //$kuoname = $files[0]->getClientOriginalExtension();
        // $path = $file->getRealPath();
        // $filename = date('Y-m-d') . '/' . $aa .'.'.$kuoname;
        // $bool= Storage::disk('public')->put($filename,file_get_contents($path));

        //return json_encode($request->file("file")->getClientOriginalExtension());
        //return json_encode(Storage::disk('public')->exists('asd.png'));
        //var_dump(Storage::disk('public')->get('asd.png'));

        foreach($files as $file) {
             $kuoname = $file->getClientOriginalExtension();
             $path = $file->getRealPath();
             $filename = date('Y-m-d') . '/' . $aa .$i.'.'.$kuoname;
             $bool= Storage::disk('public')->put($filename,file_get_contents($path));
             $i++;//记录上传张数
        }
        var_dump($files);
    }

    public function getCountry(){
        return json_encode(
            array(
                "status" => 200,
                "data" => country::getCountrys()
            )
        );
    }

    public function getPosition(Request $request, $title){
         return json_encode(positions::getPosition($title));
    }

    public function getJobs(Request $request, $des){
         return json_encode(jobs::getJobs($des));
    }

    public function withdraw(Request $request){
         var_dump(MemcacheLock::$items);
         $params = $request->only(['username', 'amount']);
         $username = $params['username'];
         $amount = $params['amount'];
         if(MemcacheLock::getLock($username)) var_dump('dddd');
         
         sleep(5000);
         account::withdraw($username, $amount);
         MemcacheLock::release($username);
        //  return json_encode(array(
        //      "balance" => account::getbalance($username)
        //  ));
        return $this->getbalance($username);
         
    }

    public function getbalance($username){
        //dd(account::getbalance($username)->toArray()[0]['balance']);
        return json_encode(
           account::getbalance($username)
        );     
    }
}


class MemcacheLock {
      public static $items = Array();
      
      public static function getLock($key){
          if(array_key_exists($key,self::$items) && self::$items[$key]) return true;
          //if(isset$this->items[$key]) return
          self::$items[$key] = 1;    
          return false;
      }

      public static function release($key){
          self::$items[$key] = null;
      }
}
