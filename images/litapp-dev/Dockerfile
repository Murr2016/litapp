FROM tutum/lamp:latest
ADD resources/my.cnf /etc/mysql/conf.d/my.cnf
RUN rm -rf /app/*
VOLUME /app
EXPOSE 80
CMD ["/run.sh"]
