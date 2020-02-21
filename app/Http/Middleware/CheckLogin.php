<?php
/**
 * 检查后台用户是否登录
 */

namespace App\Http\Middleware;

use Closure;

class CheckLogin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next, $params) {
        // 当前请求的路由别名
        $currentRouteName = $request->route()->getName();
        // 检查用户是否登录
        if ($currentRouteName != $params){
            if (!auth()->check()) {
                // 清空session
                session()->flush();
                // 跳转登录页面
                return redirect(route('admin.login'))->withErrors(['errors' => '请登录']);
            }
        }
        // $next($request)  Response对象
        return $next($request);
    }
}
