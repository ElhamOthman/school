<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassModel extends Model
{
    use HasFactory;
    protected $table ='class';
 static public function getRecord(){
    $return = ClassModel::select('class.*' , 'users.name as created_by_name' )
    ->join('users','users.id','class.created_by')
    ->where('class.in_delete' ,'=' ,0)
    ->OrderBy('class.id','desc')
    ->paginate(2);
    return $return;
 }
 static public function getSingle($id){
   return self::find($id);
}
}
