<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Notifications\ResetPassword;
class User extends Authenticatable
{
    use Notifiable;

    /**
     * 定义交互的数据库表为users
     * @var string
     */
    protected $table='users';

    /**
     * The attributes that are mass assignable.
     * （过滤）只有包含在该属性中的字段才能够被正常更新
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     * （过滤）在用户实例通过数组或 JSON 显示时进行隐藏
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    //boot 方法会在用户模型类完成初始化之后进行加载，因此我们对事件的监听需要放在该方法中
    public static function boot()
    {
        parent::boot(); // TODO: Change the autogenerated stub

        //creating 用于监听模型被创建之前的事件，created 用于监听模型被创建之后的事件
        static::creating(function($user){
           $user->activation_token = str_random(30);
        });
    }

    /**
     * 获取用户头像
     * @param string $size
     * @return string
     */
    public function gravatar($size = '100')
    {
        $hash = md5(strtolower(trim($this->attributes['email'])));
        return "http://www.gravatar.com/avatar/$hash?s=$size";
    }

    public function sendPasswordResetNotification($token)
    {
        $this->notify(new ResetPassword($token));
    }
}
