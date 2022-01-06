FROM httpd:2.4.51

ARG APP_WORKDIR

RUN mkdir -p $APP_WORKDIR && chmod -R 777 $APP_WORKDIR

COPY docker/apache/httpd.conf /usr/local/apache2/conf/httpd.conf
COPY docker/apache/httpd-vhosts.conf /usr/local/apache2/conf/extra/httpd-vhosts.conf
COPY docker/apache/httpd-ssl.conf /usr/local/apache2/conf/extra/httpd-ssl.conf
COPY docker/apache/httpd-mpm.conf /usr/local/apache2/conf/extra/httpd-mpm.conf

WORKDIR $APP_WORKDIR
