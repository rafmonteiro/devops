FROM rafaelthedevops/syslog-ng
MAINTAINER Rafael Monteiro <rafaelmonteiroti@gmail.com>

RUN dpkg-divert --local --rename --add /sbin/initctl
RUN ln -sf /bin/true /sbin/initctl
RUN apt-get update
RUN echo "#!/bin/sh\nexit 0" > /usr/sbin/policy-rc.d
RUN echo "mysql-server mysql-server/root_password password password" > /root/mysqlpwdseed
RUN echo "mysql-server mysql-server/root_password_again password password" >> /root/mysqlpwdseed
ARG DEBIAN_FRONTEND=noninteractive
RUN debconf-set-selections /root/mysqlpwdseed
RUN apt-get -y install mysql-server

RUN sed -i -e"s/^bind-address\s*=\s*127.0.0.1/bind-address = 0.0.0.0/" /etc/mysql/my.cnf
RUN sed -i -e"s/log_error/#log_error/" /etc/mysql/my.cnf
RUN sed -i -e"s/expire_logs_days/#expire_logs_days/" /etc/mysql/my.cnf
RUN sed -i -e"s/max_binlog_size/#max_binlog_size/" /etc/mysql/my.cnf
COPY syslog-ng.conf /etc/syslog-ng/
RUN /usr/sbin/mysqld & \

    sleep 10s &&\

    echo "GRANT ALL ON *.* TO admin@'%' IDENTIFIED BY 'password' WITH GRANT OPTION; FLUSH PRIVILEGES" | mysql -u root --password=password &&\
    echo "create database dockerapp" | mysql -u root --password=password
EXPOSE 3306
ADD startup.sh /opt/startup.sh
CMD ["/bin/bash", "/opt/startup.sh"]
