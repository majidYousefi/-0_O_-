<?php

namespace App\Http\Controllers;

use App\Http\Controllers\c_admin as c;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Input;
use App;
use DB;
use Session;

define("SPACE", "App\Http\Controllers\c_admin\\");

class manager extends Controller {

    public function detect($serv_id, $action, $extra = '', $json_decode = TRUE) {
        /*   $servicesXML = simplexml_load_string(file_get_contents("../app/Http/Controllers/services.xml"));
          $servicesXML = json_decode(json_encode($servicesXML), 1)['services'];
          $controller = '';
          $model = '';
          foreach ($servicesXML as $service) {
          if ($service['id'] == $serv_id) {
          $controller = $service['controller'];
          $model = $service['model'];
          break;
          }
          }
         */
        $className = SPACE . session('services')[$serv_id]['controller'];
        $do = new $className(session('services')[$serv_id]['model']);
        switch ($action) {
            case 's':
                try {
                    return (json_encode($do->show(session('services')[$serv_id]['view'])). "__@__". json_encode($do->listx()));
                } catch (Exception $e) {
                    dd("xx");
                }
                break;
            case 'a':
                 $do->add();
                $do->addDetail();
                return ;
                break;
            case 'e':
                $do->addDetail();
                return $do->edit();
                break;
            case 'g':
                return json_encode($do->get()) . "__@__" .json_encode($do->getDetail());
                break;
            case 'l':
                return json_encode($do->listx());
                break;
            case 'd':
                return $do->delete();
                break;
            case 'gc':
                if ($json_decode)
                    return json_encode($do->gc($extra));
                else
                    return $do->gc($extra);
                break;
        }
    }

    /*  function createList($listData)
      {
      $listData=json_decode(json_encode($listData),1);
      $tbody='';
      $count=$listData['count'];
      unset($listData['count']);

      foreach($listData as $tr)
      {
      $tbody.="<tr>";
      foreach($tr as $td)
      $tbody.="<td>".$td."</td>";


      $tbody.="</tr>";
      }
      $tbody['count']=$count;
      return $tbody;
      }
     */
}
