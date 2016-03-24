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
vagrant up
vagrant ssh 进入虚拟机
然后复制以下所有命令：
sudo apt-get update;sudo apt-get install lamp-server^;cd /var/www;sudo ln -s /vagrant sportfun;sudo cp /vagrant/sportfun.conf /etc/apache2/site-available/;sudo a2ensite sportfun.conf；sudo a2enmod rewrite;sudo apt-get install mcrypt php5-mcrypt;sudo php5enmod mcrypt;sudo service apache2 restart;mysql -u root -e “CREATE DATABASE sportfun;”;cd /var/www/sportfun;curl -sS https://getcomposer.org/installer | php;sudo mv composer.phar /usr/local/bin/composer;sudo composer install;php app/console doctrine:schema:update --force;mysql -u root -e "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY '' WITH GRANT OPTION; FLUSH PRIVILEGES;"
```


7. 改变文件夹访问权限
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
如果你觉得以上太麻烦，那就自己用自己喜欢的方法，如果喜欢直接用Mac了，那就用Mac，以上的步骤是Windows/Mac 通用的。
