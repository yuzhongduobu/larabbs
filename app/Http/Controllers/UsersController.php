<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Requests\UserRequest;
use App\Handlers\ImageUploadHandler;

class UsersController extends Controller
{
    public function show(User $user)
    {
        return view('users.show',compact('user'));
        // Laravel 会自动解析定义在控制器方法（变量名匹配路由片段）中的 Eloquent 模型类型声明。在上面代码中，由于 show() 方法传参时声明了类型 —— Eloquent 模型 User，对应的变量名 $user 会匹配路由片段中的 {user}，这样，Laravel 会自动注入与请求 URI 中传入的 ID 对应的用户模型实例。
    }

    public function edit(User $user)
    {
        $this->authorize('update', $user);
        return view('users.edit',compact('user'));
    }

    public function update(UserRequest $request,ImageUploadHandler $uploader,User $user)
    {
        $this->authorize('update', $user);
       $data = $request->all();

        if ($request->avatar) {
            $result = $uploader->save($request->avatar, 'avatars', $user->id，416);
            if ($result) {
                $data['avatar'] = $result['path'];
            }
        }

        $user->update($data);
        return redirect()->route('users.show', $user->id)->with('success', '个人资料更新成功！');
    }
    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);
    }
    // 我们使用 Laravel 提供身份验证（Auth）中间件来过滤未登录用户的 edit, update 动作：
//     __construct 是 PHP 的构造器方法，当一个类对象被创建之前该方法将会被调用。我们在 __construct 方法中调用了 middleware 方法，该方法接收两个参数，第一个为中间件的名称，第二个为要进行过滤的动作。我们通过 except 方法来设定 指定动作 不使用 Auth 中间件进行过滤，意为 —— 除了此处指定的动作以外，所有其他动作都必须登录用户才能访问，类似于黑名单的过滤机制。相反的还有 only 白名单方法，将只过滤指定动作。我们提倡在控制器 Auth 中间件使用中，首选 except 方法，这样的话，当你新增一个控制器方法时，默认是安全的，此为最佳实践。

// Laravel 提供的 Auth 中间件在过滤指定动作时，如该用户未通过身份验证（未登录用户），将会被重定向到登录页面：
//     因为我们使用了命名空间，所以需要在顶部加载 use App\Handlers\ImageUploadHandler;；
// $data = $request->all(); 赋值 $data 变量，以便对更新数据的操作；
// 以下代码处理了图片上传的逻辑，注意 if ($result) 的判断是因为 ImageUploadHandler 对文件后缀名做了限定，不允许的情况下将返回 false：
}
