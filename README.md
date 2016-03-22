sportfun
========
Sport activity finder web application built on Symfony 2.7

It is developed for providing services to book stadium and sport court in Melbourne, Australia.

== 开发者配置 ==
========
当然，如果你喜欢其它的环境，你可以自由配置，但是以下配置，你可以一试。
目前，Vagrant运行Symfony速度慢的问题还未解决，亟待解决中。。。

大致步骤如下：
1. 下载Vitural Box的最新版本
2. 下载Vagrant到你的主机，有关Vagrant的用法，可到官方网站进行了解
3. 在本地创建一个文件夹，用于项目文件
4. 在此文件夹中Clone Git上面的文件，SSH或者HTTPS都行，Folk之后开发
5. 进入sportfun文件夹
6. 运行以下命令
```
vagrant init ubuntu/trusty64
vagrant up --provider virtualbox
```
7. 之后，你会得到Ubuntu14.04 LTS版本的虚拟机环境
8. 安装LAMP
```
sudo apt-get update
sudo apt-get install lamp-server^   --- ^ 是需要的
```
9. 安装过程中会提醒输入数据库root密码，自己决定
10. 之后运行localhost:8080 (这个端口取决于VagrantFile的设置，可以用此Git仓库里面的作为参考)
11. 如果屏幕显示It works!,说明安装成功
12. 进入/var/www 然后link /vagrant 到这个文件夹的sportfun
```
sudo ln -s /vagrant sportfun
```
13. 由于是LAMP, 参考http://symfony.com/doc/current/cookbook/configuration/web_server_configuration.html
14. 由于是Ubuntu，configure文件在/etc/apache2/site-available，配置好。
15. 运行以下
```
sudo a2ensite sportfun.conf
sudo a2enmod rewrite
sudo service apache2 reload
```
16. Install mcrypt
```
sudo apt-get install mcrypt php5-mcrypt
sudo php5enmod mcrypt
sudo service apache2 restart
```
17. 创建数据库sportfun
18. 进入/var/www/sportfun，运行 sudo composer install, 完成后，运行以下
```
php app/console doctrine:schema:update --force
```
19. 改变文件夹访问权限
```
主机
export APACHE_RUN_USER={YOUR_HOST_SERVER_NAME}
export APACHE_RUN_GROUP={YOUR_HOST_SERVER_NAME}
在vagrant虚拟机
export APACHE_RUN_USER=vagrant
export APACHE_RUN_GROUP=vagrant
```
请参考： 
http://stackoverflow.com/questions/22909098/unable-to-create-the-cache-directory-vagrant-app-cache-dev

20. 在虚拟机运行
mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '' WITH GRANT OPTION; FLUSH PRIVILEGES;"
然后你就可以用第三方的数据库软件去连接了。如果你用的vagrantfile配置是Git仓库里面的，你会看到主机端口33306映射到虚拟机的3306端口，所以如果在主机用数据库连接软件的话，端口选择33306。

如果你觉得以上太麻烦，那就自己用自己喜欢的方法，如果喜欢直接用Mac了，那就用Mac，以上的步骤是Windows/Mac 通用的。
