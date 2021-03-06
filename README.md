@title 自定义框架  
@version 0.1.1  
@auth 邱汶粤(irving)  

框架说明：  
1、该框架是一个API框架，没有视图功能  
2、在控制器中使用return即可返回信息，但需要限定格式，格式为return ['code' => , 'data' => , 'message' =>]  
3、PHP版本必须大于或等于7.0  
4、因为日志系统依赖swoole请安装swoole并确保版本大于或等于2.0 

v0.0.1 版本更新说明：  
1、实现了类的自动加载功能，请注意命名格式，控制器文件和类后面必须加入Controller，并且全局命名遵从PSR规范  
2、实现了路由定义功能，目前仅支持GET、POST、PUT、DELETE  
3、实现了返回格式限制功能，在文件config/common/ResponseFormat.php中可以设置格式，目前仅支持JSON  
4、实现了composer的融入  

v0.0.2 版本更新说明  
1、自定义了错误处理方法，位于framework/ExceptionHandle.php  
2、新增command入口，具体操作为[php command.php --class'操作类' --function='操作方法' --params'参数'(string)]  
3、增加了日志系统，依赖swoole，请先安装swoole插件并运行[php command.php --class='Framework\Swoole\LogSystem' --function='run']开启服务    

v0.0.3 版本更新说明  
1、实现了依赖注入的支持（在Controller中填入需要注入的类，现仅支持依赖的类没有第三依赖）  
2、修正了使用日志方法后，连接不关闭  
3、引入Laravel的Eloquent配置文件在config/database/config.php  
4、修复日志中寻找应用目录方式  

v0.0.4 版本更新说明  
1、实现了缓存，设计模式基于工厂模式，使用抽象类定义，目前只支持Redis，配置文件位于config/common/CacheConfig.php  
2、加入了读取配置文件  

v0.0.5 版本更新说明  
1、重构IOC模块，现在支持多重依赖，并支持Ioc::make()  
2、Ioc::make()依赖注入，并可声明是否强制建立新对象  

v0.0.6 版本更新说明  
1、新增获取参数方法，位于Framework\Instrument\GetParams
2、更加直观的在Controller展示使用依赖注入的方法

v0.0.7 版本更新说明  
1、异常引用了whoops  

v0.1.0 版本更新说明  
1、关闭了debug模式下，用户可看见抛出错误的消息  
2、增加了路由中间件的功能，位于Route\registerMiddle  
3、输出函数中优化，现在会立刻输出返回值  

v0.1.1 版本更新说明  
1、更改日志系统swoole的工作方式，现在使用更节省资源的协程（以前是用异步回调）  
2、日志系统现在可以返回处理结果（已注释）  
3、返回格式中，可直接return['data'=>$data]  
4、修复因fastcgi_finish_request函数不存在而导致的错误   
