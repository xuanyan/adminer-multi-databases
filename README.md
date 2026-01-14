## adminer-multi-databases

这是一个可以配置多个数据账户的Adminer插件。

A plugin for Adminer that supports independent account configuration for database connections.

## 使用说明 / Usage Instructions

### 中文
1. 将本插件文件(multi-databases.php)放入 Adminer 的 `adminer-plugins` 目录。
2. 在adminer-plugins.php中配置插件。
3. 在插件配置数组里为每个数据库连接配置独立的登录名及密码。
4. 访问 Adminer 登录页，使用配置好的帐号登录，即可进入相应的数据库连接。
5. 支持不设置密码快速访问数据库，只需要在插件配置数组中为数据库连接配置 `password` 为空字符串即可。（注意：这将允许任何用户以该数据库连接的用户名登录，不建议在生产环境中使用）

### English
1. Place this plugin file (multi-databases.php) into Adminer’s `adminer-plugins` directory.
2. Configure the plugin in adminer-plugins.php.
3. Within the plugin configuration array, assign an independent username and password for each database connection.
4. Visit the Adminer login page, log in with the configured credentials, and you will be connected to the corresponding database.
5. Support quick access to databases without setting a password. Simply configure `password` as an empty string in the plugin configuration array for the desired database connection. (Note: This will allow any user to log in with the username of that database connection, which is not recommended for production environments)