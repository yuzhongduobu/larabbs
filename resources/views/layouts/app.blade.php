<!DOCTYPE html>
<html lang="{{app()->getLocale() }}"> <!-- app()->getLocale() 获取的是 config/app.php 中的 locale 选项 -->
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=egde"><!-- http-equiv顾名思义，相当于http的文件头作用，它可以向浏览器传回一些有用的信息，以帮助正确和精确地显示网页内容，与之对应的属性值为content，content中的内容其实就是各个参数的变量值。 -->
  <meta name="viewport" content="width=device-width, initial-scale=1"><!-- name属性主要用于描述网页，与之对应的属性值为content，content中的内容主要是便于搜索引擎机器人查找信息和分类信息用的。  -->

  <!--CSRF Token -->
  <meta name="csrf-token" content="{{ csrf_token() }}"><!-- csrf-token 标签是为了方便前端的 JavaScript 脚本获取 CSRF 令牌。 -->
  <title>@yield('title', 'LaraBBS') - Laravel 进阶教程</title>
 <!--  @yield('title', 'LaraBBS') 继承此模板的页面，如果没有定制 title 区域的话，就会自动使用第二个参数 LaraBBS 作为标题前缀。 -->
  <link href="{{ mix('css/app.css') }}" rel="stylesheet">
  <!-- mix('css/app.css') 会根据 webpack.mix.js 的逻辑来生成 CSS 文件链接。 -->
  @yield('styles')
</head>
<body>
  <div id="app" class="{{ route_class() }}-page"><!-- route_class() 是我们自定义的辅助方法，我们还需要在 helpers.php 文件中添加此方法： -->

    @include('layouts._header')<!-- 加载顶部导航区块的子模板 -->

    <div class="container">

      @include('shared._messages')

      @yield('content')<!-- 占位符声明，允许继承此模板的页面注入内容 -->

    </div>

    @include('layouts._footer')<!-- 加载页面尾部导航区块的子模板 -->
  </div>

  <!-- Scripts -->
  <script src="{{ mix('js/app.js') }}"></script>

  @yield('scripts')
</body>
</html>
