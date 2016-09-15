FROM eboraas/apache-php
MAINTAINER Rafael Monteiro <rafaelmonteiroti@gmail.com>
RUN apt-get update && apt-get install apache2-utils
ADD index.php /var/www/html/index.php
ADD 000-default.conf /etc/apache2/sites-available/000-default.conf
RUN htpasswd -b -c /etc/apache2/.htpasswd admin password

EXPOSE 80
EXPOSE 443

CMD ["/usr/sbin/apache2ctl", "-D", "FOREGROUND"]

